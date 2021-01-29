<?php include_once 'includes/sesion.php' ?>

<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Ray Garcia Gonzalez">
    <meta name="description" content="Simulacion de Pagina de Ventas en Linea">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon y estilos -->
    <link rel="shortcut icon" href="img/logo_es.png">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" href="admin/assets/libs/sweetAlert2/css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/materialdesignicons.min.css">

</head>

<body>

<style>
    .bg-marca-primario {
        background-color: #003366 ;
    }


    .bg-header {
        background-color: rgb(64, 64, 128);
    }


    .btn-primario {
        background-color: purple;
    }


    /* Sobreescribiendo las clases de Bootstrap  */
    
    .navbar-toggler {
        border: none;
        outline: none;
    }

    .dropdown-menu {
        border: none;
        outline: none;
    }

    .dropdown-item {
        color: white;
    }

    .dropdown-item:hover {
        background-color: rgb(64, 64, 128);
        color: lightgray;
    }
/*
    .btn-up{
    position: fixed;
    bottom: 2%;
    right: 2%;
    z-index: 9999;
    background: #FFFFFF;
    width: 29px;
    height: auto;
    color: #3882C9;
    line-height: 25px;
    font-size: 30px;
    text-align: center;
    border-radius: 50px;
    cursor: pointer;
    text-shadow: 0 0 1px #333;
    display: none;
}
*/
</style>
<!-- 
<script>
    $('.btn-up').click(function(){
    $('body,html').animate({scrollTop:'0px'}, 300);
  });
  /*****Mostrar y ocultar boton ir arriba *****/
  $(window).scroll(function(){
    if($(this).scrollTop() >= 500){
      $('.btn-up').fadeIn();
    }else{
      $('.btn-up').fadeOut();
    }
  });
</script>

 -->
    <!-- Barra de navegación -->
    <header>

        <!-- <button class="btn-up fa fa-arrow-circle-o-up"></button> -->

        <nav class="navbar navbar-expand-lg navbar-dark bg-header">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo_es.png" width="30" height="30" class="d-inline-block align-top" alt=""
                    loading="lazy">
                EASYSHOP
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link text-light" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="nosotros.php">Nosotros</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Productos
                        </a>
                        <div class="dropdown-menu bg-header" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="canasta-basica.php">Canasta Basica</a>
                            <a class="dropdown-item" href="aseo-hogar.php">Aseo del Hogar</a>
                            <a class="dropdown-item" href="ropa.php">Ropa</a>
                            <a class="dropdown-item" href="tecnologia.php">Tecnologia</a>
                            <a class="dropdown-item" href="electrodomesticos.php">Electrodomesticos</a>
                        </div>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="contactanos.php">Contactanos</a>
                    </li>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <!-- Validación Inicio de Sesión -->
                    <?php 
                     if (isset($_SESSION['sesionIniciada'])) {
                        if ($_SESSION['sesionIniciada']=="si") {
                            echo '        
                            <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <b>'; 
                            echo $_SESSION['cliente'];
                            echo '</b>
                            </a>
                            <div class="dropdown-menu bg-header" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="mi-perfil.php?id='.$_SESSION['id'].'"><i class="mdi mdi-account"></i> Mi Perfil</a>
                                <a class="dropdown-item" href="carrito-compras.php"><i class="mdi mdi-cart"></i> Mi Carrito</a>
                                <a class="dropdown-item" href="lista-deseos.php"><i class="mdi mdi-heart"></i> Lista de Deseos</a>   
                                <a class="dropdown-item" href="cerrar-sesion.php"><i class="mdi mdi-logout"></i> Cerrar Sesión</a>
                            </div>
                        </li>';
                            if ($_SESSION['foto'] != "") {
                            echo '<img src="admin/img/clientes/'.$_SESSION['foto'].'" alt="logo" class="rounded-circle mr-5" width="40" height="40">';
                            } else {
                            echo '<img src="admin/img/usuarios/ArK.png" alt="logo" class="rounded-circle mr-5" width="40" height="40">';
                            }
                        }
                        } else {
                        echo 
                        '
                        <a href="inicio-sesion.php"><button class="btn btn-link text-white m-1 p-0">Iniciar Sesion</button></a> 
                        ';
                        }
                    ?>
                </ul>
            </div>
        </nav>
    </header>