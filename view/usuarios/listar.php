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
                <table id="tabela_listar_usuarios" class="table table-striped table-bordered w-100">
                    <thead>
                        <tr><!-- LINHA -->
                            <th>Id</th><!-- COLUNA -->
                            <th>Nome</th>
                            <th>Usuário</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody> <!--AQUI APARECE AS INFORMAÇÕES DA TABELA -->
                        <?php
                            //INICIAR CONEXÃO
                            require_once $_SERVER['DOCUMENT_ROOT'].'/html/sistema/util/conexao/inicio_conexao.php'; 
                            
                            $usuarios = UsuariosDAO::selectAll([
                                'conn' => $conn_db
                            ]);
                            
                            //FINALIZAR CONEXÃO
                            require_once $_SERVER['DOCUMENT_ROOT'].'/html/sistema/util/conexao/fim_conexao.php';                            
                        ?>
                        
                        <?php foreach ($usuarios as $u): ?>
                            <tr>
                                <td><?= $u->getId() ?></td>
                                <td><?= $u->getNome() ?></td><!-- nome -->
                                <td><?= $u->getUsuario() ?></td>
                                <td>
                                    <!--EDITAR -->
                                    <a class="link-success link-offset-2">
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <?php include_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/estrutura/rodape.php"; ?>
    </body>
</html>


