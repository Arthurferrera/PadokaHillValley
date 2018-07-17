<?php
    // chamando arquivos externos
    require_once "verificacao.php";
    require_once "../conexao_banco.php";

    // verificando se o usuario tem permissão para acessar essa página
    require_once "autenticacao_nivel.php";
    $permissao = [1,3];
    autenticar($permissao);
    
    // cruabdi as variaveis
    $id="";
    $nome="";
    $botao = "Salvar";
    // verificando se o formukário foi submetido
    if(isset($_POST['btnSalvar'])){
        $nome = $_POST['txtNome'];
        $status = 1;
        // verificando se o botao está commo salvar ou editar
        if($_POST['btnSalvar'] == "Salvar"){
            // sql de salvar o registro
            $sql = "INSERT INTO tbl_tipo_ambiente (nome, status) ";
            $sql .= "VALUES ('".$nome."', '".$status."')";
        } else if($_POST['btnSalvar'] == "Editar"){
            // sql de editar o registro
            $sql = "UPDATE tbl_tipo_ambiente SET
            nome = '".$nome."'
            WHERE id = ".$_SESSION['idSessao'];
        }
        // executando o sql no banco
        mysql_query($sql);
        // redirecionando a pagina
        header('location:cadastro_ambientes.php');
    }

    // verificando se a variavel modo existe na url
    if(isset($_GET['modo'])){
        // resgatando a variavvel modo da url
        $modo = $_GET['modo'];
        // verificando o modo que foi resgatado da url
        if($modo == 'excluir'){
            // resgatando o id da url
            $id = $_GET['id'];
            // sql de excluir o registro
            $sql = "DELETE FROM tbl_tipo_ambiente where id =".$id;
            mysql_query($sql);
        } else if($modo == 'status'){
            // resgatando o id da url
            $id = $_GET['id'];
            // resgatando o status da url
            $status = $_GET['status'];

            // verificando como está o status
            if($status == 1){
                // sql de atualizar o status do registro para 0
                $sql = "UPDATE tbl_tipo_ambiente SET status = 0 WHERE id = ".$id;
            } else if($status == 0){
                // sql de atualizar o status do registro para 1
                $sql = "UPDATE tbl_tipo_ambiente SET status = 1 WHERE id = ".$id;
            }
            // executando no banco
            mysql_query($sql);
        }else if ($modo == 'consultar'){
            // resgatando o id da url
            $id = $_GET['id'];
            // sql de consultar um registro
            $sql = "SELECT * FROM tbl_tipo_ambiente WHERE id = ".$id;
            // executando o select no banco
            $result = mysql_query($sql);
            // if que resgatará as informações do banco
            if($ambiente = mysql_fetch_array($result)){
                // resgatando as informações do banco
                $id = $ambiente['id'];
                // passando o id do registro para a variavel de sessao
                $_SESSION['idSessao'] = $id;
                $nome = $ambiente['nome'];
                $botao = "Editar";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Geranciamento - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCadastroAmbientes.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
    </head>
    <body>
        <div id="main">
            <header>
                <!-- chamando o arquivo do menu -->
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
                <div class="titulo_content">
                    Cadastro de Ambientes
                </div>
                <form name="frmCadastroAmbientes" method="post" action="cadastro_ambientes.php">
                    <section class="content_cadastro">
                        <div class="campos">
                            <div class="subtitulo">
                                Nome do Ambiente
                            </div>
                            <input type="text" name="txtNome" id="txtNome" class="inputs" value="<?php echo($nome); ?>">
                        </div>
                        <div id="botoes">
                            <input type="submit" id="btnSalvar" value="<?php echo($botao); ?>" name="btnSalvar" class="botao_style">
                            <input type="reset" value="Limpar" name="btnLimpar" class="botao_style">
                         </div>
                    </section>
                    <div id="borda"></div>
                    <div class="titulo_content">
                        Ambientes Cadastrados
                    </div>
                    <section class="content_cadastro" id="niveis_cadastrados">
                        <div id="tabela">
                            <div id="linha_titulos">
                                <div id="titulos_tabela">
                                    <div class="titulos">
                                        Nome
                                    </div>
                                    <div class="titulos">
                                        Opções
                                    </div>
                                </div>
                            </div>
                            <div id="registros">
                            <?php
                            // select que retornará os registros da tabela tipo de ambiente
                                $sql =  "SELECT * FROM tbl_tipo_ambiente";
                                // executando no banco
                                $resultado = mysql_query($sql);
                                // loop que resgatará todos os registros
                                while($ambientes = mysql_fetch_array($resultado)){
                                    // verificando o status para receber a imagem correta
                                    if($ambientes['status'] == 1){
                                        $imgStatus = "status1.png";
                                    } else if($ambientes['status'] == 0){
                                        $imgStatus = "status0.png";
                                    }
                            ?>
                                <div class="registros_tabela">
                                    <div class="registros">
                                        <!-- mostrando o nome -->
                                        <?php echo($ambientes['nome']);?>
                                    </div>
                                    <div class="registros">
                                        <a href="cadastro_ambientes.php?modo=excluir&id=<?php echo($ambientes['id']) ?>">
                                            <img src="imagens/delete.png" class="img-opcoes">
                                        </a>
                                        <a href="cadastro_ambientes.php?modo=consultar&id=<?php echo($ambientes['id']) ?>">
                                            <img src="imagens/edit.png" class="img-opcoes">
                                        </a>
                                        <a href="cadastro_ambientes.php?modo=status&id=<?php echo($ambientes['id']) ?>&status=<?php echo($ambientes['status']) ?>">
                                            <img src="imagens/<?php echo($imgStatus); ?>" class="img-opcoes">
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
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
