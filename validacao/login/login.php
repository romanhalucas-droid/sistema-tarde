<?php
//bad + esc + tab
//BLOQUEAR ACESSO DIRETO AO ARQUIV
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location:/html/sistema/view/inicio/');
}

//iniciar sessão
if(!isset($_SESSION)){ //SE NÃO EXISTIR SESSÃO
    //INICIAR SESSÃO
    session_start();
}

//iniciar conexão com banco de dados
require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/conexao/inicio_conexao.php";

$sql = $conn_db->prepare("SELECT id, nome, usuario, senha FROM usuarios WHERE usuario=:usuario");
$sql->bindValue(":usuario", $_POST['usuario']);//passar parametros
$sql->execute(); //apertar enter

if($sql->rowCount() == 1){ //SE QUANTIDADE DE REGISTRO RETORNARDO FOR IGUAL A 1
    
    //enquanto existir linha a ser exibida
    while($linha = $sql->fetch(PDO::FETCH_ASSOC)){
        
        //SE A SENHA(PASSWORD) DIGITADO PELO USUÁRIO FOR IGUAL AO PASSWORD DO BANCO DE DADOS (CRIPTOGRAFADO)
        if(password_verify($_POST['senha'], $linha['senha'])){
            session_regenerate_id(); //REINICIAR ID DA SESSÃO
            
            $_SESSION['logadosistema'] = true;
            $_SESSION['idusuariosistema'] = $linha['id'];
            $_SESSION['usuariosistema'] = $linha['usuario'];
            $_SESSION['nomeusuariosistema'] = $linha['nome'];
            
            //msg de sucesso
            ?><div class='alert alert-success' role='alert'>Usuário logado com sucesso!</div><?php
            
            //redirecionamento para a página principal
            header('location:/html/sistema/view/inicio/');
            
        }else{//senão senha inválida
            
            ?><div class='alert alert-danger' role='alert'>Senha incorreta!</div><?php
            
        }
        
    }
    
}else{//SENÃO USUÁRIO NÃO POSSUI CONTA NO SISTEMA
    ?><div class="alert alert-danger" role="alert">Usuário inválido</div><?php
}