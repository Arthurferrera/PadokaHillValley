<?php
    // iniciando a sessão
    session_start();
    // verificando se as variaveis de sessão estão criadas
    // se não estiver destroi a sessão e redireciona para a home do site
    if((isset ($_SESSION['login']) == false) or (isset ($_SESSION['senha']) == false)){
        session_destroy();
        header('location:../index.php');
    }
?>
