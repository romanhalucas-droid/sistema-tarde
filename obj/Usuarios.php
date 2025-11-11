<?php
//bad + tab
//BLOQUEAR ACESSO DIRETO AO ARQUIV
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('location:/html/sistema/view/inicio/');
}

//VERIFICANDO SE USUÁRIO ESTÁ LOGADO
require_once "{$_SERVER['DOCUMENT_ROOT']}/html/sistema/util/login/logado.php";


class Usuarios{

    private $id; //id: int auto_increment primary_key (PK)
    private $nome; //nome: varchar(200) not_null
    private $email; //email: varchar(200) not_null unique
    private $dtNasc; //dtNasc: date not_null
    private $usuario; //usuario: varchar(100) not_null unique
    private $senha; //senha: varchar(100) not_null
    private $cpf; //cpf: varchar(11) not_null unique
    private $contato1; //contato1: varchar(14)
    
    public function __construct($id) {
        $this->id = $id;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getDtNasc() {
        return $this->dtNasc;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function getSenha() {
        return $this->senha;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getContato1() {
        return $this->contato1;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setEmail($email): void {
        $this->email = $email;
    }

    public function setDtNasc($dtNasc): void {
        $this->dtNasc = $dtNasc;
    }

    public function setUsuario($usuario): void {
        $this->usuario = $usuario;
    }

    public function setSenha($senha): void {
        $this->senha = $senha;
    }

    public function setCpf($cpf): void {
        $this->cpf = $cpf;
    }

    public function setContato1($contato1): void {
        $this->contato1 = $contato1;
    }    
    
    ///validação
    public function validar() {
        $nome = $this->nome;
        $email = $this->email;
        $dtnasc = $this->dtNasc;
        $usuario = $this->usuario;
        $cpf = $this->cpf;
        $contato1 = $this->contato1;        
        
        /////////////////////////////
        //NOME
        /////////////////////////////
        
        //VERIFICAR SE ESTÁ VAZIO
        if(empty($nome)){
            return [
                'result' => false,
                'msg' => "Não é permitido o campo NOME ficar VAZIO."
            ];
        }
        
        //SE O PRIMEIRO OU ÚLTIMO CARACTERE FOR ESPAÇO
        if(substr($nome, 0, 1)==" " OR substr($nome, -1)==" "){
            return [
                'result' => false,
                'msg' => "Não é permitido espaço como primeiro e/ou último caractere do NOME!"
            ];
        }
        
        /////////////////////////////////
        //EMAIL
        /////////////////////////////////
        
        //VERIFICAR SE ESTÁ VAZIO
        if(empty($email)){
            return [
                'result' => false,
                'msg' => "Não é permitido o campo EMAIL ficar VAZIO."
            ];
        }
        
        //verificar se o campo email realmente é email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return [
                'result' => false,
                'msg' => "EMAIL informado inválido."
            ];
        }
        
        //////////////////////////////////////////////
        //DATA DE NASCIMENTO
        //////////////////////////////////////////////
        //VERIFICAR SE ESTÁ VAZIO
        if(empty($dtnasc)){
            return [
                'result' => false,
                'msg' => "Não é permitido o campo DATA DE NASCIMENTO ficar VAZIO."
            ];
        }
        
        //SE O PRIMEIRO OU ÚLTIMO CARACTERE FOR ESPAÇO
        if(substr($dtnasc, 0, 1)==" " OR substr($dtnasc, -1)==" "){
            return [
                'result' => false,
                'msg' => "Não é permitido espaço como primeiro e/ou último caractere do DATA DE NASCIMENTO!"
            ];
        }
        
        //VERIFICAR QUANTIDADE DE CARACTERE
        if(strlen($dtnasc) !== 10){
            //SE QUANTIDADE DE DÍGITOS FOR DIFERENTE DE 10
            return [
                'result' => false,
                'msg' => "O campo DATA DE NASCIMENTO deve ter obrigatóriamente 10 dígitos."
            ];
        }
        
        ////////////////////////////////
        //USUÁRIO
        ////////////////////////////////
        
        //VERIFICAR SE ESTÁ VAZIO
        if(empty($usuario)){
            return [
                'result' => false,
                'msg' => "Não é permitido o campo USUÁRIO ficar VAZIO."
            ];
        }
        
        //verificar se digitou o espaço
        if(strpos($usuario, " ")){
            return [
                'result' => false,
                'msg' => "Não é permitido digitar espaço no campo USUÁRIO"
            ];
        }
        
         //////////////////////////////////////////////
        //cpf
        //////////////////////////////////////////////
        //VERIFICAR SE ESTÁ VAZIO
        if(empty($cpf)){
            return [
                'result' => false,
                'msg' => "Não é permitido o campo CPF ficar VAZIO."
            ];
        }
        
        //SE O PRIMEIRO OU ÚLTIMO CARACTERE FOR ESPAÇO
        if(substr($cpf, 0, 1)==" " OR substr($cpf, -1)==" "){
            return [
                'result' => false,
                'msg' => "Não é permitido espaço como primeiro e/ou último caractere do CPF!"
            ];
        }
        
        //VERIFICAR QUANTIDADE DE CARACTERE
        if(strlen($cpf) !== 11){
            //SE QUANTIDADE DE DÍGITOS FOR DIFERENTE DE 11
            return [
                'result' => false,
                'msg' => "O campo CPF deve ter obrigatóriamente 11 dígitos."
            ];
        }
        
        //////////////////////////////////////////////
        //CONTATO1
        //////////////////////////////////////////////
        
        if(!empty($contato1) AND strlen($contato1)<10){
            //SE CONTATO1 FOR DIFERENTE  DE VAZIO E TAMANHO FOR MENOR QUE 10
            return [
                'result' => false,
                'msg' => "Número informado no campo CONTATO 1 inválido."
            ];
        }
        
        //caso esteja certo
        return [
            'result' => true,
            'msg' => "Validado com sucesso!"
        ];
    }
    
}

