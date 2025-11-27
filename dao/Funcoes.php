<?php
function verException($logica, $valor, $message){
    //SE LOGICA ENVIADA FOR IGUAL A VERDADEIRA
    if($logica){
        //RETORNAR VALOR PARA VARIÁVEL
        return $valor;
    }else{//SENÃO
        //GERAR UM EXCEPTION COM UMA MENSAGEM PERSONALIZADA
        throw new Exception($message);
    }
}


function saudacao(){
    //PRE: NÃO EXIGE PARAMETROS
    //POS: RETORNAR BOM DIA, BOA TARDE OU BOA NOITE
    
    date_default_timezone_set('America/Sao_Paulo'); //DEFININDO FUSO
    //date_default_timezone_set('Asia/Tokyo'); //DEFININDO FUSO
    $hora = date('H'); //PEGAR SOMENTE A HORA ATUAL
    
    if($hora >= 5 AND $hora <12){
        return [
            "msg" => "Bom dia",
            "turno" => 1
        ];
    }else if ($hora >= 12 AND $hora <=18){
        return [
            "msg" => "Boa tarde",
            "turno" => 2
        ];
    }else{
        return [
            "msg" => "Boa noite",
            "turno" => 3
        ];
    }
}

//Converter data no formato de SQL para formato Brasileiro
function dtSqlToBrasil($data){
    if(!empty($data)){
        $temp = explode("-", $data);
        return "{$temp[2]}/{$temp[1]}/{$temp[0]}";        
    } else{
        return "";
    }
}

//Converter data no formato Brasileiro para SQL
function dtBrasilToSql($data){
    if(!empty($data)){
        $temp = explode("/", $data);
        return "{$temp[2]}/{$temp[1]}/{$temp[0]}";  
    }else{
        return "";
    }
}

//tirar qualquer simbolo ou letra de um texto (deixar somentes números)
function deixarNumero($string){
    return !empty($string) ? preg_replace("/[^0-9]/", "", $string) : NULL;
}

//função para calcular idade de uma pessoa enviando a data de nascimento no seguite
//formato: ANO-MES-DIA (string/texto/cadeia)
function calcularIdade($dataNascimento){
    date_default_timezone_set('America/Sao_Paulo'); //DEFININDO FUSO
    
    //criar um objeto DateTime com a data de nascimento
    $nascimento = new DateTime($dataNascimento);
    $hoje = new DateTime();
    
    //calcular diferença
    $idade = $hoje->diff($nascimento);
    
    return $idade->y;
}






