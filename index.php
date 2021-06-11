<?php

/*autoload.php = atualiza as classes em todas as páginas */
require __DIR__ . '/vendor/autoload.php';

use \App\Entity\Vaga;

$vagas = Vaga::getVagas();


/*Inclusão de páginas: */

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/listagem.php';
include __DIR__ . '/includes/footer.php';