<?php
    // chamando arquivos externos
    require_once "verificacao.php";
    require_once "../conexao_banco.php";

    // verificando se o usuario tem permissão para acessar essa página
    require_once "autenticacao_nivel.php";
    $permissao = [1,3];
    autenticar($permissao);

    // criando as variaveis
    $id = "";
    $titulo = "";
    $texto_principal = "";
    $foto = "";
    $texto_missao = "";
    $texto_visao = "";
    $texto_valores = "";
    $texto_diversidade = "";
    $status = 0;
    $botao = "Salvar";

    // verificando se o formulário foi submetido
    if(isset($_POST['txtTitulo'])){
        // resgatando todas as informações dos inputs via método POST
        $titulo = $_POST['txtTitulo'];
        $texto_principal = $_POST['txtTextoPrincipal'];
        $foto = $_POST['txtFoto'];
        $texto_missao = $_POST['txtTextoMissao'];
        $texto_visao = $_POST['txtTextoVisao'];
        $texto_valores = $_POST['txtTextoValores'];
        $texto_diversidade = $_POST['txtTextoDiversidade'];
        $status = 0;

        // verificando qual o modo, EDITAR OU SALVAR
        if($_GET['btnSalvar'] == "Salvar"){
            // sql de salvar
            $sql = "INSERT INTO tbl_sobre (titulo, texto_principal, foto, texto_missao, texto_visao, texto_valor, texto_diversidade, status) ";
            $sql .= "VALUES ('".$titulo."', '".$texto_principal."', '".$foto."', '".$texto_missao."', '".$texto_visao."', '".$texto_valores."', '".$texto_diversidade."', '".$status."')";
        } else if($_GET['btnSalvar'] == "Editar"){
            // sql de EDITAR
            $sql = "UPDATE tbl_sobre SET
            titulo = '".$titulo."',
            texto_principal = '".$texto_principal."',
            foto = '".$foto."',
            texto_missao = '".$texto_missao."',
            texto_visao = '".$texto_visao."',
            texto_valor = '".$texto_valores."',
            texto_diversidade = '".$texto_diversidade."'
            WHERE id = ".$_SESSION['idSessao'];
        }
        // execuitando o sql no banco
        mysql_query($sql);
        // redirecionando a pagina
        header("location:adm_sobre.php");
    }

    // verificando se existe a variavel modo na URL
    if(isset($_GET['modo'])){
        // Resgatando a variavel modo da URL
        $modo = $_GET['modo'];

        // VERIFICANDO QUAL MODO ESTÁ
        if($modo == 'excluir'){
            // resgatando o id da url
            $id = $_GET['id'];
            // sql de excluir um registro
            $sql = "DELETE FROM tbl_sobre WHERE id = ".$id;
            mysql_query($sql);
        } else if ($modo == 'status'){
            // resgatando o id da url
            $id = $_GET['id'];
            $status = $_GET['status'];

            if($status == 1){
                // sql de atualizar o status de um registro para 0
                $sql = "UPDATE tbl_sobre SET status = 0 WHERE id = ".$id;
            } else if($status == 0){
                // sql para desativar todos os registros
                // necessário pois só é possivel ficar um registro ativado
                $sql_zerar = "UPDATE tbl_sobre SET status = 0";
                // executando no banco
                mysql_query($sql_zerar);
                // sql de atualizar o status de um registro para 1
                $sql = "UPDATE tbl_sobre SET status = 1 WHERE id = ".$id;
            }
            // executando no banco
            mysql_query($sql);
        } else if ($modo == 'consultar'){
            // resgatando o id da url
            $id = $_GET['id'];
            // sql de consultar um registro
            $sql = "SELECT * FROM tbl_sobre WHERE id = ".$id;
            // executando no banco
            $result = mysql_query($sql);
            // if que puxa as informações de apenas um registro para fazer sua edição
            if($registro = mysql_fetch_array($result)){
                // puxando as informações do banco
                $id = $registro['id'];
                // passando o ID  do registro para a variavel de sessao
                $_SESSION['idSessao'] = $id;
                // puxando as informações do banco
                $titulo = $registro['titulo'];
                $texto_principal = $registro['texto_principal'];
                $foto = $registro['foto'];
                $texto_missao = $registro['texto_missao'];
                $texto_visao = $registro['texto_visao'];
                $texto_valores = $registro['texto_valor'];
                $texto_diversidade = $registro['texto_diversidade'];
                $botao = "Editar";
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Geranciamento - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleAdmSobre.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.form.js"></script>
        <script>
//            Evento padrão para carregar as funções em jQuery,
//            é obrigatório usar esse evento para colocar as
//            funções do projeto
            $(document).ready(function(){
//              Função para o estado live do objeto file, que seria
//              quando o objeto for modificado pelo evento change
               $('#fotos').live('change', function(){

                   $('#foto').html('<img src=imagens/ajax-loader.gif>');

               setTimeout(function(){
//                   Forçando via Ajax um submit  dor form da foto,
//                   já que não temos um botão
                  $('#frmFoto').ajaxForm({
//                        target:'#foto'; -  é o retorno da imagem na div foto
//                        CallBack do formulario(Retorno do resultado do formulario)
                        target:'#foto'
                    }).submit();
                   },2000);
               });

//                Function para o evento click do btnSalvar
                $('#btnSalvar').click(function(){
//                    Coloca um GIF animado na div foto, ficando 2 segundos até fazer o submit
//                    no formulário, para isso usamos o setTimeout
                    $('#foto').html('<img src=imagens/ajax-salvando.gif>');

                    setTimeout(function(){
                        $('#frmcadastro').submit();
                    },2000);

                });
            });
        </script>
    </head>
    <body>
        <div id="main">
            <header>
                <!-- chamando arquivo do menu -->
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
                 <div id="titulo_content">
                    Administração da Página Sobre
                </div>
                <form name="frmFoto" method="post" action="upload_fotos.php?txt=txtFoto" enctype="multipart/form-data" id="frmFoto">
                    <div class="campos" id="lugar_foto">
                        <span class="label">Imagem Principal</span><br>
                        <div id="foto"><img src="<?php echo($foto);?>"></div>
                        <input type="file" name="fleFoto" id="fotos">
                    </div>
                </form>
                <form id="frmcadastro" name="frmCadastro" method="post" action="adm_sobre.php?btnSalvar=<?php echo($botao);?>">
                    <input type="hidden" name="txtFoto" value="<?php echo($foto);?>">
                    <section class="secao_principal">
                        <div class="campos">
                            <span class="label">Titulo</span><br>
                            <input type="text" name="txtTitulo" value="<?php echo($titulo);?>"><br><br>
                            <span class="label">Texto principal</span><br>
                            <textarea type="text" name="txtTextoPrincipal"><?php echo($texto_principal);?></textarea>
                        </div>
                    </section>

                     <section class="secao_principal">
                        <div class="campos">
                            <span class="label">Texto Missão</span><br>
                            <textarea type="text" name="txtTextoMissao" class="texts"><?php echo($texto_missao);?></textarea><br><br>
                            <span class="label">Texto Visão</span><br>
                            <textarea type="text" name="txtTextoVisao" class="texts"><?php echo($texto_visao);?></textarea>
                        </div>
                        <div class="campos">
                            <span class="label">Texto Valores</span><br>
                            <textarea type="text" name="txtTextoValores" class="texts"><?php echo($texto_valores);?></textarea><br><br>
                            <span class="label">Texto Diversidade</span><br>
                            <textarea type="text" name="txtTextoDiversidade" class="texts"><?php echo($texto_diversidade);?></textarea>
                        </div>
                    </section>

                    <div id="botao">
                        <input type="button" id="btnSalvar" value="<?php echo($botao);?>" name="btnSalvar" class="botao_style">
                    </div>
                </form>

                 <section class="secao_principal" id="section_tabela">
                     <div id="tabela">
                         <div id="linha_titulos">
                             <div id="titulos_tabela">
                                 <div class="titulos">
                                     Titulo
                                 </div>
                                 <div class="titulos" style="padding-top:5px; height:45px;">
                                     Texto Principal
                                 </div>
                                 <div class="titulos">
                                     Texto Missão
                                 </div>
                                 <div class="titulos">
                                     Texto Visão
                                 </div>
                                 <div class="titulos">
                                     Texto Valores
                                 </div>
                                 <div class="titulos" style="padding-top:5px; height:45px;">
                                     Texto Diversidade
                                 </div>
                                 <div class="titulos">
                                     Opções
                                 </div>
                             </div>
                             <div id="registros">
                                <?php
                                    // select que retornará os registros da tabela sobre
                                    $sql = "SELECT * FROM tbl_sobre";
                                    // executando no banco
                                    $result = mysql_query($sql);
                                    // loop que puxa todos os registros
                                    while($registros = mysql_fetch_array($result)){
                                        // verificando o status dos registros para receber a imagem correta
                                        if($registros['status'] == 1){
                                            $imgStatus = "status1.png";
                                        } else {
                                            $imgStatus = "status0.png";
                                        }
                                 ?>
                                <div class="registros_tabela">
                                    <div class="registros">
                                        <!-- mostrando o titulo -->
                                        <?php echo($registros['titulo']); ?>
                                    </div>
                                    <div class="registros">
                                        <!-- mostrandoo o texto principal -->
                                        <?php echo($registros['texto_principal']); ?>
                                    </div>
                                    <div class="registros" title="">
                                        <!-- mostrandoo o texto da missão -->
                                        <?php echo($registros['texto_missao']); ?>
                                    </div>
                                    <div class="registros">
                                        <!-- mostrandoo o texto da visao -->
                                        <?php echo($registros['texto_visao']); ?>
                                    </div>
                                    <div class="registros">
                                        <!-- mostrandoo o texto dos valores -->
                                        <?php echo($registros['texto_valor']); ?>
                                    </div>
                                    <div class="registros">
                                        <!-- mostrandoo o texto da diversidade -->
                                        <?php echo($registros['texto_diversidade']); ?>
                                    </div>
                                    <div class="registros">
                                        <a href="adm_sobre.php?modo=excluir&id=<?php echo($registros['id']); ?>">
                                            <img src="imagens/delete.png" class="img_opcoes">
                                        </a>
                                        <a href="adm_sobre.php?modo=consultar&id=<?php echo($registros['id']); ?>">
                                            <img src="imagens/edit.png" class="img_opcoes">
                                        </a>
                                        <a href="adm_sobre.php?modo=status&id=<?php echo($registros['id']);?>&status=<?php echo($registros['status']);?>">
                                            <img src="imagens/<?php echo($imgStatus);?>" class="img_opcoes">
                                        </a>
                                    </div>
                                </div>
                                 <?php } ?>
                            </div>
                         </div>
                     </div>
                </section>
            </div>
            <!-- rodapé -->
            <footer>
                Desenvolvido por: Arthur Ferreira
            </footer>
        </div>
    </body>
</html>
