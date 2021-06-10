<?php

require __DIR__ . '/vendor/autoload.php';

define('TITLE', 'Editar Vaga');

use \App\Entity\Vaga;

// Validação do ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}


// CONSULTA A VAGA
$obVaga = new Vaga;
$obVaga = Vaga::getVaga($_GET['id']);


// Validação da vaga
if (!$obVaga instanceof Vaga) {
    header('location: index.php?status=error');
    exit;
}

// Validação do POST
if (isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])) {
    //die('Cadastrar');

    // Estanciando uma nova vaga:
    //$obVaga = new Vaga;
    $obVaga->titulo = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo = $_POST['ativo'];

    // Chamar o método cadastar();
    //$obVaga->cadastrar();

    header('location: index.php?status=success');
    exit;
}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/formulario.php';
include __DIR__ . '/includes/footer.php';
