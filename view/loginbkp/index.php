<?php
    session_start(); //INICIAR SESSÃO
    
    // Verifica se a sessão existe e se a chave "logadosistema" está definida como verdadeiro
    if(isset($_SESSION) AND isset($_SESSION['logadosistema']) AND $_SESSION['logadosistema']==true){
        //REDIRECIONAR PARA O INICIO
        header('location:/html/sistema/view/inicio/');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">          
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.js"></script>
        <link href="style.css?v=<?= uniqid() ?>" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="container">
            <?php
                $erro = false;
            
                //VERIFICAR SE A PESSOA ESTÁ TENTANDO FAZER LOGIN
                if(!empty($_POST)){
                    //SE METHOD POST FOR DIFERENTE DE VAZIO                  
                    //RECEBENDO AS INFORMAÇÕES DO FORMULÁRIO
                    $usuario = $_POST['usuario'];
                    $senha = $_POST['senha'];                                                                                
                    
                    //VERIFICAR SE USUÁRIO DIGITADO ESTÁ CORRETO
                    if($usuario=="admin" AND $senha=="inspira"){
                        //USUÁRIO ENTROU COM SUCESSO
                        session_regenerate_id();
                        $_SESSION['logadosistema']  = true;
                        $_SESSION['usuariosistema'] = $usuario;
                        $_SESSION['nomesistema'] = "Lucas Barbosa Romanha";                        
                        
                        ?><div class="sucesso">Usuário logado com sucesso!</div><?php
                        
                        //REDIRECIONAR PARA PÁGINA DE INICIO
                        header('location:/html/sistema/view/inicio/');
                    }else{//SENÃO
                        //USUÁRIO E/OU SENHA INVÁLIDOS
                        $erro = true;
                        ?><div class="erro">Usuário e/ou senha inválidos</div><?php
                    }
                    
                }
            
            ?>

            <?php if(empty($_SESSION['logadosistema']) OR $_SESSION['logadosistema'] == false): ?>
            <div id="clogin" class="clogin">
                <form action="#" method="POST">
                    <label>Usuário:</label><br>     
                    <input
                        name="usuario"
                        id="usuario"
                        type="text"
                        placeholder="Digite o seu usuário..."                        
                        <?=($erro==false) ? "autofocus" : "" ?>
                        value="<?=($erro==true) ? $usuario : "" ?>"
                        required
                    >   
                    <br>
                    <label>Senha:</label><br>       
                    <div style="display: flex; align-items: center"><!--ABRE AQUI-->
                        <input
                            name="senha"
                            id="senha"
                            type="password"
                            placeholder="Digite a sua senha..."
                            <?= ($erro==true) ? "autofocus" : "" ?>
                            required
                        >                    
                        <button id="olho" type="button">Mostrar</button>
                        <script>
                            let olho = false;
                            $("#olho").click(function(){
                                if(olho===false){
                                    olho=true;
                                    $("#senha").attr('type', 'text');
                                    $("#olho").html("Ocultar");
                                }else{
                                    olho=false;
                                    $("#senha").attr('type', 'password');
                                    $("#olho").html("Mostrar");
                                }
                            });
                        </script>
                    </div><!-- FECHA AQUI -->
                    <br>
                    <div class="botoes">
                        <input class="botao" type="reset" value="Limpar">
                        <input class="botao" type="submit" value="Entrar">
                    </div>
                </form>
            </div>
           <?php endif; ?>
        </div>
    </body>
</html>


