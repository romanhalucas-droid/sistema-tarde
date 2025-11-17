<?php
    //VERIFICANDO SE USUÁRIO ESTÁ LOGADO
    require_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/login/logado.php";
?>
<!DOCTYPE html>

<html>
    <head>
        <title>INICIO | SISTEMA </title>
        <?php include_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/estrutura/cabecalho.php"; ?>
    </head>
    <body class="bg-light">
        <?php include_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/estrutura/menu.php"; ?>
        
        <div class="container bg-white mt-2 shadow-sm p-2 rounded-3">
            <h1 class="bg-info p-1 text-white rounded-1 fw-bold"><i class="bi bi-house-door me-2"></i>INICIO</h1>
            <hr>
            <?php
                $saudacao = saudacao();
                $iconturno = null;
                switch ($saudacao['turno']) {
                    case 1:
                        $iconturno = "<i class=\"bi bi-sunrise me-1\"></i>";
                        break;
                    case 2:
                        $iconturno = "<i class=\"bi bi-sunset me-1\"></i>";
                        break;
                    default:
                        $iconturno = "<i class=\"bi bi-moon-stars me-1\"></i>";
                        break;
                }
            ?>
            <h2><?=$iconturno?><?=$saudacao['msg']?>, <?=$_SESSION['nomeusuariosistema'] ?></h2>
        </div>
        
        <?php include_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/estrutura/rodape.php"; ?>
    </body>
</html>


