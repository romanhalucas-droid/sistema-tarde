function loading(){
    $.blockUI({
        message: '<div class="spinner-border text-warning me-1" role="status"></div>\n\
        <div class="align-items-center">Carregando...</div>' 
    });
    //FUNÇÃO PARA AJUSTAR O FRONT-END DO CARREGANDO APÓS EFETUAR UMA REQUISIÇÃO AJAX
}

//GARANTIR QUE O BLOCKUI FIQUE POR CIMA DE TODOS ELEMENTOS DA PÁGINA
$.blockUI.defaults.overlayCSS.zIndex = 1061;

$.blockUI.defaults.css = {
    padding: 0,
    margin: 0,
    width: '30%',
    top: '40%',
    left: '35%',
    textAlign: 'center',
    color: '#fff',
    cursor: 'wait',
    position: 'fixed',
    zIndex: 1061
};

//RETORNAR DATA E HORA ATUAL
function getDateHour(){
    let d = new Date();
    let datahora = (d.toLocaleString());
    return datahora;
}

//CRIAR CAIXA DE RETORNO PARA O USUÁRIO =D
function retornoToast(retorno, datahora){
    Cookies.set('retornoativo', 1, { secure: true });
    Cookies.set('retorno', retorno, { secure: true });
    Cookies.set('retornodatahora', datahora, { secure: true });
    
    let toastLive = document.getElementById('liveToast');
    let toast = new bootstrap.Toast(toastLive);
    
    document.getElementById('dataToast').innerHTML = datahora;
    document.getElementById('conteudo-toast').innerHTML = retorno;
    
    toast.show();
}

$(document).ready(function (){
    window.addEventListener('readystatechange', function(e){
       clearConsole(); 
    });
    
    //VERIFICAR SE CAIXA DE NOTIFICAÇÃO ESTÁ ABERTA
    if(Cookies.get('retornoativo')==1){
        retornoToast(Cookies.get('retorno'), Cookies.get('retornodatahora'));
    }
    
    //FECHAR E FINALIZAR TOAST
    $('#btnCloseToast').on('click', function (){
       Cookies.remove('retornoativo'); 
       Cookies.remove('retorno'); 
       Cookies.remove('retornodatahora'); 
    });
    
});


