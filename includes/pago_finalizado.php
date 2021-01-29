<?php include_once 'sesion.php' ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>EASYSHOP | Pago Exitoso</title>

        <!-- Favicon y estilos -->
        <link rel="shortcut icon" href="../img/logo_es.png">
        <link rel="stylesheet" href="../css/normalize.css">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">

</head>

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

<body>

    <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-header">
            <a class="navbar-brand" href="index.php">
                <img src="../img/logo_es.png" width="30" height="30" class="d-inline-block align-top" alt=""
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
                        <a class="nav-link text-light" href="../index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../nosotros.php">Nosotros</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Productos
                        </a>
                        <div class="dropdown-menu bg-header" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../canasta-basica.php">Canasta Basica</a>
                            <a class="dropdown-item" href="../aseo-hogar.php">Aseo del Hogar</a>
                            <a class="dropdown-item" href="../ropa.php">Ropa</a>
                            <a class="dropdown-item" href="../tecnologia.php">Tecnologia</a>
                            <a class="dropdown-item" href="../electrodomesticos.php">Electrodomesticos</a>
                        </div>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="../contactanos.php">Contactanos</a>
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
                            echo '<img src="../admin/img/clientes/'.$_SESSION['foto'].'" alt="logo" class="rounded-circle mr-5" width="40" height="40">';
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

    <div class="formulario mt-4">
        <div class="container">
        <?php
               include_once '../includes/conexion.php';    
              
              // recibimos mediante GET el ID de pago de Paypal
              // y la variable que confirma se aceptamos o cancelamos
              // la compra
                $resultado = (bool) $_GET['exito'];
                $paymentId = $_GET['paymentId'];
                $cliente = $_SESSION['id'];
              // Si aceptamos la compra
              // Se desplegara que el pago fue exitoso y el ID de Paypal
              // por compra
                if($resultado == true) {
                      
                        try {
                
                            $sql = "SELECT SUM(dv.Precio * dv.Cantidad) AS total 
                                    FROM detalleventas as dv INNER JOIN productos AS p ON p.idProducto = dv.idProducto  
                                    WHERE ClienteTemp = $cliente
                                    GROUP BY ClienteTemp";
                           
                            $resultado = $conexion->query($sql);
                            $venta = $resultado -> fetch_assoc();
                          
                            $total = $venta['total'];

                            // Preparamos la sentencia que queremos que suceda
                            // En este caso se trata de una inserción
                            $stmt = $conexion -> prepare("INSERT INTO ventas 
                                                        (idCliente,FechaVenta,totalVenta) 
                                                        VALUES (?,NOW(),?)");
                            // Llamamos los parametros que queremos insertar, serian las variables declaradas al inicio
                            $stmt -> bind_param("is",$cliente,$total);
                            // Ejecutamos la sentencia
                            $stmt -> execute();
                            // Almacenamos en una variable el ID del registro a insertar
                            $id_registrado = $stmt->insert_id;

                            $stmt2 = $conexion -> prepare("UPDATE detalleventas
                                                        SET idVenta = ?, ClienteTemp = 9999
                                                        WHERE ClienteTemp = ?");
                            
                            $stmt2 -> bind_param("ii",$id_registrado,$cliente);
                          
                            $stmt2 -> execute();

                            // Si hubo un ID afectado
                            if($id_registrado > 0) {  ?>

                            <div class="card">
                                <div class="card-header bg-header text-white text-center">
                                    <b>Pago Exitoso</b>
                                </div>
                                <div class="card-body">
                                            <p>
                                              <?php
                                                  echo "El pago se realizo correctamente! ";
                                                  echo "El id es {$paymentId} ";  
                                              ?>
                                            </p>
                                </div>
                            </div>
                            <?php } else { ?>

                                <div class="card">
                                <div class="card-header bg-header text-white text-center">
                                    <b>Error al ejecutar el pago</b>
                                </div>
                                <div class="card-body">
                                            <p>
                                              <?php
                                                  echo "Ocurrio un error durante el procesamiento del pago "; 
                                              ?>
                                            </p>
                                </div>
                            </div>
                            <?php }
                            // Cerreamos la conexión para mejorar el rendimiento
                            $stmt -> close();
                            $conexion -> close();
                        } catch (Exception $e) {
                            $respuesta = array(
                                'respuesta' => $e->getMessage()
                            );
                        }
                      
                      
                }
            
             ?>
             <div class="text-center mt-3">
                <a href="../index.php"><button class="btn btn-primary"> Regresar al Inicio </button></a>
             </div>
          </div>
    </div>
</body>


</html>