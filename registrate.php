<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EASYSHOP | Registro</title>
    <link rel="shortcut icon" href="img/logo_es.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="admin/assets/libs/sweetAlert2/css/sweetalert2.min.css">
</head>

<body>


    <body class="text-center bg-marca-primario">
        <!-- Formulario para registrarse a la plataforma de tienda online -->
        <form class="form-signin card text-center pt-5" id="generar-registro"
                name="generar-registro" method="POST" action="includes/models/modelo-cliente.php">
            <h1 class="h3 mb-3 font-weight-normal">Registro</h1>
            <center class="mb-2">
            <img src="img/logotipo.JPG" class="img-fluid" width="100px" alt="logo">
            </center>
            <!-- Datos personales -->
                <label for="nombre" class="sr-only">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control mb-1" placeholder="Ingresa tu nombre"
                    required>
                <label for="apellidop" class="sr-only">Apellido Paterno</label>
                <input type="text" id="apellidop" name="apellidop" class="form-control mb-1" placeholder="Ingresa tu apellido Paterno"
                    required>
                <label for="apellidom" class="sr-only">Apellido Paterno</label>
                <input type="text" id="apellidom" name="apellidom" class="form-control mb-1" placeholder="Ingresa tu apellido Materno"
                    required>

                <hr>

                <!-- Credenciales -->
                <label for="correo" class="sr-only">Correo Electronico</label>
                <input type="email" id="correo" name="correo" class="form-control mb-1" placeholder="Ingresa tu correo"
                    required>
                <label for="contrasena" class="sr-only">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Contraseña"
                    required>


                <input type="hidden" name="registro" value="registro">
                <button type="submit" class="btn btn-primary">Registrar</button>
        </form>


    </body>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <!-- Script para hacer peticiones AJAX -->
    <script src="js/cliente-ajax.js"></script>
    <script src="admin/assets/libs/sweetAlert2/js/sweetalert2.all.min.js"></script>
</body>

</html>