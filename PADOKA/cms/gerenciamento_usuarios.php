<?php
    // chamando arquivos externos
    require_once "verificacao.php";
    require_once "../conexao_banco.php";

    // verificando se o usuario tem permissão para acessar essa página
    require_once "autenticacao_nivel.php";
    $permissao = [1,3];
    autenticar($permissao);
    
    // criando variaveis
    $id = "";
    $nome = "";
    $telefone = "";
    $celular = "";
    $email = "";
    $usuario = "";
    $senha = "";
    $sexo = "";
    $rdoMasculino = "";
    $rdoFeminino = "";
    $nivelDeUsuario = "";
    $botao = "Salvar";
    // verificando se o formulario foi submetido
    if(isset($_POST['btnSalvar'])){
        // reesgatando as informações via método POST
        $nome = $_POST['txtNome'];
        $telefone = $_POST['txtTelefone'];
        $celular = $_POST['txtCelular'];
        $email = $_POST['txtEmail'];
        $sexo = $_POST['rdoSexo'];
        $usuario = $_POST['txtUsuario'];
        $senha = $_POST['txtSenha'];
        $nivel = $_POST['txtNivel'];
        $status = 1;
        // select que consulta se o usuario já existe
        $sql1 = "SELECT * FROM tbl_usuario where usuario = '".$usuario."' and id <> ".$_SESSION['idSessao'];
        // executando no banco
        $result = mysql_query($sql1);
        // if que verifica se o comando foi executado
        if($rs = mysql_fetch_array($result)){ ?>
            <!-- mostrando mensagem falando que o usuario ja existe -->
            <script>
                alert("Usuário já existe, favor tente novamente, com outro nome de usuario");
                // esta linha volta a página para o estado anterior
                window.history.back(-1);
//                    document.getElementById('email').value = "";
//                    document.getElementById('usuario').value = "";
            </script>
<?php   } else {
            // verificando se o botao está como SALVAR OU EDITAR
            if($_POST['btnSalvar'] == "Salvar"){
                // sql de SALVAR
                $sql = "INSERT INTO tbl_usuario (nome, telefone, celular, email, sexo, usuario, senha, status, idNivelusuario) ";
                $sql .= "VALUES ('".$nome."', '".$telefone."', '".$celular."', '".$email."', '".$sexo."', '".$usuario."', '".$senha."', ".$status.", ".$nivel.")";
            } else if($_POST['btnSalvar'] == "Editar"){
                // sql de EDITAR
                $sql = "UPDATE tbl_usuario SET
                nome='".$nome."',
                telefone='".$telefone."',
                celular='".$celular."',
                email='".$email."',
                sexo='".$sexo."',
                usuario='".$usuario."',
                senha='".$senha."',
                idNivelUsuario='".$nivel."'
                WHERE id = ".$_SESSION['idSessao'];
            }
            // executando no banco
            mysql_query($sql);
            // redirecionando a pagina
            header("location:gerenciamento_usuarios.php");
        }
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
            $sql = "DELETE FROM tbl_usuario WHERE id = ".$id;
            // executando no banco
            mysql_query($sql);
            // redirecionando a pagina
            header("location:gerenciamento_usuarios.php");
        } else if($modo == 'status'){
            // resgatando oo parametros da url
            $id = $_GET['id'];
            $status = $_GET['status'];

            // atualizando o status
            if($status == 1){
                $sql = "UPDATE tbl_usuario SET status = 0 WHERE id = ".$id;
            } else if ($status == 0) {
                $sql = "UPDATE tbl_usuario SET status = 1 WHERE id = ".$id;
            }
            // executando no banco
            mysql_query($sql);
        } else if($modo == 'consultar'){
            // resgatando o id da url
            $id = $_GET['id'];
            // sql de consultar um registro
            $sql = "SELECT * FROM tbl_usuario WHERE id = ".$id;
            // executando no banco
            $resultado = mysql_query($sql);
            // if que resgatará as informações do banco
             if($rsUsuarios = mysql_fetch_array($resultado)){
                // resgatando as informações do banco
                 $id = $rsUsuarios['id'];
                 // passando o id do registro para a variavel de sessao
                 $_SESSION['idSessao'] = $id;
                 // resgatando as informações do banco
                 $nome = $rsUsuarios['nome'];
                 $telefone = $rsUsuarios['telefone'];
                 $celular = $rsUsuarios['celular'];
                 $email = $rsUsuarios['email'];
                 $usuario = $rsUsuarios['usuario'];
                 $senha = $rsUsuarios['senha'];
                 $sexo = $rsUsuarios['sexo'];
                 // lógica para quando for editar o radio vim selecionado
                 if($sexo == "M"){
                     $rdoMasculino = "checked";
                 } else if ($sexo == "F"){
                     $rdoFeminino = "checked";
                 }

                 $nivelDeUsuario = $rsUsuarios['idNivelUsuario'];
                 $botao = "Editar";
        }
    }
}
?>
<!-- inicio do codigo html -->
<!DOCTYPE html>
<html>
    <head>
        <title>Adm. Usuários | CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleGerenciamentoUsuarios.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
        <script>
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
             // Tratamento para verificar em qual tipo de navegador está vindo a tecla
                if(window.event){
                 // Recebe a ascii do IE
                    var letra = caracter.charCode;
                } else {
                 // Recebe a ascii dos outros navegadores
                    var letra = caracter.which;
                }

                if(blockType == 'caracter'){
                 // bloqueio de caracteres
                    if(letra<48 || letra>57){
                        if(letra != 8 && letra!=32 && letra!=45){
                      // Troca a cor do elemento conforme for bloqueado
                      // A variavel campo é recebida na função, nela contem o ID  do elemento a ser formatado

                            document.getElementById(campo).style="background-color:#F4A1A1;";
                            return false;
                        }
                    }
                } else if(blockType == 'number') {
                 // bloqueio de numeros
                    if(letra>=48 && letra<=64){
                        document.getElementById(campo).style="background-color:#F4A1A1;";
                        return false;
                    }
                }
            }

            // função de mascará de email
            function maskEmail(caracter) {
                var dominio = "@padoka.com.br";
                var str = document.getElementById('email').value;
                var locString = str.indexOf("@");
                if(locString < 0){
                 // Tratamento para verificar em qual tipo de navegador está vindo a tecla
                    if(window.event){
                     // Recebe a ascii do IE
                        var letra = caracter.charCode;
                    } else {
                     // Recebe a ascii dos outros navegadores
                        var letra = caracter.which;
                    }

                    if(letra == 64){
                        document.getElementById('email').value = str + dominio;
                        document.getElementById('usuario').value = str;
                        event.preventDefault();
                    }
                 } else {
                     if(letra != 8){
                        event.preventDefault();
                     }
                 }
            }
        </script>
    </head>
    <body>
        <div id="main">
            <header>
                <!-- chamando arquivo do menu -->
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
                <div class="titulo_content">
                    Cadastro de Usuários
                </div>
                <!-- formulario de cadastro dos usuarios -->
                <form name="frmCadastroUsuarios" method="post" action="gerenciamento_usuarios.php">
                     <section class="content_cadastro">
                         <div class="campos">
                            <div class="subtitulos">
                                Nome
                            </div>
                             <input maxlength="50" type="text" name="txtNome" id="txtNome" class="inputs" onkeypress="return validar(event, 'number', 'txtNome')" value="<?php echo($nome);?>">
                         </div>
                         <div class="campos">
                            <div class="subtitulos">
                                Telefone
                            </div>
                             <input maxlength="14" type="tel" name="txtTelefone" id="telefone" class="inputs" onkeypress="formatPhone(this, id); return validar(event, 'caracter', 'telefone')" value="<?php echo($telefone);?>">
                         </div>
                         <div class="campos">
                            <div class="subtitulos">
                                Celular
                            </div>
                             <input maxlength="15" type="tel" name="txtCelular" id="celular" class="inputs" onkeypress="formatPhone(this, id); return validar(event, 'caracter', 'celular')" value="<?php echo($celular);?>">
                         </div>
                         <div class="campos">
                            <div class="subtitulos">
                                E-mail
                            </div>
                             <input maxlength="50" type="email" id="email" name="txtEmail" class="inputs" onkeypress="maskEmail(event)" value="<?php echo($email);?>">
                         </div>
                         <div class="campos">
                            <div class="subtitulos">
                                Sexo
                            </div>
                             <input type="radio" name="rdoSexo" class="radios" value="M" <?php echo($rdoMasculino);?>>Masculino
                             <input type="radio" name="rdoSexo" class="radios" value="F" <?php echo($rdoFeminino);?>>Feminino
                         </div>
                         <div class="campos">
                            <div class="subtitulos">
                                Usuário
                            </div>
                             <input maxlength="25" type="text" id="usuario" name="txtUsuario" class="inputs" value="<?php echo($usuario);?>" readonly>
                         </div>
                         <div class="campos">
                            <div class="subtitulos">
                                Senha
                            </div>
                             <input maxlength="30" type="password" name="txtSenha" class="inputs" value="<?php echo($senha);?>">
                         </div>
                         <div class="campos">
                            <div class="subtitulos">
                                Nivel de Usuário
                            </div>
                             <select name="txtNivel" class="inputs">
                                <?php
                                    // select que traz os niveis de usuarios
                                    $sql = "SELECT * FROM tbl_nivel_usuario WHERE status = 1";
                                    // executando no banco
                                    $resultado = mysql_query($sql);
                                    // loop que resgatará todos os registros
                                    while($rsNivel = mysql_fetch_array($resultado)){
                                        // esse if serve para quando estiver no modo editar, o select vim selecionado
                                        // com a opção correta de acordo com o registro
                                        if($rsNivel['id'] == $nivelDeUsuario && $modo =='consultar'){
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                 ?>
                                         <!-- opções do select sendo carregado dentro do while -->
                                        <option <?php echo($selected);?> value="<?php echo($rsNivel['id']); ?>"><?php echo($rsNivel['nome']); ?></option>
                                 <?php } ?>
                             </select>
                         </div>
                         <div id="botoes">
                            <input type="submit" id="btnSalvar" value="<?php echo($botao);?>" name="btnSalvar" class="botao_style">
                            <input type="reset" value="Limpar" name="btnLimpar" class="botao_style">
                         </div>
                    </section>
                    <div id="borda"></div>
                    <!-- parte da tabela que mostra todos os registros, que são carregados do banco -->
                    <div class="titulo_content">
                        Usuários Cadastrados
                    </div>
                    <section class="content_cadastro">
                        <div id="caixa_tabela">
                            <table border="1" class="tabela_titulo">
                                <tr>
                                    <td>Nome</td>
                                    <td>Telefone</td>
                                    <td>Nivel de Usuário</td>
                                    <td>Opções</td>
                                </tr>
                            </table>
                            <div id="tabela2">
                                <table border="1" class="tabela_titulo">
                                    <?php
                                        // select que traz os usuarios cadastrados
                                        $sql = "SELECT u.id, u.nome, u.telefone, n.nome as nivel, u.status
                                                from tbl_usuario as u
                                                INNER JOIN tbl_nivel_usuario as n
                                                ON u.idNivelusuario = n.id;";
                                        // executando no banco
                                        $resultado = mysql_query($sql);
                                        // loop que resgatará todos os registros
                                        while($rsUsuarios = mysql_fetch_array($resultado)){
                                            // verificando o status para receber a imagem correta
                                            if($rsUsuarios['status'] == 1){
                                                $imgStatus = "status1.png";
                                            } else if ($rsUsuarios['status'] == 0) {
                                                $imgStatus = "status0.png";
                                            }
                                    ?>
                                    <tr>
                                        <!-- mostrando as informações dos usuários -->
                                        <td> <?php echo($rsUsuarios['nome']); ?> </td>
                                        <td> <?php echo($rsUsuarios['telefone']); ?> </td>
                                        <td> <?php echo($rsUsuarios['nivel']); ?> </td>
                                        <td>
                                            <a href="gerenciamento_usuarios.php?modo=excluir&id=<?php echo($rsUsuarios['id']);?>">
                                                <img src="imagens/delete.png" class="img-opcoes">
                                            </a>
                                            <a href="gerenciamento_usuarios.php?modo=consultar&id=<?php echo($rsUsuarios['id']);?>">
                                                <img src="imagens/edit.png" class="img-opcoes">
                                            </a>
                                            <a href="gerenciamento_usuarios.php?modo=status&id=<?php echo($rsUsuarios['id']);?>&status=<?php echo($rsUsuarios['status']);?>">
                                                <img src="imagens/<?php echo($imgStatus); ?>" class="img-opcoes">
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </section>
                </form>
            </div>
            <!-- rodapé -->
            <footer>
                Desenvolvido por: Arthur Ferreira
            </footer>
        </div>
    </body>
</html>
