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
        <title>Adm. Usuários | CMS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="css/styleGerenciamentoAmbientes.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
    </head>
    <body>
        <div id="main">
            <header>
                <!-- chamando arquivo do menu -->
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
                <div id="content_opcoes">
                    <a href="cadastro_ambientes.php" class="links">
                        <div class="opcoes">
                            <div class="imagem_opcao">
                                <img src="imagens/cadastro_ambientes.png" width="120" height="110" alt="Gerenciamento de Ambientes" title="Gerenciamento de Ambientes">
                            </div>
                            <div class="titulo_opcao">
                                Gerenciamento de Ambientes
                            </div>
                        </div>
                    </a>
                    <a href="conteudo_ambientes.php" class="links">
                        <div class="opcoes">
                            <div class="imagem_opcao">
                                <img src="imagens/gerenciamento_conteudos_ambientes.jpg" width="100" height="100" alt="Gerenciamento de Conteúdo" title="Gerenciamento de Conteúdo">
                            </div>
                            <div class="titulo_opcao">
                                Gerenciamento de Conteúdo
                            </div>
                        </div>
                    </a>
                    <a href="caracteristicas_ambientes.php" class="links">
                        <div class="opcoes">
                            <div class="imagem_opcao">
                                <img src="imagens/caracteristicas_ambientes.png" width="100" height="100" alt="Gerenciamento de Características" title="Gerenciamento de Características">
                            </div>
                            <div class="titulo_opcao">
                                Gerenciamento de Características
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- rodapé -->
            <footer>
                Desenvolvido por: Arthur Ferreira
            </footer>
        </div>
    </body>
</html>
