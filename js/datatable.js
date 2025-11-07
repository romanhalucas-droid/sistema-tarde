
//CODIGO COMEÇA AQUI

  const dataTableLangPtBr = {
     "sEmptyTable": "Nenhum registro encontrado",
     "info": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
     "infoEmpty": "Mostrando 0 até 0 de 0 registros",
     "infoFiltered": "(Filtrados de _MAX_ registros)",
     "infoThousands": ".",
     "lengthMenu": "_MENU_ resultados por página",
     "loadingRecords": "Carregando...",
     "sProcessing": "Processando...",
     "zeroRecords": "Nenhum registro encontrado",
     "sSearch": "Pesquisar",
     "decimal": ',',
     "thousands": '.',
     "oPaginate": {
         "sNext": "<i class='bi bi-caret-right-fill'></i>",
         "sPrevious": "<i class='bi bi-caret-left-fill'></i>",
         "sFirst": "<i class='bi bi-skip-backward-fill'></i>",
         "sLast": "<i class='bi bi-skip-forward-fill'></i>"
     },
     "oAria": {
         "sSortAscending": ": Ordenar colunas de forma ascendente",
         "sSortDescending": ": Ordenar colunas de forma descendente"
     }
 };

 function iniciarTabela(tabela){
     return $(tabela).DataTable({
         language: dataTableLangPtBr
     });
 }


//CÓDIGO TERMINA AQUI, NÃO ESCREVA PARA BAIXO


