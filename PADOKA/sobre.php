<?php
    // chamando o arquivo de conexão com banco
    require_once "conexao_banco.php";
    // select que retornará as informações ativa da pagina "Sobre a Padoka"
    $sql = "select * from tbl_sobre WHERE status = 1 order by Rand() limit 1";
    // executando no banco o sql e guardando o retorno numa variavel
    $result = mysql_query($sql);
    // loop que é executando enquanto existir informações a serem resgatadas do banco
    while($informacoes = mysql_fetch_array($result)){
        // resgatando as informações do banco e guardando em suas respectivas veriaveis
        $titulo = $informacoes['titulo'];
        $texto_principal = $informacoes['texto_principal'];
        $foto = $informacoes['foto'];
        $texto_missao = $informacoes['texto_missao'];
        $texto_visao = $informacoes['texto_visao'];
        $texto_valores = $informacoes['texto_valor'];
        $texto_diversidade = $informacoes['texto_diversidade'];
    }
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
    <!--Titulo que fica na aba da pagina-->
        <title> Padoka Hill Valley | Sobre </title>
        <meta charset="utf-8">
    <!--link de ligação com arquivo CSS-->
        <link rel="stylesheet" type="text/css" href="css/styleSobre.css">
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
                <div id="titulo_padoka">Padoka Hill Valley</div>
                <section class="conteudos">
                    <div class="titulo">
                        <!-- mostrando o titulo da pagina -->
                        <h2><?php echo($titulo); ?></h2>
                    </div>
                    <div class="texto">
                        <!-- mostrando o texto principal da pagina sobre -->
                        <?php echo($texto_principal); ?>
                    </div>
                    <div id="imagem_sobre">
                        <!-- mostrando a foto resgatada no registro do banco, imagem relacionada a padoka -->
                        <img src="cms/<?php echo($foto); ?>" width="500" height="300" alt="<?php echo($titulo); ?>" title="<?php echo($titulo); ?>">
                    </div>
                </section>
                <section class="conteudos" id="caracteristicas">
                    <div class="textos_caracteristicas">
                        <h3>MISSÃO</h3>
                        <!-- mostrando o texto da missao da padoka -->
                        <?php echo($texto_missao); ?>
                    </div>
                    <div class="textos_caracteristicas" id="valores">
                        <h3>VISÃO</h3>
                        <!-- mostrando o texto da visão da padoka -->
                        <?php echo($texto_visao); ?>
                    </div>
                    <div class="textos_caracteristicas">
                        <h3>VALORES</h3>
                        <!-- mostrando o texto dos valores da padoka -->
                         <?php echo($texto_valores); ?>
                    </div>
                </section>
                <section class="conteudos">
                    <div class="titulo">
                        <h2>Diversidade</h2>
                    </div>
                    <div class="texto_diversidade">
                        <!-- mostrando o texto de diversidade da padoka -->
                        <?php echo($texto_diversidade); ?>
                    </div>
                </section>
                <section class="conteudos" id="ambientes">
                    <?php
                    // select que retornará uma prévia dos ambientes da padoka,
                    // informações vindo da tabela dos ambientes
                        $sql = "select * from tbl_conteudo_ambiente WHERE status = 1 limit 3";
                        // executando o sql no banco e guardando o retorno em uma variavel
                        $result = mysql_query($sql);
                        // loop que será executado enquanto existir informações dos ambientes a serem mostradas
                        while($ambientes = mysql_fetch_array($result)){ ?>
                        <!-- esse trecho de html será repetido, mas com infromações diferentes, ou seja, comm ambientes diferentes -->
                        <div class="item_ambiente">
                            <div class="textos_ambientes">
                                <!-- mostrando o nome do ambiente -->
                                <h3><?php echo($ambientes['titulo']); ?></h3>
                                <!-- mostrando um texto sobre o ambiente -->
                                <?php echo($ambientes['texto']); ?>
                            </div>
                            <div class="imagem_ambientes">
                                <!-- mostrando uma foto do ambiente -->
                                <img src="cms/<?php echo($ambientes['foto']); ?>" width="450" height="250" alt="<?php echo($ambientes['titulo']); ?>" title="<?php echo($ambientes['titulo']); ?>">
                            </div>
                        </div>
                    <?php }?>
                </section>
            </div>
        </div>
        <!--footer é a teg para o rodapé do site-->
        <footer>
            <!-- chamando o arquivo de rodapé -->
            <?php require_once'rodape.php'; ?>
        </footer>
    </body>
</html>
