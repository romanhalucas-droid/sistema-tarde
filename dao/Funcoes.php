<?php

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


