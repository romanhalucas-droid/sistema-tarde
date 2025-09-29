<?php
//chamar a conexão
require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/conexao/conexao.php";

try{
    //ABRINDO CONEXÃO
    $conn_db = conDB();
    
    //SE A CONEXÃO JÁ ESTIVER ABERTA
    if($conn_db->inTransaction()){
        //CANCELAR A(S) ALTERAÇÃO(ÕES)
        $conn_db->rollBack();
    }
    
    //SALVAMENTO AUTOMÁTICO É ATIVADO
    $conn_db->setAttribute(PDO::ATTR_AUTOCOMMIT, true);
} catch (PDOException $e) {
    if(isset($conn_db)){//SE EXISTIR CONEXÃO
        //ZERAR CONEXÃO
        $conn_db = null;
    }
    echo "ERRO DB: ".$e->getMessage();
} catch (Exception $e) {
    if(isset($conn_db)){//SE EXISTIR CONEXÃO
        //ZERAR CONEXÃO
        $conn_db = null;
    }
    echo "ERRO: ".$e->getMessage();
}



