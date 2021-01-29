<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EASYSHOP | Inicio de Sesión</title>
    <link rel="shortcut icon" href="img/logo_es.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="admin/assets/libs/sweetAlert2/css/sweetalert2.min.css">
</head>

<body>


    <body class="text-center bg-marca-primario p-2">
        <form class="form-signin card text-center pt-5" id="login-admin" name="login-admin-form" method="POST"
                        action="includes/models/modelo-cliente.php">
            <h1 class="h3 mb-3 font-weight-normal">Inicia Sesión</h1>
            <center class="mb-2">
                <img src="img/logotipo.JPG" class="img-fluid" width="100px" alt="logo">
            </center>
            <label for="correo" class="sr-only">Correo Electronico</label>
            <input type="email" id="correo" name="correo" class="form-control mb-1" placeholder="Ingresa tu correo" required>
            <label for="contrasena" class="sr-only">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Contraseña" required>
                <input type="hidden" name="registro" value="login">
                <button class="btn btn-block btn-lg btn-info" type="submit">Acceder</button>
            <label class="mt-2">o</label>
            <a href="registrate.php">
                <p class="text-info"> Registrate</p>
            </a>
        </form>


    </body>

    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/cliente-ajax.js"></script>
    <script src="admin/assets/libs/sweetAlert2/js/sweetalert2.all.min.js"></script>
</body>

</html>