<?php

namespace App\db;

use \PDO;
use PDOException;

/* Class Database: Fará ponte entre o sistema e o banco de dados utilizando PDO;
* Através do conceito QueryBuilder:   Desenvolvido à partir do Database Access Objects, 
o query builder permite que você construa uma instrução SQL em um programático e 
independente de banco de dados. Comparado a escrever instruções SQL à mão, 
usar query builder lhe ajudará a escrever um código SQL relacional mais legível e
gerar declarações SQL mais seguras. */

class Database
{
    const HOST = 'localhost';
    const NAME = 'wdev-vagas';
    const USER = 'root';
    const PASS = '';

    // Nome da tabela a ser manipulada
    private $table;

    // instancia de conexao com o BD - Tipo PDO
    private $connection;

    /* Construtor: Define a tabela e instancia a coneãox */
    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    /* Método responsável por criar uma conexão com o Banco de Dados */
    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
            // Caso ocorra algum o PDO devera encerrar a operação retornando uma Exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    // Método responsável por executar queries dentro do banco de dados
    public function execute($query, $params = [])
    {
        try {
            $statement = $this->connection->prepare($query);
            $statement->execute($params);
            return $statement;
        } catch (PDOException $e) {
            die('ERROR: ' . $e->getMessage());
        }
    }

    // Metodo responsavel por inserir dados no banco
    public function insert($values)
    {
        //Dados da querry.
        $fields = array_keys($values); // Funcao array_keys - >  Retorna todas as chaves ou uma parte das chaves de um array
        $binds = array_pad([], count($fields), '?'); // array_pad: Expande um array para um certo comprimento utilizando um determinado valor 

        // implode: Junta elementos de uma matriz em uma string
        $query = 'INSERT INTO '  . $this->table . ' (' . implode(',', $fields) . ') VALUES (' . implode(',', $binds) . ')';

        // Executa o insert
        $this->execute($query, array_values($values));

        // Retorna o ID inderido
        return $this->connection->lastInsertId();
    }

    // Método responsável por executar uma consulta no banco
    public function select($where = null, $order = null, $limit = null, $fields = '*')
    {
        // Dados da Query
        $where = strlen($where) ? 'WHERE' . $where : '';
        $order = strlen($order) ? 'ORDER BY' . $order : '';
        $limit = strlen($limit) ? 'LIMIT' . $limit : '';

        // MONTA A QUERY
        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        // Executa a Query
        return $this->execute($query);
    }
}