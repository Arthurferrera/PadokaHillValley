<?php
    // chamando arquivos externos
    require_once "verificacao.php";
    require_once "../conexao_banco.php";

    // verificando se o usuario tem permissão para acessar essa página
    require_once "autenticacao_nivel.php";
    $permissao = [1,3];
    autenticar($permissao);

    // verificando se existe a variavel modo na URL
    if(isset($_GET['modo'])){
        // resgatando a variavel da URL
        $modo = $_GET['modo'];

        // verificando o que retornou na URL
        if($modo == 'produtoDoMes'){
            // resgatando os valores passado na URL
            $id = $_GET['id'];
            $status = $_GET['status'];

            // verificando qual o status do produto
            if($status == 1){
                // caso ativo sql muda para 0
                $sql = "UPDATE tbl_produto SET produtoDoMes = 0 WHERE id = ".$id;
            } else {
                // caso desativo sql mudatodos para 0 e o que o usuario selecionou para 1
                // pois só é possivel 1 produto de mes ficar ativo
                $sqlZerar = "UPDATE tbl_produto SET produtoDoMes = 0";
                mysql_query($sqlZerar);
                $sql = "UPDATE tbl_produto SET produtoDoMes = 1 WHERE id = ".$id;
            }
            // executando no banco o sql
            mysql_query($sql);
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Geranciamento - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleProdutoMes.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
    </head>
    <body>
        <div id="main">
            <header>
                <!-- chamando arquivo de menu -->
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
                <div id="titulo_content">
                    Produto do Mês
                </div>

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
                                Preço
                            </div>
                            <div class="titulos">
                                Foto
                            </div>
                            <div class="titulos">
                                Status
                            </div>
                        </div>
                    </div>
                    <div id="registros">
                        <?php
                            // sql que retornará os produtos cadastrados
                            $sql =  "SELECT * FROM tbl_produto order by id desc";
                            // executando o sql
                            $resultado = mysql_query($sql);

                            // loop que carrega as informações dos produtos na tela
                            while($registros = mysql_fetch_array($resultado)){
                                // verificando qual o status do produto
                                if($registros['produtoDoMes'] == 1){
                                    // se foi 1, recebe a imagem ativada
                                    $imgStatus = "status1.png";
                                } else {
                                    // se foi 0, recebe a imagem desativada
                                    $imgStatus = "status0.png";
                                }

                        ?>
                        <div class="registros_tabela">
                            <div class="registros">
                                <!-- mostrando o nome -->
                                <?php echo($registros['nome']);?>
                            </div>
                            <div class="registros"  title="<?php echo($registros['descricao']);?>">
                                <!-- mostrando a descrição do produto -->
                                <?php echo($registros['descricao']);?>
                            </div>
                            <div class="registros">
                                <!-- mostrando o preço do produto -->
                                R$ <?php echo($registros['preco']);?>
                            </div>
                            <div class="registros">
                                <!-- mostrando a foto do produto -->
                                <img src="<?php echo($registros['foto']);?>" class="imagem_produto">
                            </div>
                            <div class="registros">
                                <a href="adm_produtoMes.php?modo=produtoDoMes&id=<?php echo($registros['id']);?>&status=<?php echo($registros['produtoDoMes']);?>">
                                    <!-- motrando o status representado pela imagem -->
                                    <img src="imagens/<?php echo($imgStatus); ?>" class="img-opcoes">
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <footer>
                Desenvolvido por: Arthur Ferreira
            </footer>
        </div>
    </body>
</html>
