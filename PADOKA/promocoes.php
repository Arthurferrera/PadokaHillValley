<?php
    // chamando o arquivo de conexao com o banco
    require_once "conexao_banco.php";
?>

<!DOCTYPE html>

<html>
    <head>
    <!--Titulo que fica na aba da pagina-->
        <title> Padoka Hill Valley | Promoções </title>
        <meta charset="utf-8">
    <!--link de ligação com arquivo CSS-->
        <link rel="stylesheet" type="text/css" href="css/stylePromocoes.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
        <link rel="stylesheet" type="text/css" href="css/styleRodape.css">
    <!--colocando o icone na aba da pagina-->
        <link rel="shortcut icon" href="imagens/icone.png" type="image/x-icon">
    </head>
    <body>
    <!--header é a teg de cabeçalho-->
        <header>
            <!-- chamando o arquivo do cabeçalho -->
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
                    Promoções
                </div>
                <div class="subtitulo">
                    Produtos
                </div>
                <section class="linha_promo">
                    <?php
                        // select que retornará os produtos em promoção com seu respectivo desconto
                        $sql = "SELECT tp.id, tp.nome, p.nome, p.id, p.descricao, p.preco,
                        p.preco - (p.preco * pr.porcentagemDesc / 100) AS  novoPreco, p.foto
                        FROM tbl_tipoproduto AS tp
                        INNER JOIN tbl_produto AS p
                        ON p.idTipoProduto = tp.id
                        INNER JOIN tbl_promocao AS pr
                        ON pr.idProduto = p.id
                        WHERE pr.status = 1";

                        // executando no banco o comando sql e guardando numa variavel o retorno
                        $result = mysql_query($sql);
                            // loop que resgatará as informações de todas as promoções ativas
                            while($promocoes = mysql_fetch_array($result)){ ?>
                                    <diV class="promo_individual">
                                        <div class="nome_produto">
                                            <!-- mostrando a descriçao do produto -->
                                            <?php echo($promocoes['nome']);?>
                                        </div>
                                        <div class="img_produto">
                                            <!-- mostrando a foto do produto -->
                                            <img src="cms/<?php echo($promocoes['foto']);?>" width="300" height="200" alt="<?php echo($promocoes['nome']);?>" title="<?php echo($promocoes['nome']);?>">
                                        </div>
                                        <div class="descricao_produto">
                                            <!-- mostrando a descriçao do produto -->
                                            <?php echo($promocoes['descricao']);?>
                                        </div>
                                        <!-- mostrando o valor antigo do produto -->
                                        <div class="valor_antigo">De: R$ <?php echo(number_format($promocoes['preco'],2));?></div>
                                        <!-- mostrando o valor novo do produto -->
                                        <div class="valor_novo">Por: R$ <?php echo(number_format($promocoes['novoPreco'],2));?></div>
                                    </diV>
                    <?php  } ?>
                </section>
            </div>
        </div>
        <!--footer é a teg para o rodapé do site-->
        <footer>
            <!-- chamando o arquivo do rodapé -->
            <?php require_once'rodape.php'; ?>
        </footer>
    </body>
</html>
