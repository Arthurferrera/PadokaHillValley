<?php
    // chamando arquivos externos
    require_once "verificacao.php";
    require_once "../conexao_banco.php";

    // verificando se o usuario tem permissão para acessar essa página
    require_once "autenticacao_nivel.php";
    $permissao = [1,2];
    autenticar($permissao);

    // criando variaveis
    $id = "";
    $nome = "";
    $descricao = "";
    $foto = "";
    $idSubcategoria = "";
    $status = 0;
    $preco = "";
    $botao = "Salvar";
    // verificando se o formulario foi submetido
    if(isset($_POST['txtNome'])){
        // reesgatando as informações via método POST
        $nome = $_POST['txtNome'];
        $descricao = $_POST['txtDescricao'];
        $foto = $_POST['txtFoto'];
        $idSubcategoria = $_POST['txtSubcategoria'];
        $preco = $_POST['txtPreco'];
        $status = 1;
        $produtoDoMes = 0;

        // verificando se o botao está como SALVAR OU EDITAR
        if($_GET['btnSalvar'] == "Salvar"){
            // sql de SALVAR
            $sql = "INSERT INTO tbl_produto (nome, descricao, preco, foto, status, produtoDoMes, idTipoProduto) ";
            $sql .= "VALUES ('".$nome."', '".$descricao."', ".$preco.", '".$foto."', ".$status.", ".$produtoDoMes.", '".$idSubcategoria."')";
        } else if($_GET['btnSalvar'] == "Editar"){
            // sql de EDITAR
            $sql = " UPDATE tbl_produto SET
            nome = '".$nome."',
            descricao = '".$descricao."',
            preco = '".$preco."',
            foto = '".$foto."',
            idTipoProduto = '".$idSubcategoria."'
            WHERE id =".$_SESSION['idSessao'];
        }
        // executando no banco
        mysql_query($sql);
        // redirecionando a pagina
        header('location:cadastro_produtos.php');
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
            $sql = "DELETE FROM tbl_produto WHERE id =".$id;
            // executando no banco
            mysql_query($sql);
        } else if($modo == 'status'){
            // resgatando oo parametros da url
            $id = $_GET['id'];
            $status = $_GET['status'];

            if($status == 1){
                // sql de atualizar o status do registro para 0
                $sql = "UPDATE tbl_produto SET status = 0 WHERE id = ".$id;
            } else if($status == 0){
                // sql de atualizar o status do registro para 1
                $sql = "UPDATE tbl_produto SET status = 1 WHERE id = ".$id;
            }
            // executando no banco
            mysql_query($sql);
        } else if($modo == 'consultar'){
            // resgatando o id da url
            $id = $_GET['id'];
            // sql de consultar um registro
            $sql = "SELECT * FROM tbl_produto WHERE id =".$id;
            // executando o select no banco
            $result = mysql_query($sql);
            // if que resgatará as informações do banco
            if($registro = mysql_fetch_array($result)){
                // resgatando as informações do banco
                $id = $registro['id'];
                // passando o id do registro para a variavel de sessao
                $_SESSION['idSessao'] = $id;
                // resgatando as informações do banco
                $idSubcategoria = $registro['idTipoProduto'];
                $nome = $registro['nome'];
                $descricao = $registro['descricao'];
                $preco = $registro['preco'];
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
        <link rel="stylesheet" type="text/css" href="css/styleCadastroProdutos.css">
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
                    <!-- parte que fica os campos  -->
                    <form name="frmCadastro" method="post" action="cadastro_produtos.php?btnSalvar=<?php echo($botao);?>" id="frmCadastro">
                        <div class="contents_campos_menores">
                            <div class="subtitulo">
                                Subcategoria
                            </div>
                            <select name="txtSubcategoria">
                                <?php
                                    // select que retornará os ambientes cadastrados
                                    $sql = "select * from tbl_tipoproduto where status = 1";
                                    // executando no banco
                                    $resultado = mysql_query($sql);
                                    // loop que resgatará todos os registros
                                    while($subcategorias = mysql_fetch_array($resultado)){
                                        // esse if serve para quando estiver no modo editar, o select vim selecionado
                                        // com a opção correta de acordo com o registro
                                        if($subcategorias['id'] == $idSubcategoria && $modo =='consultar'){
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                ?>
                                        <!-- opções do select sendo carregado dentro do while -->
                                        <option <?php echo($selected);?> value="<?php echo($subcategorias['id']); ?>"><?php echo($subcategorias['nome']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="contents_campos_menores">
                            <div class="subtitulo">
                                Nome do Produto
                            </div>
                            <input type="text" name="txtNome" id="input_titulo" value="<?php echo($nome);?>">
                        </div>
                        <div class="contents_campos_menores">
                            <div class="subtitulo">
                                Preço
                            </div>
                            <input type="number" name="txtPreco" id="input_titulo" value="<?php echo($preco);?>">
                        </div>
                        <div class="contents_campos">
                            <div class="subtitulo">
                                Descrição do Produto
                            </div>
                            <textarea name="txtDescricao"><?php echo($descricao);?></textarea>
                        </div>
                        <div id="botao">
                            <input type="button" id="btnSalvar" value="<?php echo($botao);?>" name="btnSalvar" class="botao_style">
                            <input type="reset" id="btnLimpar" value="Limpar" name="btnLimparr" class="botao_style">
                        </div>
                        <input type="hidden" name="txtFoto" value="<?php echo($foto);?>">
                    </form>
                    <div class="contents_campos" id="content_foto">
                        <div class="subtitulo">
                            Imagem do Produto
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
                                    Nome do Produto
                                 </div>
                                 <div class="titulos" style="padding-top:5px; height:45px;">
                                    Descrição
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
                                    $sql = "SELECT * FROM tbl_produto ORDER BY id desc";
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
                                        <?php echo($registros['nome']); ?>
                                    </div>
                                    <div class="registros">
                                        <!-- mostrando o texto -->
                                        <?php echo($registros['descricao']); ?>
                                    </div>
                                    <div class="registros" title="<?php echo($registros['nome']);?>">
                                        <!-- mostrando a foto do registro -->
                                        <img src="<?php echo($registros['foto']); ?>" id="img_tabela">
                                    </div>
                                    <div class="registros">
                                        <a href="cadastro_produtos.php?modo=excluir&id=<?php echo($registros['id']); ?>">
                                            <img src="imagens/delete.png" class="img_opcoes">
                                        </a>
                                        <a href="cadastro_produtos.php?modo=consultar&id=<?php echo($registros['id']); ?>">
                                            <img src="imagens/edit.png" class="img_opcoes">
                                        </a>
                                        <a href="cadastro_produtos.php?modo=status&id=<?php echo($registros['id']);?>&status=<?php echo($registros['status']);?>">
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
