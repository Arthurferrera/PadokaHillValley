<?php
    // chamando arquivo de conexao do banco
    require_once 'conexao_banco.php';
    // resgatando o id do produto que foi passado via metodo POST
    // na chamada da modal feita via JS
    $id = $_POST['id'];
    // sql para consultar as informações do produto
    $sql = "select * from tbl_produto WHERE id =".$id;
    // executando no banco
    $result = mysql_query($sql);
    // if que resgata as informações do banco
    if ($produto = mysql_fetch_array($result)) {
        // guardando as informações em uma variavel
        $nome =  $produto['nome'];
        $preco = $produto['preco'];
        $foto = $produto['foto'];
        $descricao = $produto['descricao'];
        $qtdCliques = $produto['qtdCliques'];
    }

    $qtdCliques = $qtdCliques + 1;
    $sqlCliques = "UPDATE tbl_produto SET qtdCliques ='$qtdCliques' WHERE id =".$id;
    mysql_query($sqlCliques);
?>
<style>
    /* VERSAO MOBILE */
    @media screen and (min-device-width:200px) and (max-device-width:520px){
        /*topo da modal onde fica o nome do produto*/
        .nome_modal{
            width: 100%;
            height: 10%;
            padding-top: 2%;
            text-align: center;
            font-size: 3.2em;
            font-weight: 900;
            background-color: #8B4513;
            color: #FFFFFF;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        /*div que mostra a foto do produto*/
        .foto_modal{
            width: 100%;
            height: 35%;
            margin-top: 30px;
            text-align: center;
        }

        .foto_modal img{
            width: 70%;
            height: 100%;
        }

        /*preço do produto*/
        .preco_modal{
            width: 100%;
            height: 5%;
            text-align: center;
            font-weight: 600;
            font-size: 2.9em;
            color: #008000;
            padding-top: 2%;
            margin-top: 25px;
        }

        /*div que mostra a descrição do produto*/
        .descricao_modal{
            width: 96%;
            height: 30%;
            margin-top: 30px;
            text-align: center;
            padding: 2%;
            font-size: 2.7em;
        }

        /*div que tem a função de fechar a modal*/
        .fechar{
            width: 5%;
            height: 3%;
            position: absolute;
            margin-left: 73%;
            margin-top: 2%;
            background-image: url('imagens/fechar.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .fechar:hover{
            cursor: pointer;
        }
    }
    /* VERSÃO DESKTOP */
    @media screen and (min-device-width:521px){
        /*topo da modal onde fica o nome do produto*/
        .nome_modal{
            width: 100%;
            height: 70px;
            text-align: center;
            line-height: 70px;
            vertical-align: middle;
            font-size: 2.2em;
            font-weight: 900;
            background-color: #8B4513;
            color: #FFFFFF;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        /*div que mostra a foto do produto*/
        .foto_modal{
            width: 100%;
            height: 350px;
            margin-top: 30px;
            text-align: center;
        }

        .foto_modal img{
            width: 500px;
            height: 350px;
        }

        /*preço do produto*/
        .preco_modal{
            width: 100%;
            height: 50px;
            text-align: center;
            font-weight: 600;
            font-size: 1.9em;
            color: #008000;
            line-height: 50px;
            vertical-align: middle;
            margin-top: 25px;
        }

        /*div que mostra a descrição do produto*/
        .descricao_modal{
            width: 95%;
            height: 225px;
            margin-top: 30px;
            text-align: center;
            padding: 10px;
            margin-left: auto;
            margin-right: auto;
            font-size: 1.7em;
        }

        /*div que tem a função de fechar a modal*/
        .fechar{
            width: 30px;
            height: 30px;
            position: absolute;
            margin-left: 565px;
            margin-top: 5px;
            background-image: url('imagens/fechar.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .fechar:hover{
            cursor: pointer;
        }
    }
</style>
<!-- lincando o arquivo de JavaScript -->
<script src="js/jquery.js"></script>
<script>
    // código que faz o efeito de fechar a modal
    $(document).ready(function(){
        $('.fechar').click(function(){
            $('.container').fadeOut(600);
        });
    });
</script>
<!-- div que tem a função de fechar a modal -->
<div class="fechar"></div>
<!-- topo da modal onde fica o nome do produto -->
<div class="nome_modal">
    <?php echo($nome);?>
</div>
<!-- div que mostra a foto do produto -->
<div class="foto_modal">
    <img src="cms/<?php echo($foto);?>" alt="<?php echo($nome);?>" title="<?php echo($nome);?>">
</div>
<!-- preço do produto -->
<div class="preco_modal">
    R$ <?php echo($preco);?>
</div>
<!-- div que mostra a descrição do produto -->
<div class="descricao_modal">
    <?php echo($descricao);?>
</div>
