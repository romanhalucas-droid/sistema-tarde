<?php
//BLOQUEAR ACESSO DIRETO AO ARQUIVO
//bad + TAB
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location:/html/sistema/view/inicio/');
}

//VERIFICANDO SE USUÁRIO ESTÁ LOGADO
require_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/login/logado.php";

require_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/conexao/inicio_conexao.php";

//id, nome, email, cpf, dtnasc, usuario, senha, contato1

//CRIAR RECEBIMENTO DO POST PARA TODOS OS CAMPOS
$id = $_POST['id'];
$nome = $_POST['nome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$dtnasc = $_POST['dtnasc'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$contato1 = $_POST['contato1'];

try{
    
    
} catch (PDOException $e) {
    
} catch (Exception $e) {

}finally{
    require_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/conexao/fim_conexao.php";
}

