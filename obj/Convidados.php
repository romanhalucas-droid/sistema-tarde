<?php

class Convidados{
    private $id;
    private $nome;
    private $celular;
    private $confirmado;
    private $dtExpiracao;
    private $vistoPorUltimo;
    private $Usuarios;
    
    public function __construct($id) {
        $this->$id = $id;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getConfirmado() {
        return $this->confirmado;
    }

    public function getDtExpiracao() {
        return $this->dtExpiracao;
    }

    public function getVistoPorUltimo() {
        return $this->vistoPorUltimo;
    }

    public function getUsuarios() {
        return $this->Usuarios;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function setNome($nome): void {
        $this->nome = $nome;
    }

    public function setCelular($celular): void {
        $this->celular = $celular;
    }

    public function setConfirmado($confirmado): void {
        $this->confirmado = $confirmado;
    }

    public function setDtExpiracao($dtExpiracao): void {
        $this->dtExpiracao = $dtExpiracao;
    }

    public function setVistoPorUltimo($vistoPorUltimo): void {
        $this->vistoPorUltimo = $vistoPorUltimo;
    }

    public function setUsuarios($Usuarios): void {
        $this->Usuarios = $Usuarios;
    }
    
    
}

