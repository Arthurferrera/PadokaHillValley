<!-- iniciando a variavel de sessão -->
<?php
    session_start();

    // chamando o arquivo de conexao com o banco
    require_once "conexao_banco.php";
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
    <!--Titulo que fica na aba da pagina-->
        <title> Padoka Hill Valley </title>
        <meta charset="utf-8">
    <!--link de ligação com arquivo CSS-->
        <link rel="stylesheet" type="text/css" href="css/styleHome.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
        <link rel="stylesheet" type="text/css" href="css/styleRodape.css">
    <!--colocando o icone na aba da pagina-->
        <link rel="shortcut icon" href="imagens/icone.png" type="image/x-icon">
    <!--links de ligação com aquivos JS-->
        <script src="js/jquery-3.2.1.min.js"></script>
        <script src="js/jquery.cycle.all.js"></script>
    <!--script de execução do slider-->
        <script>
        // função para o slide da pagina
            $(function(){
                // identtificando o slide a chamando o arquivo JavaScript
              $("#conteudo_slider ul").cycle ({
                    // tipo de efeito
                    fx: 'fade',
                    // velocidade da transiçãp
                    speed: 1000,
                    // tempo de cada slide
                    timeout: 4000,
                    // identtificando o elemento que vai avançar o slide
                    next: '#seta_avancar',
                    // identtificando o elemento que vai voltar o slide
                    prev: '#seta_voltar',
                })
              })

              $(document).ready(function(){
                  $('.detalhes').click(function(){
                      $('.container').fadeIn(600);
                  });
              });

              function modal(idProduto){
                  $.ajax({
                    type: "POST",
                    url: "modal.php",
                    data: {id:idProduto},
                    success: function(dados){
                        $('.modal').html(dados);
                    }
                  });
              }
        </script>
    </head>
    <body>
    <!-- parte da modal dos produtos -->
    <div class="container">
        <div class="modal"></div>
    </div>
    <!--header é a teg de cabeçalho-->
        <header>
            <!-- require_once chama um arquivo externo -->
            <?php require_once'cabecalho.php'; ?>
        </header>
        <!--essa div é usada para alinhar o conteudo principal do site com o header-->
        <div id="gamb"></div>
        <!--main é a parte principal do site, onde fica o slider e os conteudos-->
        <div id="main">
            <!--essa section é para reservar o espaço do slider-->
            <section id="slider">
                <!--div que comporta os elementos do slider-->
                <div id="content_slider">
                    <!--seta para voltar o slider-->
                    <div class="setas">
                        <img src="imagens/seta_voltar.png" width="90" height="80" title="Voltar" alt="Voltar" class="img_setas" id="seta_voltar">
                    </div>
                    <!--aqui fica cada um dos sliders-->
                    <div id="conteudo_slider">
                        <ul>
                            <li>
                                <div class="slider1">
                                    <div class="imagem_slider1">
                                        <img src="imagens/slider1.png" width="1200" height="350" alt="Lanche a moda da casa" title="Lanche a moda da casa">
                                    </div>
                                    <p id="txt_slider1">
                                        O melhor hamburguer da região...
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="slider1">
                                    <div class="imagem_slider1">
                                        <img src="imagens/slider/ambienteleitura.jpg" width="1200" height="350" alt="Ambiente de Leitura" title="Ambiente de Leitura">
                                    </div>
                                    <p id="txt_slider2">
                                        Gosta de ler? <br>
                                        Venha conhecer nosso espaço<br>
                                        para amantes da leitura
                                    </p>
                                </div>
                            </li>
                            <li>
                                <div class="slider1">
                                    <div class="imagem_slider1">
                                        <img src="imagens/slider/ambienteretro.jpg" width="1200" height="350" alt="Ambiente Retrô" title="Ambiente Retrô">
                                    </div>
                                    <p id="txt_slider3">
                                        Aqui nossa padaria foi totalmente
                                        <br>
                                        preparada para os amantes do
                                        <br>
                                        bom e velho Rock and Roll
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!--seta para avançar o slider-->
                    <div class="setas">
                        <img src="imagens/seta_avancar.png" width="90" height="80" title="Avançar" alt="Avançar" class="img_setas" id="seta_avancar">
                    </div>
                </div>
            </section>
            <!--seciton usada para o menu lateral-->
            <section id="menu_lateral">
                <!--itens do menu lateral-->
                <?php
                    $sql = "select * from tbl_categoria where status = 1";
                    $result = mysql_query($sql);
                    while($categorias = mysql_fetch_array($result)){
                        $nomeCategoria = $categorias['nome'];
                        $idCategoria = $categorias['id'];
                ?>
                        <div class="itens_lateral">
                            <a href="index.php?tipo=categoria&id=<?php echo $idCategoria;?>" class="links">
                                <h4 class="texto_itens">
                                    <?php echo($nomeCategoria); ?>
                                </h4>
                            </a>
                            <div class="submenu_lateral">
                            <?php
                                $sql_subcategoria = "select * from tbl_tipoproduto where status = 1 and idCategoria =".$idCategoria;
                                $result_subcategoria = mysql_query($sql_subcategoria);
                                while($subcategorias = mysql_fetch_array($result_subcategoria)){
                                    $nomeSubategorias = $subcategorias['nome'];
                                    $idSubcategoria = $subcategorias['id']; ?>
                                    <a href="index.php?tipo=subcategoria&id=<?php echo $idSubcategoria;?>" class="links">
                                        <div class="subitens_lateral">
                                            <span class="texto_itens"><?php  echo($nomeSubategorias); ?></span>
                                        </div>
                                    </a>
                            <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
            </section>
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
            <!--content é onde fica o conteudo do site, no alguns produtos os produtos-->
            <section id="content">
                <form action="index.php" method="get">
                    <div class="pesquisar">
                        <input type="text" name="txtPesquisar" class="txtPesquisar">
                        <input type="submit" name="btnPesquisar" value="Pesquisar" class="botao_style">
                    </div>
                </form>
                <!--linha é o espaço que agrupa os produtos-->
                <div class="linha">
                    <!--produtos são as caixas com imagem, e informações de cada produto-->
                    <?php
                        if(isset($_GET['tipo'])){
                            $tipo = $_GET['tipo'];
                            $id = $_GET['id'];
                            if($tipo == 'categoria'){
                                $sql = "select p.id, p.nome, p.descricao, p.preco, p.foto
                                        from tbl_produto as p
                                        INNER JOIN tbl_tipoproduto as tp
                                        ON tp.id = p.idTipoproduto
                                        INNER JOIN tbl_categoria as c
                                        ON c.id = tp.idCategoria
                                        WHERE c.id =".$id;
                            } else if($tipo == 'subcategoria'){
                                $sql = "select * from tbl_produto WHERE idTipoproduto = ".$id;
                            }
                        } else {
                            $sql = "select * from tbl_produto where status = 1 order by Rand()";
                        }


                        if (isset($_GET['btnPesquisar'])) {
                            $nomeProduto = $_GET['txtPesquisar'];
                            $nomeProduto = "%".$nomeProduto."%";

                            $sql = "select * from tbl_produto where nome like '".$nomeProduto."' or descricao like '".$nomeProduto."'";
                        }


                        $result = mysql_query($sql);
                        while($produtos = mysql_fetch_array($result)){
                            $nome = $produtos['nome'];
                            $preco = $produtos['preco'];
                            $foto = $produtos['foto'];
                            $descricao = $produtos['descricao'];
                            $idProduto = $produtos['id'];
                    ?>
                        <div class="produtos">
                            <!--div de imagem do produto-->
                            <div class="imagem_produto">
                                <img src="cms/<?php echo($foto);?>" width="250" height="200" alt="<?php echo($nome);?>" title="<?php echo($nome);?>">
                            </div>
                            <!--linha que fica o nome do produto-->
                            <div class="linhas_detalhes">
                                <div class="label_produtos">
                                    Nome:
                                </div>
                                <div class="text_produto">
                                    <?php echo($nome);?>
                                </div>
                            </div>
                            <!--linha que fica a descrição do produto-->
                            <div class="linhas_detalhes">
                                <div class="label_produtos">
                                    Descrição:
                                </div>
                                <div class="text_produto">
                                    <?php echo($descricao);?>
                                </div>
                            </div>
                            <!--linha que fica o preço do produto-->
                            <div class="linhas_detalhes">
                                <div class="label_produtos">
                                    Preço:
                                </div>
                                <div class="text_produto">
                                    <?php echo($preco);?>
                                </div>
                            </div>
                            <!--linha que fica o link para mais detalhes do produto-->
                            <div class="linhas_detalhes">
                                <div class="detalhes" onclick="modal(<?php echo($idProduto);?>)">
                                    <a class="links">Detalhes...</a>
                                </div>
                            </div>
                        </div>
                <?php } ?>
            </div>
            </section>
        </div>
        <!--footer é a teg para o rodapé do site-->
        <footer>
            <?php require_once'rodape.php'; ?>
        </footer>
    </body>
</html>
