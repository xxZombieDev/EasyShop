<?php
    function usuario_autentificado(){
        if (!revisar_usuario()) {
            header('Location: index.php');
            exit();
        }
    }

    function revisar_usuario(){
        return isset($_SESSION['cliente']);
    }

    session_start();
    usuario_autentificado();
    
?>