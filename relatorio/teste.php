<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/html/sistema/util/login/logado.php';


//USA O NAMASPACE DO DOMPDF
use Dompdf\Dompdf;
use Dompdf\Options;

//INICIAR DOMPDF
$option = new Options();
$option->set('isHtml5ParserEnabled', true); //ATIVANDO HTML5 NO DOMPDF
$option->set('isPhpEnabled', true); //ATIVAR PHP NO DOMPDF

//INSTANCIAR O DOMPDF
$dompdf = new Dompdf($option); //RECEBE COMO PARAMETRO A OPÇÃO CRIADA ANTERIORMENTE

//MONTANDO BASE PARA ESTRUTURA DO DOMPDF
$head = ""; //INICIAR CABEÇALHO
$css = ""; //ESTILO DO PDF (HTML)
$body = ""; //CORPO DO PDF (HTML)
$rodape = ""; //RODAPÉ DO PDF (HTML)
$html = ""; //JUNÇÃO DE TODAS AS ESTRUTURAS

$css .= "
    @page {
        margin: 30px 50px 50px 50px;
    }
    body{
        font-family: Arial;
    }
    h1{
        text-align: center;
        font-weight: bold; /* colocar negrito */
        background-color: #000; /* fundo preto do titulo */
        color: #fff; /*cor do texto branco */
        padding: 16px;
        border-radius: 16px;
    }
    p{
        font-size: 26px;
        text-align: justify;
    }
    #rodape{
        position: fixed; /*posição fixa*/
        top: -20; /*ajustar de forma fixa no topo (em cima)*/
        right: -10; /*ajustar a direta de forma fixa >>>> */        
    }
    
    #rodape .page:after{
        content: counter(page); /*mudar conteudo da class page do rodape com contagem de page*/
    }
    ";

//MONTAR CABEÇALHO
$head .= "
        <!DOCTYPE html>
        <html lang=\"UTF-8\">
        <head>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Relatório para teste</title>
            <style>{$css}</style>
        </head>
        <body>
    ";

$body .= "
        <h1>Estou testando meu PDF no SENAC na turma da TARDE</h1>
        <p>É muito legal testar PDF usando DOMPDF xD</p>
    ";

$rodape .= "
        <div id='rodape'><p class='page'></p></div>

        </body>
        </html>
    ";

//MONTANDO A ESTRUTURA HTML PARA GERAR O PDF
$html .= $head . $body . $rodape;

//CARREGAR DOMPDF (GER$htmlAR PDF, FINALMENTE =D)
$dompdf->loadHtml($html); //CARREGANDO O HTML NO DOMPDF
$dompdf->setPaper('A4', 'portrait'); //TIPO DE PAPEL E ORIENTAÇÃO DA PÁGINA
$dompdf->render(); //CRIANDO O PDF, NÃO É POSSÍVEL EFETUAR ALTERAÇÃO MAIS
$dompdf->stream('teste.pdf', ["Attachment" => 0]); //EXIBIR O PDF EM TELA








