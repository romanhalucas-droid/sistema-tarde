<?php
//bad + ESC + TAB
//BLOQUEAR ACESSO DIRETO AO ARQUIVO
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location:/html/sistema/view/inicio/');
}

//VERIFICAR SE ESTÁ LOGADO
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/sistema/util/login/logado.php';

//INICIAR CONEXÃO
require_once $_SERVER['DOCUMENT_ROOT'] . '/html/sistema/util/conexao/inicio_conexao.php';

//RECEBER REGISTRO QUE DEVE SER APAGADO PELO CLIENTE
$id = $_POST['id'];

try{
    //DESATIVAR AUTOSAVE
    $conn_db->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    //INICIAR TRANSAÇÃO DO BANCO DE DADOS
    $conn_db->beginTransaction();
    
    //CARREGAR OBJETO NA VARIAVEL PARA POSTERIORMENTE APAGAR
    $obj = UsuariosDAO::selectIndex([
        'conn' => $conn_db,
        'id' => $id
    ])[0];
    
    //EXCLUINDO REGISTRO
    $exc = UsuariosDAO::excluir([
        'conn' => $conn_db,
        'obj' => $obj
    ]);
    
    //SE EXCLUIR COM SUCESSO ENTÃO
    if($exc){
        //SALVAR MANUALMENTE
        $conn_db->commit();
        ?><div class='alert alert-success' role='alert'>Excluido com sucesso...</div><?php
    }else{
        //CANCELAR EXCLUSÃO
        $conn_db->rollback();
        ?><div class='alert alert-danger' role='alert'>Algo deu errado ao excluir...</div><?php
    }
    
    
    
} catch (PDOException $e) {
    //CANCELAR ALTERAÇÕES
    $conn_db->rollBack();
    //EXIBIR MENSAGEM DE ERRO
    ?><div class='alert alert-danger' role='alert'>ERRO DB: <?=$e->getMessage()?></div><?php
} catch (Exception $e){
    //CANCELAR ALTERAÇÕES
    $conn_db->rollBack();
    //EXIBIR MENSAGEM DE ERRO
    ?><div class='alert alert-danger' role='alert'>ERRO DB: <?=$e->getMessage()?></div><?php
} finally {
    //ATIVAR SAVE AUTOMÁTICO DO BANCO DE DADOS
    $conn_db->setAttribute(PDO::ATTR_AUTOCOMMIT, true);
    //FINALIZAR CONEXÃO
    require_once $_SERVER['DOCUMENT_ROOT'] . '/html/sistema/util/conexao/fim_conexao.php';
}