<?php
    // chamando arquivos externos
    require_once "verificacao.php";
    require_once "../conexao_banco.php";

    // verificando se o usuario tem permissão para acessar essa página
    require_once "autenticacao_nivel.php";
    $permissao = [1,3];
    autenticar($permissao);

// criando variaveis
$nome= "";
$telefone = "";
$email = "";
$rua = "";
$numero = "";
$cep = "";
$cidade = "";
$idEstado = "";
$foto ="";
$status = 0;
$botao = "Salvar";
// verificando se o formulario foi submetido
if(isset($_POST['txtNome'])){
    // reesgatando as informações via método POST
    $nome = $_POST['txtNome'];
    $telefone = $_POST['txtTelefone'];
    $email = $_POST['txtEmail'];
    $rua = $_POST['txtLogradouro'];
    $numero = $_POST['txtNumero'];
    $cep = $_POST['txtCep'];
    $cidade = $_POST['txtCidade'];
    $idEstado = $_POST['txtEstado'];
    $foto = $_POST['txtFoto'];
    $status = 1;
    // verificando se o botao está como SALVAR OU EDITAR
    if($_GET['btnSalvar'] == "Salvar"){
        // sql de SALVAR
        $sql = "INSERT INTO tbl_loja (nome, telefone, email, logradouro, numero, cep, cidade, foto, idEstado, status) ";
        $sql .= "VALUES ('".$nome."', '".$telefone."', '".$email."', '".$rua."', '".$numero."', '".$cep."', '".$cidade."', '".$foto."', '".$idEstado."', '".$status."')";
    } else if($_GET['btnSalvar'] == "Editar"){
        // sql de EDITAR
        $sql = "UPDATE tbl_loja SET
        nome = '".$nome."',
        telefone = '".$telefone."',
        email = '".$email."',
        logradouro = '".$rua."',
        numero = '".$numero."',
        cep = '".$cep."',
        cidade = '".$cidade."',
        foto = '".$foto."',
        idEstado = '".$idEstado."'
        WHERE id = ".$_SESSION['idSessao'];
    }
    // executando o comando e redirecionando a pagina
    mysql_query($sql);
    header('location:lojas.php');
}

// verificando se a variavel modo existe na url
if(isset($_GET['modo'])){
    // resgatando a variavel modo
    $modo = $_GET['modo'];

    // verificando como esta escrito a variavel modo
    if($modo == 'excluir'){
        // resgatando o id da url
        $id = $_GET['id'];
        // sql de excluir um registro
        $sql = "DELETE FROM tbl_loja WHERE id = ".$id;
        // executando no banco
        mysql_query($sql);
    } else if ($modo == 'status'){
        // resgatando oo parametros da url
        $id = $_GET['id'];
        $status = $_GET['status'];

        // atualizando o status do registro
        if($status == 1){
            $sql = "UPDATE tbl_loja SET status = 0 WHERE id = ".$id;
        } else {
            $sql = "UPDATE tbl_loja SET status = 1 WHERE id = ".$id;
        }

        // executando no banco
        mysql_query($sql);
    } else if($modo == 'consultar'){
        // resgatando o id da url
        $id = $_GET['id'];

        // sql de consultar um registro
        $sql = "SELECT * FROM tbl_loja WHERE id = ".$id;

        // executando no banco
        $result = mysql_query($sql);

        // if que resgatará as informações do banco
        if($loja = mysql_fetch_array($result)){
            // resgatando as informações do banco
            $id = $loja['id'];
            // passando o id do registro para a variavel de sessao
            $_SESSION['idSessao'] = $id;

            // resgatando as informações do banco
            $nome = $loja['nome'];
            $telefone = $loja['telefone'];
            $email = $loja['email'];
            $rua = $loja['logradouro'];
            $numero = $loja['numero'];
            $cep = $loja['cep'];
            $cidade = $loja['cidade'];
            $foto = $loja['foto'];
            $idEstado = $loja['idEstado'];
            $botao = "Editar";
        }
    }
}
?>

<!-- inicio do codigo html -->
<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Geranciamento - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleLojas.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script>
//            Evento padrão para carregar as funções em jQuery,
//            é obrigatório usar esse evento para colocar as
//            funções do projeto
            $(document).ready(function(){
//              Função para o estado live do objeto file, que seria
//              quando o objeto for modificado pelo evento change
               $('#fotos').live('change', function(){

                   $('#foto').html('<img src=imagens/ajax-loader.gif>');

               setTimeout(function(){
//                   Forçando via Ajax um submit  dor form da foto,
//                   já que não temos um botão
                  $('#frmFoto').ajaxForm({
//                        target:'#foto'; -  é o retorno da imagem na div foto
//                        CallBack do formulario(Retorno do resultado do formulario)
                        target:'#foto'
                    }).submit();
                   },2000);
               });

//                Function para o evento click do btnSalvar
                $('#btnSalvar').click(function(){
//                    Coloca um GIF animado na div foto, ficando 2 segundos até fazer o submit
//                    no formulário, para isso usamos o setTimeout
                    $('#foto').html('<img src=imagens/ajax-salvando.gif>');

                    setTimeout(function(){
                        $('#frmCadastro').submit();
                    },2000);

                });
            });

            // mascara de telefone
            function formatPhone(obj, id){
                if(id == 'telefone'){
                    var numbers = obj.value.replace(/\D/g, ''),
                        char = {0: '(', 2: ') ', 6: '-'};
                    obj.value = '';
                    for(var i = 0; i < numbers.length; i++){
                        obj.value += (char[i] || '') + numbers[i];
                    }
                } else {
                    var numbers = obj.value.replace(/\D/g, ''),
                    char = {0: '(', 2: ') ', 7: '-'};
                    obj.value = '';
                    for(var i = 0; i < numbers.length; i++){
                        obj.value += (char[i] || '') + numbers[i];
                    }
                }

            }

            // função de bloqueio de caracteres ou numeros
            function validar(caracter, blockType, campo){
                document.getElementById(campo).style="background-color:#FFFFFF;";
//              Tratamento para verificar em qual tipo de navegador está vindo a tecla
                if(window.event){
//                  Recebe a ascii do IE
                    var letra = caracter.charCode;
                } else {
//                  Recebe a ascii dos outros navegadores
                    var letra = caracter.which;
                }


                if(blockType == 'caracter'){
//                  bloqueio de caracteres
                    if(letra<48 || letra>57){
                        if(letra != 8 && letra!=32 && letra!=45){
/*                          Troca a cor do elemento conforme for bloqueado
                            A variavel campo é recebida na função, nela contem o ID  do elemento a ser formatado
*/
                            document.getElementById(campo).style="background-color:#F4A1A1;";
                            return false;
                        }
                    }
                } else if(blockType == 'number') {
//                  bloqueio de numeros
                    if(letra>=48 && letra<=64){
                        document.getElementById(campo).style="background-color:#F4A1A1;";
                        return false;
                    }
                }
            }

            // mascara de cep
            function formatCep(obj, id){
                if(id == 'txtCep'){
                    var numbers = obj.value.replace(/\D/g, ''),
                        char = {5: '-'};
                    obj.value = '';
                    for(var i = 0; i < numbers.length; i++){
                        obj.value += (char[i] || '') + numbers[i];
                    }
                }
            }
        </script>
    </head>
    <body>
        <div id="main">
            <header>
                <!-- chamando o arquivo do menu -->
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
<!--
                campos separados por linhas
                linha nome unidade, telefone e email
-->
                <form name="frmCadastro" method="post" action="lojas.php?btnSalvar=<?php echo($botao);?>" id="frmCadastro">
                    <input type="hidden" name="txtFoto" value="<?php echo($foto);?>">
                    <section class="linhas_campos">
                        <div class="campos">
                            <div class="subtitulo">
                                Nome da Unidade
                            </div>
                            <input type="text" name="txtNome" value="<?php echo($nome);?>" maxlength="70" required>
                        </div>

                        <div class="campos">
                            <div class="subtitulo">
                                Telefone
                            </div>
                            <input type="tel" name="txtTelefone" id="telefone" value="<?php echo($telefone);?>" maxlength="14" onkeypress="formatPhone(this, id); return validar(event, 'caracter', 'telefone')" required>
                        </div>

                        <div class="campos">
                            <div class="subtitulo">
                                Email para contato
                            </div>
                            <input type="email" name="txtEmail" value="<?php echo($email);?>" maxlength="50" required>
                        </div>
                    </section>
        <!--                linha nome rua, numero e cep -->
                    <section class="linhas_campos">
                        <div class="campos" id="logradouro">
                            <div class="subtitulo">
                                Rua
                            </div>
                            <input type="text" name="txtLogradouro" id="txtLogradouro" value="<?php echo($rua);?>" onkeypress="return validar(event, 'number', 'txtLogradouro')" maxlength="255" required>
                        </div>

                        <div class="campos" id="numero">
                            <div class="subtitulo">
                                Número
                            </div>
                            <input type="number" name="txtNumero" id="txtNumero" value="<?php echo($numero);?>" maxlength="11" required onkeypress="return validar(event, 'caracter', 'txtNumero')">
                        </div>

                        <div class="campos">
                            <div class="subtitulo">
                                CEP
                            </div>
                            <input type="email" name="txtCep" id="txtCep" value="<?php echo($cep);?>" maxlength="9" required onkeypress="formatCep(this, id); return validar(event, 'caracter', 'txtCep')">
                        </div>
                    </section>
        <!--                linha cidade ,estado e foto -->
                    <section class="linhas_campos">
                        <div class="campos">
                            <div class="subtitulo">
                                Cidade
                            </div>
                            <input type="text" name="txtCidade" value="<?php echo($cidade);?>" maxlength="70" required>
                        </div>

                        <div class="campos" id="numero">
                            <div class="subtitulo">
                                Estado
                            </div>
                            <select name="txtEstado">
                                <?php
                                    // select que retornará os estados
                                    $sql = "SELECT * FROM tbl_estado";
                                    // executando no banco
                                    $result = mysql_query($sql);
                                    // loop que resgatará todos os registros
                                    while($estados = mysql_fetch_array($result)){
                                        // esse if serve para quando estiver no modo editar, o select vim selecionado
                                        // com a opção correta de acordo com o registro
                                        if($estados['id'] == $idEstado && $modo == 'consultar'){
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                ?>
                                    <!-- opções do select sendo carregado dentro do while -->
                                    <option <?php echo($selected);?> value="<?php echo($estados['id']);?>"><?php echo($estados['nome']);?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div id="botao">
                                <input type="button" id="btnSalvar" value="<?php echo($botao);?>" name="btnSalvar" class="botao_style">
                                <input type="reset" id="btnLimpar" value="Limpar" name="btnLimparr" class="botao_style">
                        </div>
                    </section>
                </form>
                <section class="linha_foto">
                    <form name="frmFoto" method="post" action="upload_fotos.php?txt=txtFoto" enctype="multipart/form-data" id="frmFoto">
                        <div id="lugar_foto">
                            <div class="subtitulo">
                                Imagem da Unidade
                            </div>
                            <div id="foto"><img src="<?php echo($foto);?>"></div>
                            <input type="file" name="fleFoto" id="fotos">
                        </div>
                    </form>
                </section>

<!--                seção referente as lojas cadastradas, opção de excluir, consultar e editar inclusos-->
                <div id="tabela">
                         <div id="linha_titulos">
                             <div id="titulos_tabela">
                                 <div class="titulos" style="padding-top:5px; height:45px;">
                                     Nome da Unidade
                                 </div>
                                 <div class="titulos">
                                     Telefone
                                 </div>
                                 <div class="titulos">
                                     Email
                                 </div>
                                 <div class="titulos">
                                     Logradouro
                                 </div>
                                 <div class="titulos">
                                     Número
                                 </div>
                                 <div class="titulos" style="padding-top:5px; height:45px;">
                                     Cidade
                                 </div>
                                 <div class="titulos">
                                     Opções
                                 </div>
                             </div>
                             <div id="registros">
                                <?php
                                    // select que retornará os registros da tabela do banco
                                    $sql = "SELECT * FROM tbl_loja";

                                    // executando no banco
                                    $result = mysql_query($sql);

                                    // loop que resgatará todos os registros
                                    while($registros = mysql_fetch_array($result)){
                                        // verificando o status para receber a imagem correta
                                        if($registros['status'] == 1){
                                            $imgStatus = "status1.png";
                                        } else {
                                            $imgStatus = "status0.png";
                                        }
                                 ?>
                                 <!-- mostrando em uma tabela as lojas cadastradas -->
                                <div class="registros_tabela">
                                    <div class="registros">
                                        <?php echo($registros['nome']); ?>
                                    </div>
                                    <div class="registros" title="">
                                        <?php echo($registros['telefone']); ?>
                                    </div>
                                    <div class="registros" title="">
                                        <?php echo($registros['email']); ?>
                                    </div>
                                    <div class="registros">
                                        <?php echo($registros['logradouro']); ?>
                                    </div>
                                    <div class="registros" title="">
                                        <?php echo($registros['numero']); ?>
                                    </div>
                                    <div class="registros" title="">
                                        <?php echo($registros['cidade']); ?>
                                    </div>
                                    <div class="registros">
                                        <a href="lojas.php?modo=excluir&id=<?php echo($registros['id']); ?>">
                                            <img src="imagens/delete.png" class="img_opcoes">
                                        </a>
                                        <a href="lojas.php?modo=consultar&id=<?php echo($registros['id']); ?>">
                                            <img src="imagens/edit.png" class="img_opcoes">
                                        </a>
                                        <a href="lojas.php?modo=status&id=<?php echo($registros['id']);?>&status=<?php echo($registros['status']);?>">
                                            <img src="imagens/<?php echo($imgStatus);?>" class="img_opcoes">
                                        </a>
                                    </div>
                                </div>
                                 <?php } ?>
                            </div>
                         </div>
                     </div>
            </div>
            <!-- rodapé -->
            <footer>
                Desenvolvido por: Arthur Ferreira
            </footer>
        </div>
    </body>
</html>
