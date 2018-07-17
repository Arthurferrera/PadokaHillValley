<?php
    // verificando se foi possivel a conexao com o banco
    // caso não acontecer será exibido uma mensagem para o usuario
    if($conexao = mysql_connect('localhost', 'root', 'bcd127')){
        mysql_select_db('db_padoka');
    } else {
        echo ("<script> alert('Erro: Não foi possivel estabelecer conexão com o Banco de Dados, contate o Administrador do sisteme.');</script>");
    }

//   if($conexao = mysql_connect('192.168.0.2', 'pc1120181', 'senai127')){
//        mysql_select_db('dbpc1120181');
//    } else {
//        echo ("<script> alert('Erro: Não foi possivel estabelecer conexão com o Banco de Dados, contate o Administrador do sisteme.');</script>");
//    }
 ?>
