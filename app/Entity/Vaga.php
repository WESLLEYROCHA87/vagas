<?php

namespace App\Entity;

use App\db\Database;
use \PDO;

class Vaga
{

    /* Identificador único da vaga */
    public $id;

    /* Título da vaga */
    public $titulo;

    /* Descrição da vaga, pode conter html */
    public $descricao;

    /* Define se a vaga está ativa (s/n) */
    public $ativo;

    /*Data da publicação da vaga */
    public $data;

    /* Método responsável por cadastrar a nova vaga no banco*/
    public function cadastrar()
    {
        // Definir a data
        $this->data = date('Y-m-d H:i:s');

        // Inserir a data no Banco
        $obDatabase = new Database('vagas');
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
    public static function getvaga($id)
    {
    }
}
