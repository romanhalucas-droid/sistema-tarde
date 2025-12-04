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
            
            //SELECIONAR TODOS OS CONVIDADOS ONDE ID É IGUAL A :ID
            $sql = $conn->prepare("SELECT * FROM convidados obj WHERE obj.id = :id");
            $sql->bindValue(":id", $id); //PASSANDO PARAMETRO
            
            $sql->execute();//ENTER
            
            $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            $objs = array();
            
            foreach ($resultado as $ln){
                $objs[] = self::estruturarSQL($conn, $ln);
            }
            
            return $objs;
                    
        } catch (Exception $e) {
            echo "ERRO: {$e->getMessage()}";
            return false;
        }
    }
    
    //SELECIONAR TODOS
    public static function selectAll($array) {
        try{
            $conn = verException(!empty($array['conn']), $array['conn'], 'A conexão não foi aberta!');
            
            //SELECIONAR TODOS OS CONVIDADOS
            $sql = $conn->prepare("SELECT * FROM convidados");
            
            $sql->execute();//executar
            
            $resultado = $sql->fetchAll(PDO::FETCH_ASSOC); //ASSOCIAR O RESULTADO P/ VIRAR ARRAY
            
            $objs = array();
            
            foreach ($resultado as $ln){
                $objs[] = self::estruturarSQL($conn, $ln);
            }
                    
            return $objs;
        } catch (Exception $e) {
            echo "ERRO: {$e->getMessage()}";
            return false;
        }
    }
    
    
    //salvar
    public static function salvar($array){
        try{
            $conn = verException(!empty($array['conn']), $array['conn'], 'A conexão não foi aberta');
            $obj = verException(!empty($array['obj']), $array['obj'], 'O objeto não existe!');
            
            //id, nome, celular, confirmado, dtExpiracao, vistoPorUltimo
            if(!empty($obj->getId())){
                //ATUALIZAR
                $sql = "UPDATE convidados SET id=:id, nome=:nome, celular=:celular, confirmado=:confirmado,"
                        . "dtExpiracao=:dtExpiracao, vistoPorUltimo=:vistoPorUltimo, idusuario=:idusuario WHERE id=:id";
                
                $sql = $conn->prepare($sql);
                $sql->bindValue(":id", $obj->getId());
                $uuid = $obj->getId(); //NOVO
                
            }else{
                //CRIAR
                $sql = "INSERT INTO convidados(id, nome, celular, confirmado, dtExpiracao, vistoPorUltimo, idusuario)"
                        . "VALUES (:id, :nome, :celular, :confirmado, :dtExpiracao, :vistoPorUltimo, :idusuario)";
                $sql = $conn->prepare($sql);
                $uuid = Uuid::uuid4(); //NOVO: GERAR UUID (CÓDIGO ALEATÓRIO)
                $sql->bindValue(':id', $uuid->toString()); //NOVO
                
            }
            
            //relacionar objeto com parametros do banco de dados
            $sql->bindValue(":nome", $obj->getNome()); 
            $sql->bindValue(":celular", $obj->getCelular());
            $sql->bindValue(":confirmado", $obj->getConfirmado());
            $sql->bindValue(":dtExpiracao", $obj->getDtExpiracao());
            $sql->bindValue(":vistoPorUltimo", $obj->getVistoPorUltimo());
            $sql->bindValue(":idusuario", $obj->getUsuarios()->getId());
            
            //executando sql
            if($sql->execute()){
                return $uuid; //novo
            }else{
                return false;
            }
            
        } catch (Exception $e) {
            echo "ERRO: {$e->getMessage()}";
            return false;
        }
    }
    
    //excluir
    public static function excluir($array){
        try{
            $conn = verException(!empty($array['conn']), $array['conn'], 'A conexão não foi aberta');
            $obj = verException(!empty($array['obj']), $array['obj'], 'O objeto não existe!');
            
            //DELETAR TODOS OS CONVIDADOS ONDE ID FOR IGUAL A :ID
            $sql = "DELETE FROM convidados WHERE id=:id";
            $sql = $conn->prepare($sql);
            $sql->bindValue(":id", $obj->getId());
            
            if($sql->execute()){
                return $obj->getId();
            }else{
                return false;
            }
        } catch (Exception $e) {
            echo "ERRO: {$e->getMessage()}";
            return false;
        }
    }
    
    public static function selectQtd($array){
        try{
            $conn = verException(!empty($array['conn']), $array['conn'], 'A conexão não foi aberta!');
                  
            //SELECIONAR QUANTIDADE DE CONVIDADOS TOTAL
            $sql = "SELECT count(*) as qtd FROM convidados";
            $sql = $conn->prepare($sql);
            $sql->execute();
            
            $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($resultado as $ln){
                return $ln['qtd'];
            }
            
            return 0;
        } catch (Exception $e) {
            echo "ERRO: {$e->getMessage()}";
            return false;
        }
    }
    
}


