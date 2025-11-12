<!DOCTYPE html>
<html>
    <head>
        <title>LOGIN | SISTEMA</title>
        <?php include $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/estrutura/cabecalho.php" ?>
    </head>
    <body>
        <div class="container d-flex justify-content-center align-items-center" style="height: 100vh">
            <div class="card bg-light mt-1 w-100 shadow-sm border-0" style="max-width: 30rem; /*MAXIMO LARGURA */">
                <div class="card-body">
                    <div class="resultado"></div>
                    
                    <form id="formLogin" name="formLogin" method="POST" action="/html/sistema/validacao/login/login.php">
                        
                        <div class="form-floating">
                            
                            <input
                                type="text"
                                placeholder="Usuário..."
                                class="form-control"
                                id="usuario"
                                name="usuario"
                                autocomplete="username"
                                autofocus
                                required
                            />
                            <label for="usuario"><i class="bi bi-person-circle" aria-hidden="true"></i> Digite o usuário...</label>
                            
                        </div>
                        
                        <div class="form-floating mt-1 mb-3">
                            
                            <input
                                type="password"
                                placeholder="Senha..."
                                class="form-control"
                                id="senha"
                                name="senha"
                                minlength="8"
                                autocomplete="current-password"
                                required
                            />
                            <label for="senha"><i class="bi bi-shield-lock" aria-hidden="true"></i> Digite a senha...</label>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <button
                                    type='submit'
                                    id='btnlogar'
                                    name='btnlogar'
                                    class='btn btn-lg w-100 btn-primary'
                                >
                                    <i class='bi bi-door-open-fill'></i> Entrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
        <script nonce='<?= uniqid()?>'>
            //EVENTO AO CLICAR EM ENTRAR (SUBMIT)
            $("#formLogin").submit(function (e){                
                e.preventDefault(); //CANCELAR OPERAÇÃO PADRÃO DE SUBMIT, POIS SERA FEITA VIA AJAX(JAVASCRIPT)
                
                $(document).ajaxStart(loading()).ajaxStop($.unblockUI);//carregando ao efetuar operação
                
                let form = $('#formLogin'); //carregando formulário dentro de uma variavel
                
                //executar operação post (ajax)
                $.post(form.attr('action'), form.serialize(), function(retorno){
                   $('.resultado').html(retorno);
                });
            });
        </script>                
    </body>
</html>


