<?php

//VERIFICAR SE O USUÁRIO ESTÁ LOGADO
require_once $_SERVER['DOCUMENT_ROOT']. "/html/sistema/util/login/logado.php";

//RECEBER O ID DO USUÁRIO VIA GET (ESCOLHA DO USUÁRIO)
//!!!!!ATENCÃO!!!!!
//SE ID RECEBIDO FOR IGUAL A 0 (zero) SIGNIFICA QUE O USUÁRIO QUER CRIAR UM NOVO REGISTRO
$id = !empty($_GET['id']) ? $_GET['id'] : 0;

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!--INCLUIR CABEÇALHO -->
        <?php include $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/estrutura/cabecalho.php"; ?>
        <title>CADASTRAR | USUÁRIOS</title>
    </head>
    <body class="bg-light">
        <!--INCLUIR MENU DO SITE -->
        <?php include $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/estrutura/menu.php" ?>
        
        <?php
        //SE ID FOR IGUAL A 0 ENTÃO
        if($id==0){
            //ADICIONAR NOVO REGISTRO
            /*$id $nome $email $dtNasc $usuario $senha $cpf $contato1*/
            $id = 0;
            $nome = "";
            $email = "";
            $dtnasc = "";
            $usuario = "";
            $senha = "";
            $cpf = "";
            $contato1 = "";
        }else{
            //EDITAR REGISTRO
            ///abrir conexão
            require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/conexao/inicio_conexao.php";
            
            $obj = UsuariosDAO::selectIndex([
               'conn' => $conn_db,
               'id' => $id
            ]); //LISTANDO O USUÁRIO POR ID UTILIZANDO BANCO DE DADOS
            
            //CARREGAR INFORMAÇÕES NAS VARIÁVEIS
            $id = $obj[0]->getId();
            $nome = $obj[0]->getNome();
            $email = $obj[0]->getEmail(); //<<<<<<<<<<<<<<<<<<< novo (esqueci)
            $dtnasc = $obj[0]->getDtNasc();
            $usuario = $obj[0]->getUsuario();
            $senha = $obj[0]->getSenha();
            $cpf = $obj[0]->getCpf();
            $contato1 = $obj[0]->getContato1();
            
            //fechar conexão
            require_once $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/conexao/fim_conexao.php";
        }
        ?>
        
        <!-- INICIO DO FRONT-END DO FORMULÁRIO -->
        <div class="container shadow-sm mt-sm-2 bg-white p-3 rounded-3">
            <h3>Cadastro de Usuários:</h3>
            <hr>
            <!-- INICIO DO FORMULÁRIO -->
            <form 
                name="formcadastrarusuario" id="formcadastrarusuario" 
                action="/html/sistema/validacao/usuarios/salvar.php" method="post"
            >                
                <!-- id nome email dtNasc usuario senha cpf contato1 -->
                <?php if($id==0): ?>
                    <!-- caixa de texto invisivel -->
                    <input class='form-control' type='hidden' id='id' name='id'
                           value='<?=htmlspecialchars($id)?>' required readonly>
                <?php else: ?>
                    <div class='form-floating'>
                        <!-- caixa de texto visivel -->
                        <input class='form-control' type='text' id='id' name='id'
                               value='<?=htmlspecialchars($id)?>' required readonly> 
                        <label for='id'>Código</label>
                    </div>
                <?php endif ?>
                  
                <div class='row'><!--linha tamanho máximo (12)-->
                    <div class='col-sm-6'><!-- coluna tamanho 6 (máximo 12) -->
                        
                        <!-- nome do usuário -->
                        <div class='form-floating mt-1'>
                            <input type='text' class='form-control obrigatorio' id='nome'
                                   name='nome' value='<?= htmlspecialchars($nome) ?>'
                                   placeholder="Nome do usuário..." required>
                            <label for='nome'>Nome do usuário:</label>
                        </div> 
                        
                    </div>
                    <div class='col-sm-6'><!-- coluna tamanho 6 (máximo 12) -->
                    
                        <!--email do usuario-->
                        <div class="form-floating mt-1">
                            <input type="email" class="form-control obrigatorio" value="<?=$email?>"
                                   name="email" id="email" placeholder="Email..." required>
                            <label for='email'>E-mail:</label>
                        </div>
                        
                    </div>
                </div>
                    
                <div class="row">                    
                    <div class='col-sm-6'>
                        
                        <!--contato1-->
                        <div class="form-floating mt-1">
                            <input type="text" class="form-control" value="<?= htmlspecialchars($contato1)?>"
                                   name="contato1" id="contato1" placeholder="Digite o número...">
                            <label for="contato1">Contato 1:</label>
                        </div>
                        <script>
                            $('#contato1').mask('(00) 00000-0000');
                        </script>
                        
                    </div>
                    <div class='col-sm-6'>
                        
                        <!--data nascimento -->
                        <?php
                        
                            function dtSqlToBrasil($data){
                                //pre: RECEBER A DATA NO FORMATO DE SQL PARA SER CONVERTIDA
                                //POS: retornar data no formato brasileiro
                                if(!empty($data)){//verificar se existe data
                                    $temp = explode('-', $data);
                                    return "{$temp[2]}/{$temp[1]}/{$temp[0]}";
                                }else{
                                    return "";
                                }
                            }
                        ?>
                        
                        <div class='form-floating mt-1'>
                            <input type='text' class='form-control' value='<?= dtSqlToBrasil($dtnasc)?>'
                                   id='dtnasc' name='dtnasc' placeholder="Data de nascimento..." required>
                            <label for='dtnasc'>Data de nascimento:</label>
                        </div>
                        
                        <script>
                            $("#dtnasc").mask('00/00/0000', {reverser: false});
                            
                            function getDataMaxima(){
                                const hoje = new Date();
                                hoje.setFullYear(hoje.getFullYear() - 16);
                                return hoje;
                            }
                                                        
                            $('#dtnasc').datepicker({
                                language: 'pt-BR',
                                format: 'dd/mm/yyyy',
                                startView: 2,
                                endDate: getDataMaxima()
                            });
                        </script>    
                        
                    </div>
                </div>
                
                <div class="row">
                    <div class='col-sm-6'>
                        <div class='form-floating mt-1'>
                            <input type='text' class='form-control' id='cpf' name='cpf' placeholder="Cpf..."
                                   maxlength="14" value='<?=$cpf ?>' required>
                            <label for='cpf'>CPF:</label>
                        </div>
                        <script>
                            $("#cpf").mask('000.000.000-00');
                        </script>                         
                    </div>
                    <div class='col-sm-6'>
                        <div class='form-floating mt-1'>
                            <input type='text' class='form-control' value='<?=$usuario?>' name='usuario' id='usuario'
                                   placeholder='Usuário...'>
                            <label for='usuario'>Usuário:</label>
                        </div>
                    </div>
                </div>
                    
                <div class='row'>
                    
                    <div class='col-sm-6'>
                        <!--SENHA-->
                        <div class='form-floating d-flex align-items-center mt-1'>
                            <input required type='password' class='form-control me-1' value='<?=$senha?>'
                                   name='senha' id='senha' minlength="8" placeholder="Senha...">
                            <label for='senha'>Senha:</label>
                            <!-- OLHO -->
                            <a id='olho1' class='btn btn-secondary p-2 rounded-3 text-white' style='font-size: 26px;'>
                                <i class='bi bi-eye-fill'></i>
                            </a>
                        </div>
                        <script>
                            let olho1 = false;
                            
                            $('#olho1').click(function(){
                                if(olho1 === true) {
                                   olho1 = false;
                                   $('#senha').attr("type", "password");
                                   $('#olho1').html("<i class='bi bi-eye-fill'></i>");
                                }else{
                                   olho1=true;
                                   $('#senha').attr("type", 'text');
                                   $('#olho1').html("<i class='bi bi-eye-slash-fill'></i>");
                                }
                            });
                        </script>
                    </div>
                    
                    <div class='col-sm-6'>
                        <div class='form-floating d-flex align-items-center mt-1'>
                            <input required type='password' class='form-control me-1' value="<?=$senha?>"
                                   name="confirmarsenha" id="confirmarsenha" minlength="8" placeholder="Confirmar senha...">
                            <label for="confirmarsenha">Confirmar Senha:</label>
                            <a id="olho2" class="btn btn-secondary p-2 rounded-3 text-white" style="font-size: 26px">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </div>
                        <script>
                            let olho2 = false;                            
                            const folho2 = function (){
                                if(olho2 === true){
                                    olho2=false;
                                    $("#confirmarsenha").attr("type", "password");
                                    $("#olho2").html("<i class='bi bi-eye-fill'></i>");
                                }else{
                                    olho2=true;
                                    $("#confirmarsenha").attr("type", "text");
                                    $("#olho2").html("<i class='bi bi-eye-slash-fill'></i>");
                                }
                            };
                            
                            $("#olho2").click(folho2);                            
                        </script>
                    </div>
                </div> 
                    
                <!--BOTOES -->
                <div class="row mt-2">
                    <div class='col'>
                        <!-- voltar -->
                        <a href="/html/sistema/view/usuarios/listar.php" class="btn w-100 btn-warning">
                            <i class='bi bi-arrow-left-circle'></i> Voltar
                        </a>
                    </div>
                    <div class='col'>
                        <!-- exluir -->                      
                        <a id='btnExc' name='btnExc' class='btn w-100 btn-danger'>
                            <i class='bi bi-backspace-fill'></i> Excluir
                        </a>
                    </div>
                    <div class='col'>
                        <!-- salvar -->
                        <button type='submit' id='btnsalvar' name='btnsalvar' class='btn w-100 btn-primary'>
                            <i class='bi bi-check2-square'></i> Salvar
                        </button>
                    </div>
                </div>
            </form>
            <!-- FIM DO FORMULÁRIO -->
        </div>
        
        
        <!--INCLUIR RODAPE DO SITE -->
        <?php include $_SERVER['DOCUMENT_ROOT']."/html/sistema/util/estrutura/rodape.php" ?>
    </body>
</html>



