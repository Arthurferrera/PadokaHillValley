<?php
    // chamando arquivos externos
    require_once "verificacao.php";
    require_once "../conexao_banco.php";

    // verificando se o usuario tem permissão para acessar essa página
    require_once "autenticacao_nivel.php";
    $permissao = [1,3];
    autenticar($permissao);
    
// verificando se a variavel modo existe na url
if(isset($_GET['modo'])){
    // resgatando a variavel modo
    $modo = $_GET['modo'];
    // verificando como esta escrito a variavel modo
    if($modo == 'excluir'){
        // resgatando o id da url
        $id = $_GET['id'];
        // sql de excluir um registro
        $sql = 'DELETE FROM tbl_fale_conosco WHERE id = '.$id;
        // executando no banco
        mysql_query($sql);
    }
}
?>
<!-- inicio do codigo html -->
<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Geranciamento - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleFaleConosco.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
        <script src="js/jquery.js"></script>
        <script>
//            codigo para a modal
            $(document).ready(function(){
                // definindo oclick em uma div
                $('.visualizar').click(function(){
                    // chamando a div definindo o efeito e o tempo de transição
                    $('.container').fadeIn(1000);
                });
            });

            // função da modal
            function modal(idItem){
                $.ajax({
                    // definindo o metodo que será passado as informações
                    type: "POST",
                    // url é o caminho do arquivo da modal
                    url: "modal.php",
                    // passando os dados
                    data: {id:idItem},
                    success: function(dados){
                        $('.modal').html(dados);
                    }
                });
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="modal"></div>
        </div>
        <div id="main">
            <header>
                <!-- CHAMANDO O ARQUIVO DO MENU -->
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
                <div id="titulo_content">
                    Registros do Fale Conosco
                </div>

                <div id="tabela">
                    <div id="linha_titulos">
                        <div id="titulos_tabela">
                            <div class="titulos">
                                Nome
                            </div>
                            <div class="titulos">
                                Celular
                            </div>
                            <div class="titulos">
                                E-mail
                            </div>
                            <div class="titulos">
                                Sugestão
                            </div>
                            <div class="titulos">
                                Opções
                            </div>
                        </div>
                    </div>
                    <div id="registros">
                        <?php
                            // select que retornará os contatos feitos pelos clientes
                            $sql =  "SELECT * FROM tbl_fale_conosco order by id desc";
                            // executando no banco
                            $resultado = mysql_query($sql);
                            // loop que resgatará todos os registros
                            while($registros = mysql_fetch_array($resultado)){
                        ?>
                            <div class="registros_tabela">
                                <div class="registros">
                                    <!-- mostrando o nome -->
                                    <?php echo($registros['nome']);?>
                                </div>
                                <div class="registros">
                                    <!-- mostrando o numero de celular -->
                                    <?php echo($registros['celular']);?>
                                </div>
                                <div class="registros" title="<?php echo($registros['email']);?>">
                                    <!-- mostrando o email -->
                                    <?php echo($registros['email']);?>
                                </div>
                                <div class="registros" title="<?php echo($registros['sugestao']);?>">
                                    <!-- mostrando a sugestão -->
                                    <?php echo($registros['sugestao']);?>
                                </div>
                                <div class="registros">
                                    <img src="imagens/visualizar.png" class="visualizar"
                                    onclick="modal(<?php echo($registros['id']);?>);">

                                    <a href="faleConosco.php?modo=excluir&id=<?php echo($registros['id']);?>">
                                        <img src="imagens/delete.png" class="img-opcoes">
                                    </a>
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
