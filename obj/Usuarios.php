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
    
}

