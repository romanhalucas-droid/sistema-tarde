<?php
    //VERIFICANDO SE USUÁRIO ESTÁ LOGADO
    require_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/login/logado.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>LISTAR | USUÁRIOS</title>
        <?php include_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/estrutura/cabecalho.php"; ?>        
    </head>
    <body class="bg-light">
        <?php include_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/estrutura/menu.php"; ?>
        
        <div class="container shadow-sm mt-sm-2 bg-white p-3 rounded-3">
            <div class="btns">
                
            </div>
            
            <div class="table-responsive mt-1 bg-white">
            
            </div>
        </div>
        
        <?php include_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/estrutura/rodape.php"; ?>
    </body>
</html>


