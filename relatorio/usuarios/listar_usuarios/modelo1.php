<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/html/sistema/util/login/logado.php';

//usa o namespace do DOMPDF
use Dompdf\Dompdf;
use Dompdf\Options;

//INICIAR O DOMPDF
$option = new Options();
$option->set('isHtml5ParserEnabled', true); //ATIVAR HTML5 NO DOMPDF
$option->set('isPhpEnabled', true); //ATIVAR PHP NO DOMPDF
$dompdf = new Dompdf($option); //INICIANDO O DOMPDF

$html = "";
$css = "";
$body = "";
$rodape = "";
$head = "";

//ABRIR BD
require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/conexao/inicio_conexao.php";

//CARREGAR USUÁRIOS
$usuarios = UsuariosDAO::selectAll([
   'conn'  => $conn_db
]);

//FECHAR CONEXÃO
require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/conexao/fim_conexao.php";

$css .= "
    @page {
        margin: 30px 50px 50px 50px;
    }
    table{        
        border-collapse: collapse; /*REMOVER DUPLICAÇÃO DA BORDA NA TABELA*/
        width: 100%;
        table-layout: fixed; /*FIXAR LAYOUT NA PÁGINA*/
        word-wrap: break-word; /*QUEBRAR LINHA NO MEIO DA PALAVRA*/
    }
    
    th, td{
        padding: 5px;
        font-size: 12px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    
    th{
        background-color: #f2f2f2;
    }
    
    h1{
        text-align: center;
    }
";

$head .= "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Listar Usuário - MODELO 1</title>
        <style>{$css}</style>
    </head>
    <body>
";

$body .= "
    <h1>Listagem de usuários</h1>
    <table border='1'>        
    ";

//id, nome, email, cpf, dtnasc, usuario, senha, contato1
$body .= "
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Data de nascimento</th>
                <th>Idade</th>
                <th>Contato 1</th>
            </tr>
        </thead>
    ";

$body .= "<tbody>";

//PERCORRER TODOS OS USUÁRIOS
foreach ($usuarios as $u){
    $body .= "
        <tr>
            <td>{$u->getNome()}</td>
            <td>{$u->getEmail()}</td>
            <td>". dtSqlToBrasil($u->getDtNasc()). "</td>
            <td>". calcularIdade($u->getDtNasc()). "</td>
            <td>{$u->getContato1()}</td>
        </tr>
    ";
}

$body .= "</tbody></table>";

$rodape .= "</body></html>";

$html = $head . $body . $rodape;
$dompdf->loadHtml($html); //carregando o html no dompdf
$dompdf->set_option('defaultFont', 'Arial');
$dompdf->setPaper('A4', 'portrait');//tipo e orientação de papel
$dompdf->render(); //criar o meu pdf
$dompdf->stream('listar_usuarios_modelo1.pdf', ["Attachment" => 0]); //exibir em tela o pdf