<?php
    switch ($_SESSION['nivel']) {
        case 1:
            $admConteudo = "adm_conteudo.php";
            $admFaleConosco = "faleConosco.php";
            $admProdutos = "adm_produtos.php";
            $admUsuarios = "usuarios.php";
            break;
        case 2:
            $admConteudo = "";
            $admFaleConosco = "";
            $admProdutos = "adm_produtos.php";
            $admUsuarios = "";
            break;
        case 3:
            $admConteudo = "adm_conteudo.php";
            $admFaleConosco = "faleConosco.php";
            $admProdutos = "";
            $admUsuarios = "usuarios.php";
            break;
        default:
            $admConteudo = "";
            $admFaleConosco = "";
            $admProdutos = "";
            $admUsuarios = "";
            break;
    }
 ?>
<section id="cabecalho">
    <div id="titulo">
        CMS - Sistema de Gerenciamento do Site
    </div>
    <a href="home.php">
        <div id="logo"></div>
    </a>
</section>
<section id="menu">
    <div id="content_itens">
        <a href="<?php echo($admConteudo);?>" class="links">
            <div class="itens">
                <div class="img_item">
                    <img src="imagens/conteudo.png" alt="Administração dos Conteúdos"   title="Administração dos Conteúdos" width="85" height="75">
                </div>
                <div class="nome_item">
                    Adm. Conteúdo
                </div>
            </div>
        </a>
        <a href="<?php echo($admFaleConosco);?>" class="links">
            <div class="itens">
                <div class="img_item">
                    <img src="imagens/fale_conosco.png" alt="Administração do Fale Conosco" title="Administração do Fale Conosco" width="85" height="75">
                </div>
                <div class="nome_item">
                    Adm. Fale Conosco
                </div>
            </div>
        </a>
        <a href="<?php echo($admProdutos);?>" class="links">
            <div class="itens">
                <div class="img_item">
                    <img src="imagens/produtos.png" alt="Administração de Produtos" title="Administração de Produtos" width="85" height="75">
                </div>
                <div class="nome_item">
                    Adm. Produtos
                </div>
            </div>
        </a>
        <a href="<?php echo($admUsuarios);?>" class="links">
            <div class="itens">
                <div class="img_item">
                    <img src="imagens/usuarios.png" alt="Administração de Usuários" title="Administração de Usuários" width="85" height="75">
                </div>
                <div class="nome_item">
                    Adm. Usuários
                </div>
            </div>
        </a>
    </div>
    <div id="content_logout">
        <div id="informacao_usuario">
            Bem vindo, <br><?php echo($_SESSION['nome']);?>
        </div>
        <div id="logout">
            <a class="links" href="login.php?modo=sair">Logout</a>
        </div>
    </div>
</section>
