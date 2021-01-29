<?php
    include_once '../conexion.php';  
    #Acceso al sistema - Administrador
    if (isset($_POST['login-admin'])) {
        // recibimos mediante POST el usuario y la contraseña
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        try {
            // Preparamos una consulta para verificar que el usuario ingresado exista en el sistema
            $stmt = $conexion->prepare("SELECT idUsuario, Usuario, NombreUs, Contrasena FROM usuarios WHERE Usuario = ?;");
            $stmt->bind_param('s',$usuario);
            // ejecutamos la sentencia
            $stmt->execute();
            // del Statement almacenos en variables del ID del usuario, el nombre del usuario, el usuario y la contraseña
            $stmt->bind_result($id_usuario,$n_usuario,$nombre_usuario,$password);
            // si se encontro el usuario
            if ($stmt->affected_rows) {
                // verificamos si existen registros en la consulta
                $existe = $stmt->fetch();
                // si existe un usuario
                if ($existe) {
                    //el password ingresamos PHP se encarga de encriptarlo y verificarlo con la encriptación que le dimos y si coinciden
                    if (password_verify($contrasena,$password)) {
                        // iniciamos una sesión
                        session_start();
                        // almacenamos en la sesión el nombre del usuario
                        $_SESSION['usuario'] = $n_usuario;
                        // y creamos una respuesta de petición exitosa
                        $respuesta = array(
                            'respuesta' => 'correcto',
                            'usuario' => $nombre_usuario
                        );
                        // en caso de contraseña incorrecta, mandamos un error
                    } else {
                        $respuesta = array(
                            'respuesta' => 'error'
                        );
                    }
                    // en caso de no encontrar un registro mandamos error
                } else {
                    $respuesta = array(
                        'respuesta' => 'error'
                    );
                }
            }
        } catch (Exception $e) {
            echo "Error " . $e->getMessage();
        }// transformamos la respuesta a JSON
        die(json_encode($respuesta));
    }

?>