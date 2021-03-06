<?php

namespace App\Entity;

use App\db\Database;
use \PDO;

class Vaga
{
    /* Identificador único da vaga. */
    public $id;

    /* Título da vaga. */
    public $titulo;

    /* Descrição da vaga. */
    public $descricao;

    /* Define se a vaga está ativa: string (s/n) */
    public $ativo;

    /*Data da publicação da vaga. */
    public $data;

    /* Método responsável por cadastrar a nova vaga no banco de dados*/
    public function cadastrar()
    {
        // Definir a data
        $this->data = date('Y-m-d H:i:s');

        // Inserir a vaga no Banco        
        $obDatabase = new Database('vagas');

        echo "<pre>";
        print_r($obDatabase);
        echo "<pre/>";
        exit;

        $this->id = $obDatabase->insert([
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'ativo' => $this->ativo,
            'data' => $this->data
        ]);
        // Retornar sucesso
        return true;
    }

    //Método resposnável por obter as vagas do banco de dados
    public static function getVagas($where = null, $order = null, $limit = null)
    {
        return (new Database('vagas'))->select($where, $order, $limit)
            ->fetchAll(PDO::FETCH_CLASS, self::class);
    }

    // Método responsável por buscar uma vaga com base em seu ID
    public static function getVaga($id)
    {
        // Temos um problema aqui; Temos 2 registro no DB, se em qualquer um que clicamos ele sempre mostra o id 1.
        return (new Database('vagas'))->select('id =' . $id)->fetchObject(self::class);
    }
}