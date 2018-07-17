<?php
    // chamando o arquivo de conexao com o banco
    require_once "conexao_banco.php";
?>

<!DOCTYPE html>
<html>
    <head>
    <!--Titulo que fica na aba da pagina-->
        <title> Padoka Hill Valley | Lojas </title>
        <meta charset="utf-8">
    <!--link de ligação com arquivo CSS-->
        <link rel="stylesheet" type="text/css" href="css/styleLojas.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
        <link rel="stylesheet" type="text/css" href="css/styleRodape.css">
    <!--colocando o icone na aba da pagina-->
        <link rel="shortcut icon" href="imagens/icone.png" type="image/x-icon">
    </head>
    <body>
    <!--header é a teg de cabeçalho-->
        <header>
            <!-- chamando o arquivo di cabecalho -->
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
                    Nossas Lojas
                </div>
                <section id="imagem_mapa"></section>
                <?php
                    // comando sql que será executado no banco, trazendo as informações das lojas ativas
                    $sql = "SELECT l.nome,  l.telefone, l.email, l.logradouro,
                            l.numero, l.cep, l.cidade, l.foto, l.idEstado, l.status, e.nome AS estado
                            FROM tbl_loja AS l
                            INNER JOIN tbl_estado AS e
                            ON e.id = l.idEstado
                            WHERE l.status = 1";
                            
                    // executando o select no banco, e guardando o retorno numa variavel
                    $result = mysql_query($sql);
                    // loop que resgata todas as informações de todas as lojas ATIVAS
                    while($lojas = mysql_fetch_array($result)){
                        // resgatando as informações do banco
                        $nome = $lojas['nome'];
                        $telefone = $lojas['telefone'];
                        $email = $lojas['email'];
                        $rua = $lojas['logradouro'];
                        $numero = $lojas['numero'];
                        $cep = $lojas['cep'];
                        $cidade = $lojas['cidade'];
                        $idEstado = $lojas ['estado'];
                        $foto = $lojas['foto'];
                ?>
                    <!-- essa section será repetida com lojas diferentes enquanto tiver informações a serem mostradas -->
                    <section class="loja">
                        <div class="texto">
                            <!-- mostrando as informações de cada loja -->
                            <h1><?php echo($nome); ?></h1>
                            <p><?php echo($telefone); ?></p>
                            <p><?php echo($email); ?></p>
                            <p><?php echo($rua); ?>, nº <?php echo($numero); ?>.</p>
                            <p><?php echo($cep); ?>, <?php echo($cidade); ?> - <?php echo($idEstado); ?></p>
                        </div>
                        <div class="imagem_padaria">
                            <!-- mostrando da loja  -->
                            <img src="cms/<?php echo($foto); ?>" width="300" height="200" alt="<?php echo($nome); ?> de <?php echo($cidade); ?>- <?php echo($idEstadp); ?>" title="<?php echo($nome); ?> de <?php echo($cidade); ?>- <?php echo($idEstadp); ?>">
                        </div>
                    </section>
                <?php } ?>
            </div>
        </div>
        <!--footer é a teg para o rodapé do site-->
        <footer>
            <!-- chamando o arquivo do rodapé -->
            <?php require_once'rodape.php'; ?>
        </footer>
    </body>
</html>
