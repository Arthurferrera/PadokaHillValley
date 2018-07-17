<?php
    // chamando arquivos externos
    require_once "verificacao.php";
    require_once "../conexao_banco.php";

    // resgatando as informações passadas pela url, via POST
    $id = $_POST['id'];
    // slect que retorna o registro de fale conosco de acordo com id
    $sql = "select * from tbl_fale_conosco WHERE id = ".$id;
    // executando o comando no banco
    $result = mysql_query($sql);
    // if que verifica se o comando foi executado e
    // carrega as informações diretamente do banco
    if($registro = mysql_fetch_array($result)){
        // resgatando as informações do banco
        $nome = $registro['nome'];
        $telefone = $registro['telefone'];
        $celular = $registro['celular'];
        $email = $registro['email'];
        $homePage = $registro['homePage'];
        $linkFacebook = $registro['linkFacebook'];
        $sugestao = $registro['sugestao'];
        $infoProduto = $registro['infoProduto'];
        $profissao = $registro['profissao'];
    }
?>

<style>
    /* formatação do titulo da modal */
    #titulo_modal{
        width: 1000px;
        height: 70px;
        text-align: center;
        font-size: 1.8em;
        background-color: #efebea;
        margin-left: auto;
        margin-right: auto;
        line-height: 70px;
        font-weight: 900;
        vertical-align: middle;
        margin-bottom: 10px;
        border-bottom: 2px solid #000000;
        position: fixed;
    }
    /* div que da um espaço entre o titulo e o conteudo da modal */
    #gamb_modal{
        width: 900px;
        height: 70px;
    }
    /* linha da modal que contem as informações */
    .linha_modal{
        width: auto;
        height: auto;
        margin-top: 25px;
        margin-right: auto;
        margin-left: auto;
    }
    /* subtitulo da modal */
    .subtitulo_modal{
        width: 40%;
        height: 50px;
        line-height: 50px;
        vertical-align: middle;
        font-size: 1.6em;
        text-align: left;
        padding-left: 25px;
        margin-left: auto;
        margin-right: auto;
        float: left;
    }
    /* informações vinda do banco */
    .texto_modal{
        width: 50%;
        height: auto;
        line-height: 50px;
        vertical-align: middle;
        font-size: 1.3em;
        text-align: center;
        padding-left: 25px;
        margin-bottom: 15px;
        float: left;
    }
    /* div que serve para fechar a modal */
    #fechar{
        width: 20px;
        height: 20px;
        cursor: pointer;
        background-image: url(imagens/fechar.png);
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: absolute;
        margin-left: 970px;
        margin-top: 10px;
    }
</style>
<!-- lincando um arquivo JavaScript -->
<script src="js/jquery.js"></script>
<script>
    // lógica para fechar a modal
    $(document).ready(function(){
        $("#fechar").click(function(){
            $(".container").fadeOut(700);
        });
    });
</script>

<!--titulo da modal-->
<div id="titulo_modal">
    Dados do Registro
</div>
<!--div usada para fechar a modal-->
<div id="fechar"></div>

<!--div usada para o titulo não sobrepor a primeira informação-->
<div id="gamb_modal"></div>

<!--conteudos do registro sendo carregado na modal-->
    <div class="linha_modal">
        <div class="subtitulo_modal">
            Nome do cliente:
        </div>
        <div class="texto_modal">
            <?php echo($nome);?>
        </div>
    </div>
    <div class="linha_modal">
        <div class="subtitulo_modal">
            Telefone:
        </div>
        <div class="texto_modal">
            <?php echo($telefone);?>
        </div>
    </div>
    <div class="linha_modal">
        <div class="subtitulo_modal">
            Celular:
        </div>
        <div class="texto_modal">
            <?php echo($celular);?>
        </div>
    </div>
    <div class="linha_modal">
        <div class="subtitulo_modal">
            E-mail:
        </div>
        <div class="texto_modal">
            <?php echo($email);?>
        </div>
    </div>
    <div class="linha_modal">
        <div class="subtitulo_modal">
            Home Page:
        </div>
        <div class="texto_modal">
            <?php echo($homePage);?>
        </div>
    </div>
    <div class="linha_modal">
        <div class="subtitulo_modal">
            Link do Facebook:
        </div>
        <div class="texto_modal">
            <?php echo($linkFacebook);?>
        </div>
    </div>
    <div class="linha_modal">
        <div class="subtitulo_modal">
            Sugestão:
        </div>
        <div class="texto_modal">
            <?php echo($sugestao);?>
        </div>
    </div>
    <div class="linha_modal">
        <div class="subtitulo_modal">
            Informação de algum Produto:
        </div>
        <div class="texto_modal">
            <?php echo($infoProduto);?>
        </div>
    </div>
    <div class="linha_modal">
        <div class="subtitulo_modal">
            Profissão do Cliente:
        </div>
        <div class="texto_modal">
            <?php echo($profissao);?>
        </div>
    </div>
