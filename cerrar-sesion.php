<?php 
    #Script PHP para destruir una sesión y redirigir al index
    session_start();
    session_destroy();

    echo '<script>';
        echo 'window.location="index.php";';
    echo '</script>';

?>