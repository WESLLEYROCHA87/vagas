<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Vaga;

// Obrigar passar um ID
if (!isset($_GET['id']) or !is_numeric($_GET['id'])) {
    header('location: index.php?status=error');
    exit;
}

$obVaga = Vaga::getVaga($_GET['id']);
echo "<pre>";
print_r($obVaga);
echo "</pre>";
exit;


// Validação do POST
if (isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])) {
    //die('Cadastrar');

    // Estanciando uma nova vaga:
    $obVaga = new Vaga;
    $obVaga->titulo = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo = $_POST['ativo'];

    // Chamar o método cadastar();
    $obVaga->cadastrar();

    header('location: index.php?status=success');
    exit;

    // Debulga o objeto: $obVaga para saber se tudo está sendo passado corretamente       /* echo "<pre>";
    /*print_r($obVaga);
    echo "</pre>";
    exit;
    */
}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/formulario.php';
include __DIR__ . '/includes/footer.php';
