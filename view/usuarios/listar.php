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
                
                <!--Adicionar-->
                <a href="/html/sistema/view/usuarios/cadastrar.php?id=0" class="btn btn-success">              
                    <i class="bi bi-person-fill-add me-1"></i> Adicionar
                </a>
                
                <!-- Gerar relatório -->
                <a href="/html/sistema/relatorio/usuarios/" class="btn btn-dark">
                    Relatório
                </a>
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
                                    <a class="link-success link-offset-2"
                                       href='/html/sistema/view/usuarios/cadastrar.php?id=<?= $u->getId() ?>'>
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <script nonce="<?= uniqid() ?>">
            $(document).ready(function () {
                let tabelaUsuarios = iniciarTabela("#tabela_listar_usuarios");
            });
        </script>
        
        <?php include_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/estrutura/rodape.php"; ?>
    </body>
</html>


