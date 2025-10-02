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
            
            //SELECIONAR TODOS OS USUÁRIOS
            $sql->prepare("SELECT * FROM usuarios");
            
            $sql->execute(); //APERTO ENTER
            
            $resultado = $sql->fetchAll(PDO::FETCH_ASSOC); //RECEBER OS RESULTADOS
            
            $objs = array();
            
            foreach ($resultado as $linha){                               
                $objs[] = self::estruturarSQL($conn, $linha);
            }
            
            return $objs;
        } catch (Exception $e) {
            echo "ERRO: {$e->getMessage()}";
            return false;
        }
    }
    
    ///////////////////////////////////////////
    //SALVAR USUÁRIO
    ///////////////////////////////////////////
    public static function salvar($array) {
        try{
            $conn = verException(!empty($array['conn']), $array['conn'], "A conexão não foi aberta!");
            $obj = verException(!empty($array['obj']), $array['obj'], "O objeto não foi enviado!");
            
            if($obj->getId()>0){//SE ID DO USUÁRIO FOR MAIOR QUE 0
                //ATUALIZANDO
                //id, nome, email, cpf, dtnasc, usuario, senha, contato1
                $sql = "UPDATE usuarios SET nome=:nome, email=:email, cpf=:cpf, dtnasc=:dtnasc, usuario=:usuario "
                        . "senha=:senha, contato1=:contato1 WHERE id=:id";
                $sql = $conn->prepare($sql);//PREPARAR SQL
                $sql->bindValue(":id", $obj->getId()); //ENVIAR O VALOR DE ID PARA O CAMPO :ID
            }else{
                //ADICIONANDO NOVO
                $sql = "INSERT INTO usuarios(nome, email, cpf, dtnasc, usuario, senha, contato1) VALUES "
                        . "(:nome, :email, :cpf, :dtnasc, :usuario, :senha, :contato1)";
                $sql = $conn->prepare($sql);//PREPARAR SQL
            }
            
            //ASSOCIAR OBJETO AOS CAMPOS DO BANCO DE DADOS
            $sql->bindValue(":nome", $obj->getNome());
            $sql->bindValue(":email", $obj->getEmail());
            $sql->bindValue(":cpf", $obj->getCpf());
            $sql->bindValue(":dtnasc", $obj->getDtNasc());
            $sql->bindValue(":usuario", $obj->getUsuario());
            $sql->bindValue(":senha", $obj->getSenha());
            $sql->bindValue(":contato1", $obj->getContato1());
            
            if($sql->execute()){
                //SE ID DO OBJETO FOR VAZIO ENTÃO:
                    //PUXAR O ÚLTIMO ID INSERIDO NA CONEXÃO
                //SENÃO
                    //O ID SERÁ O PRÓPRIO ID DO OBJETO CRIADO
                $id = empty($obj->getId()) ? $conn->lastInsertId() : $obj->getId();
                return $id; //CASO ESTEJA TUDO CERTO, RETORNAR O ID DO USUARIO CRIADO
            }else{
                //CASO ALGO DE ERRADO, RETORNAR FALSO
                return false;
            }
            
        } catch (Exception $e) {
            echo "ERRO: {$e->getMessage()}";
            return false;
        }
    }
    
    ///////////////////////////////////////////
    //EXCLUIR
    ///////////////////////////////////////////
    public static function excluir($array){
        try{
            $conn = verException(!empty($array['conn']), $array['conn'], "A conexão não foi aberta!");
            $obj = verException(!empty($array['obj']), $array['obj'], "O objeto não foi enviado!");
            
        } catch (Exception $e) {
            echo "ERRO: {$e->getMessage()}";
            return false;
        }
    }
    
    
}


