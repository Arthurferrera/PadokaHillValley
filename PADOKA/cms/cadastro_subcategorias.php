<?php
    // chamando arquivos externos
    require_once "verificacao.php";
    require_once "../conexao_banco.php";

    // verificando se o usuario tem permissão para acessar essa página
    require_once "autenticacao_nivel.php";
    $permissao = [1,2];
    autenticar($permissao);
    
    // criando variaveis
    $nome = "";
    $id = "";
    $idCategoria = "";
    $botao = "Salvar";
    $status = 0;
    // verificando se o formulario foi submetido
    if(isset($_POST['btnSalvar'])){
        // reesgatando as informações via método POST
        $nome = $_POST['txtNome'];
        $idCategoria = $_POST['txtCategoria'];
        $status = 1;
        // verificando se o botao está como SALVAR OU EDITAR
        if($_POST['btnSalvar'] == "Salvar"){
            // sql de SALVAR
            $sql = "INSERT INTO tbl_tipoproduto (nome, status, idCategoria) ";
            $sql .= "VALUES ('".$nome."','".$status."', '".$idCategoria."')";
        } else if($_POST['btnSalvar'] == "Editar"){
            // sql de EDITAR
            $sql = " UPDATE tbl_tipoproduto SET
            nome = '".$nome."',
            idCategoria = '".$idCategoria."'
            WHERE id =".$_SESSION['idSessao'];
        }
        // executando o comando e redirecionando a pagina
        mysql_query($sql);
        header('location:cadastro_subcategorias.php');
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
            $sql = "DELETE FROM tbl_tipoproduto WHERE id =".$id;
            // executando no banco
            mysql_query($sql);
        } else if($modo == 'status'){
            // resgatando os parametros da url
            $id = $_GET['id'];
            $status = $_GET['status'];

            if($status == 1){
                // sql de atualizar o status do registro para 0
                $sql = "UPDATE tbl_tipoproduto SET status = 0 WHERE id = ".$id;
            } else if($status == 0){
                // sql de atualizar o status do registro para 1
                $sql = "UPDATE tbl_tipoproduto SET status = 1 WHERE id = ".$id;
            }
            // executando no banco
            mysql_query($sql);
        } else if($modo == 'consultar'){
            // resgatando o id da url
            $id = $_GET['id'];
            // sql de consultar um registro
            $sql = "SELECT * FROM tbl_tipoproduto WHERE id =".$id;
            // executando no banco
            $result = mysql_query($sql);
            // if que resgatará as informações do banco
            if($registro = mysql_fetch_array($result)){
                // resgatando as informações do banco
                $id = $registro['id'];
                // passando o id do registro para a variavel de sessao
                $_SESSION['idSessao'] = $id;
                // resgatando as informações do banco
                $id = $registro['id'];
                $nome = $registro['nome'];
                $idCategoria = $registro['idCategoria'];
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
        <link rel="stylesheet" type="text/css" href="css/styleCadastroSubcategoria.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
    </head>
    <body>
        <div id="main">
            <header>
                <!-- chamando o arquivo do menu -->
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
                <div class="secao_principal">
                    <form name="frmCadastro" method="post" action="cadastro_subcategorias.php" id="frmCadastro">
                        <div class="contents_campos">
                            <div class="subtitulo">
                                Nome da Categoria
                            </div>
                            <select name="txtCategoria">
                                <?php
                                    // select que retornará os ambientes cadastrados
                                    $sql = "select * from tbl_categoria where status = 1";
                                    // executando no banco
                                    $resultado = mysql_query($sql);
                                    // loop que resgatará todos os registros
                                     while($categorias = mysql_fetch_array($resultado)){
                                         // esse if serve para quando estiver no modo editar, o select vim selecionado
                                         // com a opção correta de acordo com o registro
                                        if($categorias['id'] == $idCategoria && $modo =='consultar'){
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }
                                ?>
                                        <!-- opções do select sendo carregado dentro do while -->
                                        <option <?php echo($selected);?> value="<?php echo($categorias['id']); ?>"><?php echo($categorias['nome']); ?></option>
                                <?php } ?>
                            </select>
                        <!-- parte que fica os campos  -->
                        </div>
                        <div class="contents_campos">
                            <div class="subtitulo">
                                Nome da Subcategoria
                            </div>
                            <input type="text" name="txtNome" id="input_titulo" value="<?php echo($nome);?>">
                        </div>
                        <div id="botao">
                            <input type="submit" id="btnSalvar" value="<?php echo($botao);?>" name="btnSalvar" class="botao_style">
                            <input type="reset" id="btnLimpar" value="Limpar" name="btnLimparr" class="botao_style">
                        </div>
                    </form>
                </div>
                <!-- parte que fica a tabela que mostra todos os registros cadastrados -->
                <section class="secao_principal" id="section_tabela">
                     <div id="tabela">
                         <div id="linha_titulos">
                             <div id="titulos_tabela">
                                 <div class="titulos">
                                     Nome da Subcategoria
                                 </div>
                                 <div class="titulos">
                                     Categoria
                                 </div>
                                 <div class="titulos">
                                     Opções
                                 </div>
                             </div>
                             <div id="registros">
                                <?php
                                    // select que retornará os registros da tabela do banco
                                    $sql = "SELECT tp.id, tp.nome, tp.status, c.nome AS categoria
                                    FROM tbl_tipoproduto AS tp
                                    INNER JOIN tbl_categoria AS c
                                    ON c.id = tp.idCategoria ORDER BY id DESC";
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
                                            <!-- mostrando o nome -->
                                            <?php echo($registros['nome']); ?>
                                        </div>
                                        <div class="registros">
                                            <!-- mostrando o categoria -->
                                            <?php echo($registros['categoria']); ?>
                                        </div>
                                        <div class="registros">
                                            <a href="cadastro_subcategorias.php?modo=excluir&id=<?php echo($registros['id']); ?>">
                                                <img src="imagens/delete.png" class="img_opcoes">
                                            </a>
                                            <a href="cadastro_subcategorias.php?modo=consultar&id=<?php echo($registros['id']); ?>">
                                                <img src="imagens/edit.png" class="img_opcoes">
                                            </a>
                                            <a href="cadastro_subcategorias.php?modo=status&id=<?php echo($registros['id']);?>&status=<?php echo($registros['status']);?>">
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
