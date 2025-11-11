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
$confirmarsenha = $_POST['confirmarsenha'];

try{
    //DESATIVAR SAVE AUTOMÁTICO DO BD
    $conn_db->setAttribute(PDO::ATTR_AUTOCOMMIT, false);    
    $conn_db->beginTransaction(); //INICIANDO CONEXÃO MANUALMENTE    
    
    $obj = new Usuarios(null); //INSTANCIANDO OBJETO
    $obj->setId($id); //PEGAR VALOR RECEBIDO PELO POST E ALOCAR NO OBJETO
    $obj->setNome($nome);
    $obj->setEmail($email);
    $obj->setCpf(deixarNumero($cpf)); //MODIFICADO AQUI
    $obj->setDtnasc(dtBrasilToSql($dtnasc)); //MODIFICADO AQUI
    $obj->setContato1(deixarNumero($contato1)); //MODIFICADO AQUI
    $obj->setUsuario(mb_strtoupper($usuario, 'UTF-8'));//colocando usuário maiusculo
    
    if(strlen($senha)<8){//SE A SENHA DIGITADA TIVER MENOS DE 8 CARACTERES
        throw new Exception("A senha deve possuir pelo menos 8 dígitos.");
    }

    //VERIFICAR SE A SENHA É IGUAL A CONFIRMAÇÃO DA SENHA
    if($senha !== $confirmarsenha){
        throw new Exception("A senha e a confirmação da senha não correspondem!");
    }
    
    //CRIPTOGRÁFIA DA SENHA
    
    //VERIFICAR SE O REGISTRO INSERIDO É NOVO OU É UMA ATUALIZAÇÃO
    if($id>0){
        //ENTÃO ATUALIZAÇÃO
        
        $senha_db = UsuariosDAO::selectIndex([
            'conn' => $conn_db, 
            'id' => $id])[0]->getSenha(); //PEGANDO SENHA CRIP. DO BANCO DE DADOS
        
        //SE A SENHA DO FORMULÁRIO FOI A MESMA QUE A SENHA DO BANCO DE DADOS
        if($senha===$senha_db){
            //ENTÃO
            $obj->setSenha($senha);
        }else{
            //SENÃO
            $obj->setSenha(password_hash($senha, PASSWORD_DEFAULT));
            //criptografar senha nova
        }
    }else{
        //CRIPTOGRAFAR SENHA E ALOCAR NO OBJETO
        $obj->setSenha(password_hash($senha, PASSWORD_DEFAULT));
    }
    
    //VALIDAÇÃO DE INPUTS
    $validar = $obj->validar();
    if(!$validar['result']){
        throw new Expection($validar['msg']);
    }
    
    
    //SALVAR USUÁRIO NO BANCO DE DADOS
    $idbd = UsuariosDAO::salvar([
       'conn' => $conn_db,
       'obj' => $obj
    ]);
    
    //SE ID DO BANCO DE DADOS FOR MAIOR QUE 0
    if($idbd>0){
        //SE SALVAR COM SUCESSO
        $conn_db->commit(); //CONFIRMAR ALTERAÇÕES

        ?><div class='alert alert-success' role='alert'>
            Usuário salvo com sucesso
        </div><?php
    }else{
        //SE ALGO ESTIVER ERRADO
        
        $conn_db->rollback(); //DESFAZER AS ALTERAÇÕES
        
        ?><div class='alert alert-danger' role='alert'>
            Algo deu errado ao salvar...
        </div><?php
    }
} catch (PDOException $e) {
    $conn_db->rollback();
    ?><div class='alert alert-danger' role='alert'>
        ERRO BD: <?=$e->getMessage()?>
    </div><?php
} catch (Exception $e) {
    $conn_db->rollback();
    ?><div class='alert alert-danger' role='alert'>
        ERRO: <?=$e->getMessage()?>
    </div><?php
}finally{
    require_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/conexao/fim_conexao.php";
}

