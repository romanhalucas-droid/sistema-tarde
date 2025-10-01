<?php
require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/login/logado.php";
require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/obj/Usuarios.php";

class UsuariosDAO{
    
    private static function estruturarSQL($conn, $linha){
        $obj = new Usuarios(null);
        $obj->setId($linha['id']);
        $obj->setNome($linha['nome']);
        $obj->setEmail($linha['email']);
        $obj->setCpf($linha['cpf']);
        $obj->setDtNasc($linha['dtnasc']);
        $obj->setUsuario($linha['usuario']);
        $obj->setSenha($linha['senha']);
        $obj->setContato1($linha['contato1']);
        
        return $obj;
    }


    public static function selectIndex($array){
        try{
            //SE CONEXÃO FOR DIFERENTE DE VAZIO ENTÃO SALVAR CONEXÃO NA VARIÁVEL, SENÃO, EMITIR MENSAGEM DE ERRO
            $conn = verException(
                    !empty($array['conn']), 
                    $array['conn'], 
                    "A conexão não foi aberta!"
            );
            
            //SE ID FOR DIFERENTE DE VAZIO ENTÃO SALVAR ID NA VARIÁVEL, SE NÃO, SALVAR VAZIO NA VARIÁVEL.
            $id = !empty($array['id']) ? $array['id'] : null;
          
            //SELECIONAR TODOS OS USUÁRIOS ONDE ID É IGUAL A :ID
            $sql = $conn->prepare("SELECT * FROM usuarios WHERE id=:id");
            $sql->bindValue(":id", $id); //ENVIANDO VALOR DA VARIÁVEL ID PARA SUBSTITUIR :ID
            
            $sql->execute();//EXECUTAR SQL
            
            //RECEBENDO O RESULTADO DA CONSULTA E SALVANDO NA VARIÁVEL RESULTADO           
            $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            $objs = array(); //INCIANDO ARRAY PARA ARMAZENAR OS OBJETOS
            
            //PARA CADA RESULTADO SERÁ CHAMADO DE LINHA.
            //FOREACH SERVE PARA PERCORRER CADA ELEMENTO DE UM ARRAY OU OBJETO E EXECUTAR UMA FUNÇÃO
            //ESPECÍFICA PARA CADA UM DELES
            foreach ($resultado as $linha){                               
                $objs[] = self::estruturarSQL($conn, $linha);//CRIAR NOVO OBJETO DENTRO DO ARRAY QUE ARMAZENA OS OBJETOS
            }
            
            return $objs;//RETORNAR OBJETOS        
            
        } catch (Exception $e) {
            echo "ERRO: {$e->getMessage()}";
            return false;
        }
    }
    
    //SELECIONAR TODOS OS USUÁRIOS
    public static function selectAll($array) {
        try{
            $conn = verException(
                    !empty($array['conn']), 
                    $array['conn'], 
                    "A conexão não foi aberta!"
            );
            
            
        } catch (Exception $e) {

        }
    }
    
}


