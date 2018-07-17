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
    $descricao = "";
    $botao = "Salvar";
    // verificando se o formulario foi submetido
    if(isset($_POST['btnSalvar'])){
        // reesgatando as informações via método POST
        $nome = $_POST['txtNomeNivel'];
        $descricao = $_POST['txtDescricaoNivel'];
        $status = 1;
        // verificando se o botao está como SALVAR OU EDITAR
        if($_POST['btnSalvar'] == 'Salvar'){
            // sql de SALVAR
            $sql = "INSERT INTO tbl_nivel_usuario (nome, descricao, status) VALUES ('".$nome."', '".$descricao."', '".$status."')";
        } else if($_POST['btnSalvar'] == "Editar"){
            // sql de EDITAR
            $sql = "UPDATE tbl_nivel_usuario SET
            nome = '".$nome."',
            descricao = '".$descricao."'
            WHERE id = ".$_SESSION['idSessao'];
        }
        // executando no banco
        mysql_query($sql);
        // redirecionando a pagina
        header('location:gerenciamento_niveis.php');
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
            $sql = "DELETE FROM tbl_nivel_usuario WHERE id = ".$id;
            // executando no banco
            mysql_query($sql);
        } else if($modo == 'status') {
            // resgatando oo parametros da url
            $id = $_GET['id'];
            $status = $_GET['status'];

            if($status == 1){
                // sql de atualizar o status do registro para 0
                $sql = "UPDATE tbl_nivel_usuario SET status = 0 WHERE id = ".$id;
            } else if($status == 0){
                // sql de atualizar o status do registro para 1
                $sql = "UPDATE tbl_nivel_usuario SET status = 1 WHERE id = ".$id;
            }
            // executando no banco
            mysql_query($sql);
        } else if($modo == 'consultar'){
            // resgatando o id da url
            $id = $_GET['id'];
            // sql de consultar um registro
            $sql = "SELECT * FROM tbl_nivel_usuario WHERE id = ".$id;
            // executando no banco
            $resultado = mysql_query($sql);
            // if que resgatará as informações do banco
            if($rsNiveis = mysql_fetch_array($resultado)){
                // resgatando as informações do banco
                $id = $rsNiveis['id'];
                // passando o id do registro para a variavel de sessao
                $_SESSION['idSessao'] = $id;
                // resgatando as informações do banco
                $nome = $rsNiveis['nome'];
                $descricao = $rsNiveis['descricao'];
                $botao = "Editar";
            }
        }
    }
?>
<!-- inicio do codigo html -->
<!DOCTYPE html>
<html>
    <head>
        <title>Adm. Niveis | CMS </title>
        <meta charset="utf-8">
<!--        links com arquivos externos-->
        <link rel="stylesheet" type="text/css" href="css/styleGerenciamentoNiveis.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
    </head>
    <body>
        <div id="main">
            <header>
                <!-- chamando o arquivo do menu -->
                <?php require_once 'menu.php';?>
            </header>
            <div id="content">
                <!-- parte dos campos -->
                <div class="titulo_content">
                    Cadastro de Niveis
                </div>
                <form name="frmCadastroNiveis" method="post" action="gerenciamento_niveis.php">
                    <section class="content_cadastro">
                        <div class="campos">
                            <div class="subtitulo">
                                Nome do Nivel
                            </div>
                            <input type="text" name="txtNomeNivel" id="txtNomeNivel" class="inputs" value="<?php echo($nome); ?>">
                        </div>
                        <div class="campos">
                            <div class="subtitulo">
                                Descrição
                            </div>
                            <textarea type="text" name="txtDescricaoNivel" id="txtDescricaoNivel"><?php echo($descricao); ?></textarea>
                        </div>
                        <div id="botoes">
                            <input type="submit" id="btnSalvar" value="<?php echo($botao); ?>" name="btnSalvar" class="botao_style">
                            <input type="reset" value="Limpar" name="btnLimpar" class="botao_style">
                         </div>
                    </section>
                    <div id="borda"></div>
                    <!-- parte da tabela que mostra os niveis cadastrados -->
                    <div class="titulo_content">
                        Níveis Cadastrados
                    </div>
                    <section class="content_cadastro" id="niveis_cadastrados">
                        <div id="tabela">
                            <div id="linha_titulos">
                                <div id="titulos_tabela">
                                    <div class="titulos">
                                        Nome
                                    </div>
                                    <div class="titulos">
                                        Descrição
                                    </div>
                                    <div class="titulos">
                                        Opções
                                    </div>
                                </div>
                            </div>
                            <div id="registros">
                                <?php
                                    // select que retornará os registros da tabela do banco
                                    $sql =  "SELECT * FROM tbl_nivel_usuario";
                                    // executando no banco
                                    $resultado = mysql_query($sql);
                                    // loop que resgatará todos os registros
                                    while($rsNivel = mysql_fetch_array($resultado)){
                                        // verificando o status para receber a imagem correta
                                        if($rsNivel['status'] == 1){
                                            $imgStatus = "status1.png";
                                        } else if($rsNivel['status'] == 0){
                                            $imgStatus = "status0.png";
                                        }
                                ?>
                                <div class="registros_tabela">
                                    <div class="registros">
                                            <!-- mostrando o nome do nivel -->
                                        <?php echo($rsNivel['nome']);?>
                                    </div>
                                    <div class="registros" title="<?php echo($rsNivel['descricao']);?>">
                                        <!-- mostrando descrição -->
                                        <?php echo($rsNivel['descricao']);?>
                                    </div>
                                    <div class="registros">
                                        <a href="gerenciamento_niveis.php?modo=excluir&id=<?php echo($rsNivel['id']);?>">
                                            <img src="imagens/delete.png" class="img-opcoes">
                                        </a>
                                        <a href="gerenciamento_niveis.php?modo=consultar&id=<?php echo($rsNivel['id']);?>">
                                            <img src="imagens/edit.png" class="img-opcoes">
                                        </a>
                                        <a href="gerenciamento_niveis.php?modo=status&id=<?php echo($rsNivel['id']);?>&status=<?php echo($rsNivel['status']);?>">
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
