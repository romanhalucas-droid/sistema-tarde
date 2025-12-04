<?php
if(!isset($_SESSION)){
    //PRE: SE NÃO TIVER NENHUM CONTEÚDO NA SESSÃO
    //PÓS: INICIAR SESSÃO
    session_start(); //INICIANDO SESSÃO
}

if(!isset($_SESSION['logadosistema']) OR $_SESSION['logadosistema']==false){
    //PRE: SE NÃO TIVER CONTEÚDO NO LOGADOFORM OU FOR IGUAL A FALSO
    //PÓS: REDIRECIONAR PARA O LOGIN
    
    header('location:/html/sistema/view/login/'); //redirecionamento    
}

require_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/dao/Funcoes.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/dao/UsuariosDAO.php";
require_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/dao/ConvidadosDAO.php";
require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/plugin/vendor/autoload.php";
