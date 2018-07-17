<!--essa sectionserve para poder alinhar os elementos no centro da pagina-->
<section id="content_header">
    <!--div que fica o logo da padaria-->
    <a href="index.php">
        <div id="logo"></div>
    </a>
    <div class="menu_mobile">
            <!--serve para posicionar os itens do menu-->
            <div id="content_menu">
                <div class="itens">
                    <b>
                        <a href="index.php" class="links">
                            Home
                        </a>
                    </b>
                </div>
                <div class="itens_duas_linhas" id="produtos_servicos">
                    <b> Produtos e Serviços </b>
                    <!--essas divs são para o submenu dos ambientes da padaria-->
                    <div id="submenu">
                        <div class="itens_submenu">
                            <a href="leitura.php?pagina=7&idConteudoAmbiente=4" class="links"> Ambiente para Leitura </a>
                        </div>
                        <div class="itens_submenu">
                            <a href="leitura.php?pagina=8&idConteudoAmbiente=5" class="links"> Ambiente da Tecnologia </a>
                        </div>
                        <div class="itens_submenu">
                            <a href="leitura.php?pagina=9&idConteudoAmbiente=6" class="links"> Ambiente Retrô </a>
                        </div>
                    </div>
                </div>
                <div class="itens">
                    <b>
                        <a href="sobre.php" class="links">
                            Sobre
                        </a>
                    </b>
                </div>
                <div class="itens">
                    <b>
                        <a href="promocoes.php" class="links">
                            Promoções
                        </a>
                    </b>
                </div>
                <div class="itens">
                    <b>
                        <a href="lojas.php" class="links">
                            Lojas
                        </a>
                    </b>
                </div>
                <div class="itens">
                    <b>
                        <a href="produto_do_mes.php" class="links">
                            Produto do Mês
                        </a>
                    </b>
                </div>
                <div class="itens">
                    <b>
                        <a href="fale_conosco.php" class="links">
                            Fale Conosco
                        </a>
                    </b>
                </div>
            </div>
        <!--essa é a área do login-->
        <div id="content_login">
            <form name="frmLogin" method="post" action="cms/login.php">
                <div class="campos">
                    <b>Usuário</b>
                    <br>
                    <input type="text" name="txtUsuario">
                </div>
                <div class="campos">
                    <b>Senha</b>
                    <br>
                    <input type="password" name="txtSenha">
                </div>
                <div id="botao_login">
                    <input type="submit" name="btn_entrar" value="Entrar" class="botao_style_menu">
                </div>
            </form>
        </div>
    </div>
</section>
