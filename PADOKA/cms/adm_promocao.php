<?php
    // chamando arquivos externos
    require_once "verificacao.php";
    require_once "../conexao_banco.php";

    // verificando se o usuario tem permissão para acessar essa página
    require_once "autenticacao_nivel.php";
    $permissao = [1,3];
    autenticar($permissao);

    // criando variaveis
    $botao = "Salvar";
    $id = "";
    $porcentagem = "";
    $idProduto = "";
    $status = "";

// verificando se o formulario foi submetido
    if(isset($_GET['btnSalvar'])){
        // resgatando os valores dos inputs
        $porcentagem = $_POST['txtPorcentagem'];
        $idProduto = $_POST['txtIdProduto'];
        $status = 1;

        // verificando seestá no modo SALVAR OU EDITAR
        if($_GET['btnSalvar'] == "Salvar"){
            // comando sql de salvar
            $sql = "INSERT INTO tbl_promocao (porcentagemDesc, idProduto, status) ";
            $sql .= "VALUES (".$porcentagem.", ".$idProduto.", ".$status.")";
        } else if($_GET['btnSalvar'] == "Editar"){
            // comando sql de editar
            $sql = "UPDATE tbl_promocao SET
            porcentagemDesc = ".$porcentagem.",
            idProduto = ".$idProduto."
            WHERE id = ".$_SESSION['idSessao'];
        }
        // executando no banco
        mysql_query($sql);
        // redirecionando para a pagina
        header('location:adm_promocao.php');
    }

    // verificando se a variavel modo existe na URL
    if(isset($_GET['modo'])){
        // resgatando a variavel modo da URL
        $modo = $_GET['modo'];

        // verificando em qual modo está
        if($modo == "excluir"){
            // resgatando o id da URL
            $id = $_GET['id'];
            // comando sql de excluir o registro
            $sql = "DELETE FROM tbl_promocao WHERE id = ".$id;
            // executando no banco
            mysql_query($sql);
        } else if($modo == "status"){
            // resgatando o id da URL
            $id = $_GET['id'];
            $status = $_GET['status'];

            // comando sql de atualizar o status do registro
            if($status == 1){
                $sql = "UPDATE tbl_promocao SET status = 0 WHERE id = ".$id;
            } else {
                $sql = "UPDATE tbl_promocao SET status = 1 WHERE id = ".$id;
            }
            // executando no banco
            mysql_query($sql);
        } else if ($modo ==  "consultar"){
            // resgatando o id da URL
            $id = $_GET['id'];

            // comando sql de consultar o registro
            $sql = "SELECT * FROM tbl_promocao WHERE id = ".$id;
            // executando no banco
            $result = mysql_query($sql);
            // loop que resgata as informações do registro
            if($promocao = mysql_fetch_array($result)){
                // resgatando o id da URL
                $id = $promocao['id'];
                // passando para a sessão o id do registro
                $_SESSION['idSessao'] = $id;
                // resgatando os valores do banco e guardando em uma variavel
                $porcentagem = $promocao['porcentagemDesc'];
                $idProduto = $promocao['idProduto'];
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
        <link rel="stylesheet" type="text/css" href="css/stylePromocao.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
    </head>
    <body>
        <div id="main">
            <header>
                <!-- chamando arquivo do menu -->
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
                <div id="content_cadastro">
                    <form name="frmCadastro" method="post" action="adm_promocao.php?btnSalvar=<?php echo($botao);?>">
                        <div class="campos">
                            <div class="subtitulo">
                                Porcentagem do Desconto
                            </div>
                            <input type="number" maxlength="3" name="txtPorcentagem" value="<?php echo($porcentagem);?>">
                        </div>
                        <div class="campos">
                            <div class="subtitulo">
                                Produto
                            </div>
                            <select name="txtIdProduto">
                                <?php
                                    // select que retornará os produtos cadastrados para
                                    // que seja possivel o cadstro de uma promoção
                                    $sql = "SELECT * FROM tbl_produto WHERE status = 1";
                                    // executando no banco
                                    $result = mysql_query($sql);
                                    // loop que puxa todas as informações
                                    while($produtos = mysql_fetch_array($result)){
                                        // verificando qual é o produto para quando estiver no modo editar,
                                        // vim o produto selecionado de acordo com a promoção que esta sendo editada
                                        if($produtos['id'] == $idProduto && $modo == "consultar"){
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                ?>
                                        <option <?php echo($selected);?> value="<?php echo($produtos['id']);?>"> <?php echo($produtos['nome']); ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="campos">
                            <input type="submit" id="btnSalvar" value="<?php echo($botao);?>" name="btnSalvar" class="botao_style">
                            <input type="reset" id="btnLimpar" value="Limpar" name="btnLimparr" class="botao_style">
                        </div>
                    </form>
                </div>
                <div id="tabela">
                         <div id="linha_titulos">
                             <div id="titulos_tabela">
                                 <div class="titulos">
                                     Procentagem do Desconto
                                 </div>
                                 <div class="titulos" style="padding-top:5px; height:45px;">
                                     Produto da Promoção
                                 </div>
                                 <div class="titulos">
                                     Preço da Promoção
                                 </div>
                                 <div class="titulos">
                                     Opções
                                 </div>
                             </div>
                             <div id="registros">
                                <?php
                                // select qye retornará as promoções cadastradas
                                    $sql = "select pr.id, pr.porcentagemDesc, p.nome, p.preco - (p.preco * pr.porcentagemDesc / 100) as  novoPreco, pr.status
                                            from tbl_promocao as pr
                                            inner join tbl_produto as p
                                            on p.id = pr.idProduto";
                                    // executando no banco
                                    $result = mysql_query($sql);
                                    // loop que puxa todos os registros
                                    while($registros = mysql_fetch_array($result)){
                                        // verificando qual o status da promoção
                                        // para que mostre a imagem correta
                                        if($registros['status'] == 1){
                                            $imgStatus = "status1.png";
                                        } else {
                                            $imgStatus = "status0.png";
                                        }
                                 ?>
                                <div class="registros_tabela">
                                    <div class="registros">
                                        <!-- mostrando a porcentagem de desconto da promoção -->
                                        <?php echo($registros['porcentagemDesc']); ?>%
                                    </div>
                                    <div class="registros" title="">
                                        <!-- mostrando o nome do produto da promoção -->
                                        <?php echo($registros['nome']); ?>
                                    </div>
                                    <div class="registros" title="">
                                        <!-- mostrando o novo preço da promoção -->
                                        <?php echo($registros['novoPreco']); ?>
                                    </div>
                                    <div class="registros">
                                        <a href="adm_promocao.php?modo=excluir&id=<?php echo($registros['id']); ?>">
                                            <img src="imagens/delete.png" class="img_opcoes">
                                        </a>
                                        <a href="adm_promocao.php?modo=consultar&id=<?php echo($registros['id']); ?>">
                                            <img src="imagens/edit.png" class="img_opcoes">
                                        </a>
                                        <a href="adm_promocao.php?modo=status&id=<?php echo($registros['id']);?>&status=<?php echo($registros['status']);?>">
                                            <img src="imagens/<?php echo($imgStatus);?>" class="img_opcoes">
                                        </a>
                                    </div>
                                </div>
                                 <?php } ?>
                            </div>
                         </div>
                     </div>
            </div>
            <footer>
                Desenvolvido por: Arthur Ferreira
            </footer>
        </div>
    </body>
</html>
