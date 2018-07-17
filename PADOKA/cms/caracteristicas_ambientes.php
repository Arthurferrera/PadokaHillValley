<?php
    // chamando arquivos externos
    require_once "verificacao.php";
    require_once "../conexao_banco.php";

    // verificando se o usuario tem permissão para acessar essa página
    require_once "autenticacao_nivel.php";
    $permissao = [1,3];
    autenticar($permissao);
    
    // criando variaveis
    $id = "";
    $titulo = "";
    $texto = "";
    $foto = "";
    $idConteudoAmbiente = "";
    $status = 0;
    $botao = "Salvar";
    // verificando se o formulario foi submetido
    if(isset($_POST['txtTitulo'])){
        // reesgatando as informações via método POST
        $titulo = $_POST['txtTitulo'];
        $texto = $_POST['txtTexto'];
        $foto = $_POST['txtFoto'];
        $idConteudoAmbiente = $_POST['txtConteudoAmbiente'];
        $status = 1;
        // verificando se o botao está como SALVAR OU EDITAR
        if($_GET['btnSalvar'] == "Salvar"){
            // sql de SALVAR
            $sql = "INSERT INTO tbl_ambiente_caracteristica (idContAmbiente, titulo, texto, foto, status) ";
            $sql .= "VALUES ('".$idConteudoAmbiente."', '".$titulo."', '".$texto."', '".$foto."', '".$status."')";
        } else if($_GET['btnSalvar'] == "Editar"){
            // sql de EDITAR
            $sql = " UPDATE tbl_ambiente_caracteristica SET
            idContAmbiente = '".$idConteudoAmbiente."',
            titulo = '".$titulo."',
            texto = '".$texto."',
            foto = '".$foto."'
            WHERE id =".$_SESSION['idSessao'];
        }
        // executando no banco
        mysql_query($sql);
        // redirecionando a pagina
        header('location:caracteristicas_ambientes.php');
    }
    // verificando se a variavel modo existe na url
    if(isset($_GET['modo'])){
        // resgatando a variavel modo
        $modo = $_GET['modo'];
        // verificando como esta escrito a variavel modo
        if($modo == 'excluir'){
            // resgatando o id da url
            $id = $_GET['id'];
            // sql de excluir um registro
            $sql = "DELETE FROM tbl_ambiente_caracteristica WHERE id =".$id;
            // executando no banco
            mysql_query($sql);
        } else if($modo == 'status'){
            // resgatando oo parametros da url
            $id = $_GET['id'];
            $status = $_GET['status'];

            if($status == 1){
                // sql de atualizar o status do registro para 0
                $sql = "UPDATE tbl_ambiente_caracteristica SET status = 0 WHERE id = ".$id;
            } else if($status == 0){
                // sql de atualizar o status do registro para 1
                $sql = "UPDATE tbl_ambiente_caracteristica SET status = 1 WHERE id = ".$id;
            }
            // executando no banco
            mysql_query($sql);
        } else if($modo == 'consultar'){
            // resgatando o id da url
            $id = $_GET['id'];
            // sql de consultar um registro
            $sql = "SELECT * FROM tbl_ambiente_caracteristica WHERE id =".$id;
            // executando o select no banco
            $result = mysql_query($sql);
            // if que resgatará as informações do banco
            if($registro = mysql_fetch_array($result)){
                // resgatando as informações do banco
                $id = $registro['id'];
                // passando o id do registro para a variavel de sessao
                $_SESSION['idSessao'] = $id;
                // resgatando as informações do banco
                $idConteudoAmbiente = $registro['idContAmbiente'];
                $titulo = $registro['titulo'];
                $texto = $registro['texto'];
                $foto = $registro['foto'];
                $botao = "Editar";
            }
        }
    }
?>
<!-- inicio do codigo html -->
<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Geranciamento - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleCaracteristicasAmbientes.css">
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
//                        target:'#visualizar'; -  é o retorno da imagem na div visualizar
//                        CallBack do formulario(Retorno do resultado do formulario)
                        target:'#foto'
                    }).submit();
                   },2000);
               });

//                Function para o evento click do btnSalvar
                $('#btnSalvar').click(function(){
//                    Coloca um GIF animado na div visualizar, ficando 2 segundos até fazer o submit
//                    no formulário, para isso usamos o setTimeout
                    $('#foto').html('<img src=imagens/ajax-salvando.gif>');

                    setTimeout(function(){
                        $('#frmCadastro').submit();
                    },2000);

                });
            });
        </script>
    </head>
    <body>
        <div id="main">
            <header>
                <!-- chamando o arquivo do menu -->
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
                <div class="secao_principal">
                    <form name="frmCadastro" method="post" action="caracteristicas_ambientes.php?btnSalvar=<?php echo($botao);?>" id="frmCadastro">
                        <div class="contents_campos">
                            <div class="subtitulo">
                                Nome do Ambiente
                            </div>
                            <select name="txtConteudoAmbiente">
                                <?php
                                    // select que retornará os ambientes cadastrados
                                    $sql = "select * from tbl_conteudo_ambiente where status = 1";
                                    // executando no banco
                                    $resultado = mysql_query($sql);
                                    // loop que resgatará todos os registros
                                    while($ambientes = mysql_fetch_array($resultado)){
                                        // esse if serve para quando estiver no modo editar, o select vim selecionado
                                        // com a opção correta de acordo com o registro
                                        if($ambientes['id'] == $idConteudoAmbiente && $modo =='consultar'){
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                ?>
                                        <!-- opções do select sendo carregado dentro do while -->
                                        <option <?php echo($selected);?> value="<?php echo($ambientes['id']); ?>"><?php echo($ambientes['titulo']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <!-- parte que fica os campos  -->
                        <div class="contents_campos">
                            <div class="subtitulo">
                                Titulo da Caracteristicas
                            </div>
                            <input type="text" name="txtTitulo" id="input_titulo" value="<?php echo($titulo);?>">
                        </div>
                        <div class="contents_campos">
                            <div class="subtitulo">
                                Texto Caracteristicas
                            </div>
                            <textarea name="txtTexto"><?php echo($texto);?></textarea>
                        </div>
                        <div id="botao">
                            <input type="button" id="btnSalvar" value="<?php echo($botao);?>" name="btnSalvar" class="botao_style">
                            <input type="reset" id="btnLimpar" value="Limpar" name="btnLimparr" class="botao_style">
                        </div>
                        <input type="hidden" name="txtFoto" value="<?php echo($foto);?>">
                    </form>
                    <div class="contents_campos" id="content_foto">
                        <div class="subtitulo">
                            Foto Caracteristicas
                        </div>
                        <form name="frmFoto" method="post" action="upload_fotos.php?txt=txtFoto" enctype="multipart/form-data" id="frmFoto">
                            <div class="campos" id="lugar_foto">
                                <div id="foto"><img src="<?php echo($foto);?>"></div>
                                <input type="file" name="fleFoto" id="fotos">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- parte que fica a tabela que mostra todos os registros cadastrados -->
                <section class="secao_principal" id="section_tabela">
                     <div id="tabela">
                         <div id="linha_titulos">
                             <div id="titulos_tabela">
                                 <div class="titulos">
                                     Titulo
                                 </div>
                                 <div class="titulos" style="padding-top:5px; height:45px;">
                                     Texto Caracteristicas
                                 </div>
                                 <div class="titulos">
                                     Foto
                                 </div>
                                 <div class="titulos">
                                     Opções
                                 </div>
                             </div>
                             <div id="registros">
                                <?php
                                    // select que retornará os registros da tabela do banco
                                    $sql = "SELECT * FROM tbl_ambiente_caracteristica";
                                    // executando no banco
                                    $result = mysql_query($sql);
                                    // loop que resgatará todos os registros
                                    while($registros = mysql_fetch_array($result)){
                                        // verificando o status para receber a imagem correta
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
                                        <!-- mostrando o texto -->
                                        <?php echo($registros['texto']); ?>
                                    </div>
                                    <div class="registros" title="<?php echo($registros['titulo']);?>">
                                        <!-- mostrando a foto do registro -->
                                        <img src="<?php echo($registros['foto']); ?>" id="img_tabela">
                                    </div>
                                    <div class="registros">
                                        <a href="caracteristicas_ambientes.php?modo=excluir&id=<?php echo($registros['id']); ?>">
                                            <img src="imagens/delete.png" class="img_opcoes">
                                        </a>
                                        <a href="caracteristicas_ambientes.php?modo=consultar&id=<?php echo($registros['id']); ?>">
                                            <img src="imagens/edit.png" class="img_opcoes">
                                        </a>
                                        <a href="caracteristicas_ambientes.php?modo=status&id=<?php echo($registros['id']);?>&status=<?php echo($registros['status']);?>">
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
