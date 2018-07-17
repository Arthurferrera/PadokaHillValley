<?php
    function autenticar($permissao) {
        if (in_array($_SESSION['nivel'], $permissao)) {
            return;
        } else {
            header("location:home.php");
        }
    }
 ?>
