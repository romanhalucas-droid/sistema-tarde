<?php
function conDB(){
    try{
        $username = "root";
        $senha = "root";
        $ip = "127.0.0.1"; //mesma coisa que localhost
        $port = "3306";
        $dbname = "sistema";

        //abrir conexão
        //equivalente mysql -u root -p

        $conn = new PDO(
                "mysql:host={$ip};port={$port};dbname={$dbname}",
                $username,
                $senha,
                [PDO::ATTR_PERSISTENT => true]
        );
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conn;
    } catch (PDOException $e){
        echo "ERRO DB: ".$e->getMessage();
    } catch (Expection $e){
        echo "ERRO: ".$e->getMessage();
    }
}