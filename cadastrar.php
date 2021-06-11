  <?php

  require __DIR__ . '/vendor/autoload.php';

  /* Debug: O que está sendo passado pela Varíavel Suber Global POST */
  /*echo "<pre>";
  echo print_r($_POST);
  echo "</pre>";
  exit; */

  define('TITLE', 'Cadastrar vaga');

  // Ultilização da Classe Vaga nesta pagina.
  use \App\Entity\Vaga;

  // Instanciando uma nova vaga. 
  $obVaga = new Vaga;

  // Validar se dados chegaram corretamente;
  // isset: Informa se a variável foi iniciada.
  if (isset($_POST['titulo'], $_POST['descricao'], $_POST['ativo'])) {
    // Caso a próxima página apareça a palavra Cadastrar é porque está funcionando. 
    //die('Cadastrar');

    $obVaga->titulo    = $_POST['titulo'];
    $obVaga->descricao = $_POST['descricao'];
    $obVaga->ativo     = $_POST['ativo'];
    $obVaga->cadastrar();

    /* Debug: O que está sendo passado pela Varíavel $obVaga */
    /*echo "<pre>";
    echo print_r($obVaga);
    echo "</pre>";
    exit; */

    header('location: index.php?status=success');
    exit;
  }

  include __DIR__ . '/includes/header.php';
  include __DIR__ . '/includes/formulario.php';
  include __DIR__ . '/includes/footer.php';