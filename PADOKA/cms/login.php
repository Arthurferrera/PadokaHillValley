<?php
    // iniciando a sessão
    session_start();

    // verificando se existe na url a variavel modo
    if(isset($_GET['modo'])){
        // resgatando a variavel da url
        $modo = $_GET['modo'];
        if($modo == 'sair'){
            // destruindo a sessão
            session_destroy();
            // redirecionando para a home do site
            header('location:../home.html');
        }
    }

    // chamando o arquivo de conexao com o banco
    require_once "../conexao_banco.php";

    // resgatando via POST o usuario e a senha
    $login = $_POST['txtUsuario'];
    $senha = $_POST['txtSenha'];
    // select que consulta se existe esses dados no banco
    $sql = "SELECT * FROM tbl_usuario WHERE usuario='".$login."' AND senha = '".$senha."' AND status = 1 ";
    // executando o comando no banco
     $result = mysql_query($sql);
    // resgatando as informações do usuario no banco
    while($usuario = mysql_fetch_array($result)){
        $nome = $usuario['nome'];
        $nivel = $usuario['idNivelUsuario'];
    }
    // verificando se o select retornou algum resultado
    if(mysql_num_rows ($result) > 0){
        // passando as informações do usuario para as variaveis de sessão
        $_SESSION['login'] = $login;
        $_SESSION['senha'] = $senha;
        $_SESSION['nome'] = $nome;
        $_SESSION['nivel'] = $nivel;
        // redirecionando para o cms
        header('location:home.php');
    } else {
        // redicerionando para o site novamente
        header('location:../index.php');
    }
?>
