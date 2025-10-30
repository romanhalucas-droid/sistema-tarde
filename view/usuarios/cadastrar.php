<?php

//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
require_once $_SERVER['DOCUMENT_ROOT']. "/html/sistema/util/login/logado.php";

//RECEBER O ID DO USUÁRIO VIA GET (ESCOLHA DO USUÁRIO)
//!!!!!ATENCÃO!!!!!
//SE ID RECEBIDO FOR IGUAL A 0 (zero) SIGNIFICA QUE O USUÁRIO QUER CRIAR UM NOVO REGISTRO
$id = !empty($_GET['id']) ? $_GET['id'] : 0;

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!--INCLUIR CABEÇALHO -->
        <?php include $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/estrutura/cabecalho.php"; ?>
        <title>CADASTRAR | USUÁRIOS</title>
    </head>
    <body class="bg-light">
        <!--INCLUIR MENU DO SITE -->
        <?php include $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/estrutura/menu.php" ?>
        
        <?php
        //SE ID FOR IGUAL A 0 ENTÃO
        if($id==0){
            //ADICIONAR NOVO REGISTRO
            /*$id $nome $email $dtNasc $usuario $senha $cpf $contato1*/
            $id = 0;
            $nome = "";
            $email = "";
            $dtnasc = "";
            $usuario = "";
            $senha = "";
            $cpf = "";
            $contato1 = "";
        }else{
            //EDITAR REGISTRO
            ///abrir conexão
            require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/conexao/inicio_conexao.php";
            
            $obj = UsuariosDAO::selectIndex([
               'conn' => $conn_db,
               'id' => $id
            ]); //LISTANDO O USUÁRIO POR ID UTILIZANDO BANCO DE DADOS
            
            //CARREGAR INFORMAÇÕES NAS VARIÁVEIS
            $id = $obj[0]->getId();
            $nome = $obj[0]->getNome();
            $email = $obj[0]->getEmail(); //<<<<<<<<<<<<<<<<<<< novo (esqueci)
            $dtnasc = $obj[0]->getDtNasc();
            $usuario = $obj[0]->getUsuario();
            $senha = $obj[0]->getSenha();
            $cpf = $obj[0]->getCpf();
            $contato1 = $obj[0]->getContato1();
            
            //fechar conexão
            require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/conexao/fim_conexao.php";
        }
        ?>
        
        <!-- INICIO DO FRONT-END DO FORMULÁRIO -->
        <div class="container shadow-sm mt-sm-2 bg-white p-3 rounded-3">
            <h3>Cadastro de Usuários:</h3>
            <hr>
            <!-- INICIO DO FORMULÁRIO -->
            <form 
                name="formcadastrarusuario" id="formcadastrarusuario" 
                action="/html/sistema/validacao/usuarios/salvar.php" method="post"
            >                
                
            </form>
            <!-- FIM DO FORMULÁRIO -->
        </div>
        
        
        <!--INCLUIR RODAPE DO SITE -->
        <?php include $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/estrutura/rodape.php" ?>
    </body>
</html>



