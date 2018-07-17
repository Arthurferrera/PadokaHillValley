<?php
    // chamando arquivo de conexao com o banco de dados
    require_once "conexao_banco.php";

    // verificando se existe a chamada da pagina na URL
    if(isset($_GET['pagina'])){
        // resgatando os valores da URL
        $idPagina = $_GET['pagina'];
        $idConteudoAmbiente = $_GET['idConteudoAmbiente'];

        // variavel do select que será executado no banco
        $sql = "select * from tbl_conteudo_ambiente WHERE status = 1 and idTipoAmbiente = ".$idPagina." order by Rand() limit 1";
        // executando no banco o comando sql e guardando numa variavel o retorno
        $result = mysql_query($sql);

        // fazendo um loop para guardar nas variaveis os conteudos que são resgatados do banco
        while($informacoes = mysql_fetch_array($result)){
            // resgatando as informações do banco
            $titulo = $informacoes['titulo'];
            $texto_principal = $informacoes['texto'];
            $foto = $informacoes['foto'];
        }
    }

?>

<!DOCTYPE html>

<html>
    <head>
    <!--Titulo que fica na aba da pagina-->
        <title> Padoka Hill Valley | Ambiente de Leitura </title>
        <meta charset="utf-8">
    <!--link de ligação com arquivo CSS-->
        <link rel="stylesheet" type="text/css" href="css/styleAmbientes.css">
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
                <section class="conteudos">
                    <div id="titulo">
                        <article>
                            <!-- mostrando o titulo do conteudo (resgatado do banco) -->
                            <h3><?php echo($titulo);?></h3>
                        </article>
                    </div>
                    <div id="texto">
                        <h4>
                            <!-- mostrando o texto do conteudo (resgatado do banco) -->
                            <?php echo($texto_principal);?>
                        </h4>
                    </div>
                    <div id="imagem">
                        <!-- mostrando o foto do conteudo (resgatado do banco) -->
                        <img src="cms/<?php echo($foto);?>" width="500" height="250" alt="Imagem do Ambiente de Leitura" title="Imagem do Ambiente de Leitura">
                    </div>
                </section>
                <section class="conteudos" id="caracteristicas_mobile">

                    <?php
                        // guardando na variavel o comando sql que será executado no banco
                        // este select traz as caracteristicas conforme o ambiente que foi chamado atraves do menu
                        $sql_caracteristicas = "SELECT ac.titulo, ac.texto, ac.foto
                                                FROM tbl_ambiente_caracteristica AS ac
                                                INNER JOIN tbl_conteudo_ambiente AS ca
                                                ON ac.idContAmbiente = ca.id
                                                INNER JOIN tbl_tipo_ambiente AS ta
                                                ON ta.id = ca.idTipoAmbiente
                                                WHERE ca.id = ".$idConteudoAmbiente."
                                                AND ac.status = 1
                                                ORDER BY RAND() LIMIT 3";

                        // executando no banco o comando sql e guardando numa variavel o retorno
                        $result = mysql_query($sql_caracteristicas);
                        // fazendo um loop para guardar nas variaveis as caracteristicas que são resgatados do banco
                        while($caracteristicas = mysql_fetch_array($result)){
                            // Resgatando as informações do banco
                            $titulo_caracteristicas = $caracteristicas['titulo'];
                            $texto_caracteristicas = $caracteristicas['texto'];
                            $foto_caracteristicas = $caracteristicas['foto'];
                    ?>

                    <!-- divs das caracteristicas, estão dentro do while, então será criadas enquanto for executado o while -->
                    <div class="info">
                        <div class="informacao_titulo">
                            <!-- mostrando o titulo da caracteristicas -->
                            <h1><?php echo($titulo_caracteristicas);?></h1>
                        </div>
                        <div class="informacao_texto">
                            <!-- mostrando o texto da caracteristicas -->
                            <?php echo($texto_caracteristicas);?>
                        </div>
                        <div class="informacao_imagem">
                            <!-- mostrando a foto da caracteristicas -->
                            <img src="cms/<?php echo($foto_caracteristicas);?>" width="380" height="200" alt="Imagem de algumas das bebidas disponiveis" title="Imagem de algumas das bebidas disponiveis">
                        </div>
                    </div>
                    <?php } ?>
                </section>
            </div>
        </div>
        <!--footer é a teg para o rodapé do site-->
        <footer>
            <?php require_once'rodape.php'; ?>
        </footer>
    </body>
</html>
