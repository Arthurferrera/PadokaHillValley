<?php
    // chamando arquivo de verificação
    // para saber se a pessoa está logada no sistema
    require_once "verificacao.php";
    require_once "../conexao_banco.php";
?>

<!-- inicio do codigo html -->
<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Geranciamento - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleHome.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
    </head>
    <body>
        <div id="main">
            <header>
                <!-- chamando o arquivo do menu -->
                <?php require_once 'menu.php' ?>
            </header>
            <!-- conteudo -->
            <div id="content">
                <div class="titulo_estatisticas">
                    TOP 5 produtos mais acessados
                </div>
                <div class="linha_subtitulos">
                    <div class="itens_estatisticas_menores">
                        N °
                    </div>
                    <div class="itens_estatisticas_maiores">
                        Produto
                    </div>
                    <div class="itens_estatisticas_menores">
                        Clicks
                    </div>
                    <div class="itens_estatisticas_maiores">
                        Estatistica
                    </div>
                    <div class="itens_estatisticas_menores">
                        %
                    </div>
                </div>

                <div class="content_topfive">
                    <div class="coluna_posicao">
                        <div class="posicoes">
                            1°
                        </div>
                        <div class="posicoes">
                            2°
                        </div>
                        <div class="posicoes">
                            3°
                        </div>
                        <div class="posicoes">
                            4°
                        </div>
                        <div class="posicoes">
                            5°
                        </div>
                    </div>
                    <div class="content_produtos_top_five">
                        <?php
                            // fazendo a logica que resgata a soma dos cliques de TODOS os produtos
                            $sql = "select sum(qtdCliques) AS soma from tbl_produto";
                            $result = mysql_query($sql);
                            if($qtd = mysql_fetch_array($result)){
                                $totalDeCliques = $qtd['soma'];
                                // echo $totalDeCliques;
                            }

                            // puxando do banco de dados os TOP 5 produtos mais clicados
                            $sqlProdutos = "select p.nome, p.qtdCliques
                                    from tbl_produto as p
                                    ORDER BY qtdCliques DESC limit 5";
                            $resultProdutos = mysql_query($sqlProdutos);
                            while($produtos = mysql_fetch_array($resultProdutos)){
                                $nomeProduto = $produtos['nome'];
                                $cliques = $produtos['qtdCliques'];

                                $percentual = ($cliques * 100) / $totalDeCliques;
                        ?>
                        <div class="linha_produtos_estatisticas">
                            <div class="itens_estatisticas_maiores" id="nomeProduto">
                                <?php echo($nomeProduto) ?>
                            </div>
                            <div class="itens_estatisticas_menores">
                                <?php echo $cliques ?>
                            </div>
                            <div class="itens_estatisticas_maiores">
                                <div class="barra" style="width: <?php echo $percentual ?>%;"></div>
                            </div>
                            <div class="itens_estatisticas_menores">
                                <?php echo (number_format($percentual, 2)) ?>
                            </div>
                        </div>
                    <?php } ?>
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
