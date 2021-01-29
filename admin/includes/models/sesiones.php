<?php
    // Esta funcion verifica que tengamos el usuario autentificado
    function usuario_autentificado(){
        // Si no esta autentificado
        if (!revisar_usuario()) {
            // lo redirigimos al login
            header('Location: index.php');
            exit();
        }
    }
    // Creamos una funcion que nos verifique si tenemos un usuario con una sesión iniciada
    function revisar_usuario(){
        return isset($_SESSION['usuario']);
    }

    // iniciamos la sesión y comprobamos el usuario
    session_start();
    usuario_autentificado();
    
?>