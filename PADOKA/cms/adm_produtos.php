<?php
    // verificando se o usuario está logado
    require_once "verificacao.php";
    // verificando se o usuario tem permissão para acessar essa página
    require_once "autenticacao_nivel.php";
    $permissao = [1,2];
    autenticar($permissao);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Adm. Usuários | CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleAdmProdutos.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
    </head>
    <body>
        <div id="main">
            <header>
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
                <div id="content_opcoes">
                    <a href="cadastro_categorias.php" class="links">
                        <div class="opcoes">
                            <div class="titulo_opcao">
                                Cadastro de Categorias
                            </div>
                        </div>
                    </a>
                    <a href="cadastro_subcategorias.php" class="links">
                        <div class="opcoes">
                            <div class="titulo_opcao">
                                Cadastro de Subcategorias
                            </div>
                        </div>
                    </a>
                    <a href="cadastro_produtos.php" class="links">
                        <div class="opcoes">
                            <div class="titulo_opcao">
                                Cadastro de Produtos
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <footer>
                Desenvolvido por: Arthur Ferreira
            </footer>
        </div>
    </body>
</html>
