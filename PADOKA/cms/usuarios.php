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
        <link rel="stylesheet" type="text/css" href="css/styleUsuarios.css">
        <link rel="stylesheet" type="text/css" href="css/styleMenu.css">
    </head>
    <body>
        <div id="main">
            <header>
                <?php require_once 'menu.php'; ?>
            </header>
            <div id="content">
                <div id="content_opcoes">
                    <a href="gerenciamento_usuarios.php" class="links">
                        <div class="opcoes">
                            <div class="imagem_opcao">
                                <img src="imagens/gerenciamento_usuarios.png" width="120" height="110" alt="Gerenciamento de usuários" title="Gerenciamento de usuários">
                            </div>
                            <div class="titulo_opcao">
                                Gerenciamento de Usuários
                            </div>
                        </div>
                    </a>
                    <a href="gerenciamento_niveis.php" class="links">
                        <div class="opcoes">
                            <div class="imagem_opcao">
                                <img src="imagens/niveis.png" width="100" height="100" alt="Gerenciamento de usuários" title="Gerenciamento de usuários">
                            </div>
                            <div class="titulo_opcao">
                                Gerenciamento de Níveis de Usuários
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
