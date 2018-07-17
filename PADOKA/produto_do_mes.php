<?php
    // chamando arquivo de conexao com o banco
    require_once "conexao_banco.php";
    // select que retornará o produto do mês
    $sql = "SELECT * FROM tbl_produto WHERE produtoDoMes = 1";
    // executando o sql no banco e guardando o retorno numa variavel
    $result = mysql_query($sql);
    // caso haja um produto ativo ele resgatará as informações
    if($produtoDoMes = mysql_fetch_array($result)){
        // resgatando as informações do banco
        $nome = $produtoDoMes['nome'];
        $descricao = $produtoDoMes['descricao'];
        $preco = $produtoDoMes['preco'];
        $foto = $produtoDoMes['foto'];
    }
?>

<!DOCTYPE html>
<html>
    <head>
    <!--Titulo que fica na aba da pagina-->
        <title> Padoka Hill Valley | Lojas </title>
        <meta charset="utf-8">
    <!--link de ligação com arquivo CSS-->
        <link rel="stylesheet" type="text/css" href="css/styleProdutoDoMes.css">
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
                    Produto do Mês
                </div>
                <div id="content_produto">
                    <div id="titulo_produto">
                        <article>
                            <!-- mostrando o nome do produto do mês -->
                            <?php echo($nome);?>
                        </article>
                    </div>
                    <div id="imagem_produto">
                        <!-- mostrando a foto do produto do mês -->
                        <img src="cms/<?php echo($foto);?>" width="600" height="400" alt="Produto destaque do mês" title="Produto destaque do mês">
                    </div>
                    <div id="texto_produto">
                        <h4>Descrição</h4>
                        <!-- mostrando a descrição do produto do mês -->
                        <?php echo($descricao);?>
                    </div>
                    <div id="valor_produto">
                        <!-- mostrando o valor do produto do mês -->
                        R$ <?php echo($preco);?>
                    </div>
                </div>
            </div>
        </div>
        <!--footer é a teg para o rodapé do site-->
        <footer>
            <!-- chamando o arquivo do rodapé -->
            <?php require_once'rodape.php'; ?>
        </footer>
    </body>
</html>
