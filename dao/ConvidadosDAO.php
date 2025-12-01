<?php
require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/obj/Convidados.php";
require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/dao/UsuariosDAO.php";

use Ramsey\Uuid\Uuid; //declarando a possibilidade de gerar um UUID

class ConvidadosDAO{
    private static function estruturarSQL($conn, $ln){
        try{
            $obj = new Convidados(null);
            $obj->setId($ln['id']);
            $obj->setNome($ln['nome']);
            $obj->setConfirmado($ln['confirmado']);
            $obj->setCelular($ln['celular']);
            $obj->setDtExpiracao($ln['dtExpiracao']);
            $obj->setVistoPorUltimo($ln['vistoPorUltimo']);
            $obj->setUsuarios(UsuariosDAO::selectIndex(['conn' => $conn, 'id' => $ln['idusuario']])[0]);
            
            return $obj;
            
        } catch (Exception $e) {
            echo "ERRO: {$e->getMessage()}";
            return false;
        }
    }
    
    //SELECIONAR POR ID
    public static function selectIndex($array){
        try{
            $conn = verException(!empty($array['conn']), $array['conn'], 'A conexão não foi aberta!');
            $id = !empty($array['id']) ? $array['id'] : null;
            
            
                    
        } catch (Exception $e) {
            echo "ERRO: {$e->getMessage()}";
            return false;
        }
    }
    
}


