<?php
//verificar se está logado no sistema
require_once $_SERVER['DOCUMENT_ROOT'].'/html/sistema/util/login/logado.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/html/sistema/util/estrutura/cabecalho.php'; ?>
        <title>LISTAR | CONVIDADOS</title>
    </head>
    <body>
        <?php include $_SERVER['DOCUMENT_ROOT'].'/html/sistema/util/estrutura/menu.php'; ?>
        <div class="container shadow-sm mt-sm-2 bg-white p-3 rounded-3">
            <div class='btns'>
                
                <!-- ADICIONAR -->
                <a href='/html/sistema/view/convidados/cadastrar.php?id=0' class='btn btn-success'>
                    <i class='bi bi-person-fill-add me-1'></i> Adicionar
                </a>
                
            </div>
            
            <div class='table-responsive mt-1 bg-white'>
                <table id='tabela_listar_convidados' class='table table-striped table-bordered w-100'>
                    <!-- id, nome, celular, confirmado, dtExpiracao, vistoPorUltimo, responsavel_cadastro -->
                    <thead>
                        <tr><!-- linha -->
                            <th>Id</th><!--colunas -->
                            <th>Nome</th>
                            <th>Celular</th>
                            <th>Confirmado</th>
                            <th>Data de Expiração</th>
                            <th>Responsável pelo Cadastro</th>
                            <th>Visto por último</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/conexao/inicio_conexao.php";
                        
                        $convidados = ConvidadosDAO::selectAll([
                           'conn'  => $conn_db
                        ]);
                        
                        require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/conexao/fim_conexao.php";
                        ?>
                    </tbody>
                </table>
            </div>
            
            
        </div>
    </body>
</html>


