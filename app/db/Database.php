<?php

namespace App\db;

use \PDO;
use PDOException;

class Database
{
    const HOST = 'localhost';

    const NAME = 'wdev-vagas';

    const USER = 'root';

    const PASS = '';

    // Nome da tabela a ser manipulada
    private $table;

    // instancia de conexao com o BD
    private $connection;

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->setConnection();
    }

    private function setConnection()
    {
        try {
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::NAME, self::USER, self::PASS);
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
        //dados da querry
        $fields = array_keys($values);
        $binds = array_pad([], count($fields), '?');

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