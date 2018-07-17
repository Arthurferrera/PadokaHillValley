<!DOCTYPE html>

<?php
//    conectando com o banco
    require_once "conexao_banco.php";

//    verificando se o botao foi clicado
    if(isset($_GET['btnEnviar'])){
//        resgatando os valores dos campos
        $nome = $_GET['txtNome'];
        $telefone = $_GET['txtTelefone'];
        $celular = $_GET['txtCelular'];
        $email = $_GET['txtEmail'];
        $homePage = $_GET['txtHomePage'];
        $linkFacebook = $_GET['txtLinkFacebook'];
        $sexo = $_GET['rdoSexo'];
        $profissao = $_GET['txtProfissao'];
        $sugestao = $_GET['txtSugestao'];
        $infoProduto = $_GET['txtInfoProduto'];

//        fazendo referencia aos campos
        $sql = "INSERT INTO tbl_fale_conosco (nome, telefone, celular, email, homePage, linkFacebook, sugestao, infoProduto, sexo, profissao) ";
//        adicionando os valores em uma string
        $sql .= "VALUES ('".$nome."','".$telefone."','".$celular."','".$email."','".$homePage."','".$linkFacebook."','".$sugestao."','".$infoProduto."','".$sexo."','".$profissao."')";

//        executando o comando no banco
        mysql_query($sql);

//        redireciona para a mesma pagina
        header("location:fale_conosco.php");
    }

?>

<html>
    <head>
    <!--Titulo que fica na aba da pagina-->
        <title> Padoka Hill Valley | Fale Conosco </title>
        <meta charset="utf-8">
    <!--link de ligação com arquivo CSS-->
        <link rel="stylesheet" type="text/css" href="css/styleFaleConosco.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
        <link rel="stylesheet" type="text/css" href="css/styleRodape.css">
    <!--colocando o icone na aba da pagina-->
        <link rel="shortcut icon" href="imagens/icone.png" type="image/x-icon">
        <script>
        // mascara de formatação para o campo de telefone/celular
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
        </script>
    </head>
    <body>
    <!--header é a tag de cabeçalho-->
        <header>
            <!-- require_once chama um arquivo externo  -->
            <?php require_once'cabecalho.php'; ?>
        </header>
        <!--essa div é usada para alinhar o conteudo principal do site com o header-->
        <div id="gamb"></div>
        <!--main é a parte principal do site, onde fica o slider e os conteudos-->
        <div id="main">
            <!--section que fica as divs de redes sociais-->
            <section id="redes_sociais">
                <!--divs de cada rede social-->
                <div class="itens_redes">
                    <img src="imagens/icone_facebook.png" width="70" height="70" alt="Facebook" title="Facebook">
                </div>
                <div class="itens_redes">
                    <img src="imagens/icone_instagram.png" width="70" height="70" alt="Instagram" title="Instagram">
                </div>
                <div class="itens_redes">
                    <img src="imagens/icone_youtube.png" width="70" height="70" alt="Youtube" title="Youtube">
                </div>
            </section>
            <div id="content">
                <div id="titulo">
                    <h1>Fale Conosco</h1>
                    <div id="alerta">
                        * - Campos obrigatórios!
                    </div>
                </div>
                <form name="frmContato" action="fale_conosco.php" method="get">
                    <div id="content_fale_conosco">
                        <div class="linha_campos">
                            <div class="label">
                                Nome<b class="asterisco"> *</b>
                            </div>
                            <div class="campo">
                                <input class="inputs" type="text" name="txtNome" id="nome" maxlength="100" required onkeypress="return validar(event, 'number', 'nome');">
                            </div>
                        </div>
                        <div class="linha_campos">
                            <div class="label">
                                Telefone
                            </div>
                            <div class="campo">
                                <input class="inputs" type="tel" name="txtTelefone" id="telefone" maxlength="14" onkeypress="formatPhone(this, id); return validar(event, 'caracter', 'telefone')" placeholder="Ex: (11) 0909-0909">
                            </div>
                        </div>
                        <div class="linha_campos">
                            <div class="label">
                                Celular<b class="asterisco"> *</b>
                            </div>
                            <div class="campo">
                                <input class="inputs" type="tel" name="txtCelular" id="celular" maxlength="15" required onkeypress="formatPhone(this, id); return validar(event, 'caracter', 'celular')" placeholder="Ex: (11) 90909-0909">
                            </div>
                        </div>
                        <div class="linha_campos">
                            <div class="label">
                                Email<b class="asterisco"> *</b>
                            </div>
                            <div class="campo">
                                <input class="inputs" type="email" name="txtEmail" maxlength="100" required placeholder="Ex: maria@dominio.com">
                            </div>
                        </div>
                        <div class="linha_campos">
                            <div class="label">
                                Home Page
                            </div>
                            <div class="campo">
                                <input class="inputs" type="url" name="txtHomePage" maxlength="255">
                            </div>
                        </div>
                        <div class="linha_campos">
                            <div class="label">
                                Link do Facebook
                            </div>
                            <div class="campo">
                                <input class="inputs" type="url" name="txtLinkFacebook" maxlength="255">
                            </div>
                        </div>
                        <div class="linha_campos">
                            <div class="label">
                                Sexo<b class="asterisco"> *</b>
                            </div>
                            <div class="campo" id="radio">
                                <input type="radio" name="rdoSexo" value="M" required>Masculino
                                <input type="radio" name="rdoSexo" value="F" required>Feminino
                            </div>
                        </div>
                        <div class="linha_campos">
                            <div class="label">
                                Profissão<b class="asterisco"> *</b>
                            </div>
                            <div class="campo">
                                <input class="inputs" type="text" id="profissao" name="txtProfissao" maxlength="100" required onkeypress="return validar(event, 'number', 'profissao');">
                            </div>
                        </div>
                        <div class="linha_campos_maior">
                            <div class="label_maior">
                                Sugestão/Criticas
                            </div>
                            <div class="campo_maior">
                                <textarea name="txtSugestao" cols="30" rows="6"></textarea>
                            </div>
                        </div>
                        <div class="linha_campos_maior">
                            <div class="label_maior">
                                Informações de Produtos
                            </div>
                            <div class="campo_maior">
                                <textarea name="txtInfoProduto"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="botoes">
                        <input type="submit" name="btnEnviar" value="Enviar" class="botao_style">
                        <input type="reset" name="btnLimpar" value="Limpar" class="botao_style">
                    </div>
                </form>
            </div>
        </div>
        <!--footer é a teg para o rodapé do site-->
        <footer>
            <?php require_once'rodape.php'; ?>
        </footer>
    </body>
</html>
