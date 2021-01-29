<?php 
    session_start();
    if (!isset($_GET['logout'])) {
        session_destroy();
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Login">
    <meta name="author" content="Ray Garcia Gonzalez">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>MiTiendita | Login</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link type="text/css" href="assets/libs/sweetAlert2/css/sweetalert2.min.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader antes de cargar la pagina -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Codigo para login -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
            <div class="auth-box bg-dark">
                <div id="loginform">
                    <div class="text-center p-t-20 pb-3">
                        <span class="db"><img src="assets/images/text-logo.png" alt="logo" /></span>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" id="login-admin" name="login-admin-form" method="POST"
                        action="includes/models/login-admin.php">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white" id="basic-addon1"><i
                                                class="mdi mdi-account"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg"
                                        placeholder="Nombre del Usuario" name="usuario" aria-label="Username"
                                        aria-describedby="basic-addon1" required >
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-primary text-white" id="basic-addon2"><i
                                                class="mdi mdi-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" placeholder="Contraseña"
                                        aria-label="Password" name="contrasena" aria-describedby="basic-addon1" required>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <input type="hidden" name="login-admin" value="1">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Acceder</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- Scrips de JS -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/login-admin.js"></script>
    <script src="assets/libs/sweetAlert2/js/sweetalert2.all.min.js"></script>
    <!-- ============================================================== -->
    <!-- Javascript propio -->
    <!-- ============================================================== -->
    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    </script>

</body>

</html>