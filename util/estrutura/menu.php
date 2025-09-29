<?php
//BAD + TAB
//BLOQUEAR ACESSO DIRETO AO ARQUIV
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location:/html/sistema/view/inicio/');
}

//logado + TAB
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/sistema/util/login/logado.php';

?>


<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/html/sistema/view/inicio/">Sistema</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="/html/sistema/view/inicio/">
              <i class="bi bi-house-door me-2"></i>Inicio
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/html/sistema/validacao/login/sair.php">
              <i class="bi bi-door-open me-2"></i>Sair
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>