<?php
    // verificando se o usuario está logado
    require_once "verificacao.php";
    // verificando se o usuario tem permissão para acessar essa página
    require_once "autenticacao_nivel.php";
    $permissao = [1,3];
    autenticar($permissao);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sistema de Geranciamento - CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleAdmConteudo.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
    </head>
    <body>
        <div id="main">
            <header>
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
                <div id="titulo_content">
                    Páginas
                </div>
                <a class="links" href="gerenciamento_ambientes.php">
                    <div class="paginas">
                        Ambientes
                    </div>
                </a>
                <a class="links" href="adm_sobre.php">
                    <div class="paginas">
                        Sobre
                    </div>
                </a>
                <a class="links" href="adm_promocao.php">
                    <div class="paginas">
                        Promoções
                    </div>
                </a>
                <a class="links" href="lojas.php">
                    <div class="paginas">
                        Lojas
                    </div>
                </a>
                <a class="links" href="adm_produtoMes.php">
                    <div class="paginas">
                        Produto do Mês
                    </div>
                </a>
            </div>
            <footer>
                Desenvolvido por: Arthur Ferreira
            </footer>
        </div>
    </body>
</html>
