<?php
    include_once '../conexion.php';    
    #Insercion de registro
    if ($_POST['registro']=='nuevo') {
        // Datos enviados por POST del formulario
        $nombre =     $_POST['nombre'];
        $apellidop =  $_POST['apellidop'];
        $apellidom =  $_POST['apellidom'];
        $usuario =    $_POST['usuario'];
        $tipo =       $_POST['tipo'];
        $contrasena = $_POST['contrasena'];
        // Directorio donde se almacenan las imagenes
        $directorio = "../../img/usuarios/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0755,true);
        }
        // Moviendo imagen cargada al directorio
        if (move_uploaded_file($_FILES['foto']['tmp_name'],$directorio . $_FILES['foto']['name'])) {
            $imagen_url = $_FILES['foto']['name'];
            $imagen_resultado = "Se subio correctamente";
        } else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        }
        $opciones = array(
            'cost' => 12
        );
        // Encriptación de la contraseña con Password_HASH
        $contra_encriptada = password_hash($contrasena,PASSWORD_BCRYPT, $opciones);
        // Preparación de Sentencia de SQL para inserción mediante Prepare Statement para inserción segura de datos
        try {
            $stmt = $conexion -> prepare("INSERT INTO usuarios 
                                        (NombreUs, ApellidoP_Us, ApellidoM_Us,fotoUsuario,Usuario,TipoUsuario,Contrasena) 
                                        VALUES (?,?,?,?,?,?,?)");
                                        // llamado a datos a insertar
            $stmt -> bind_param("sssssss",$nombre,$apellidop,$apellidom,$imagen_url,$usuario,$tipo,$contra_encriptada);
            $stmt -> execute();
            // verificamos si hubo un registro afectado para dar una respuesta
            $id_registrado = $stmt->insert_id;
            if($id_registrado > 0) {
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'id_usuario' => $id_registrado
                );
                // en caso contrario significa que no se pudo insertar
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );            
            }
            // cerramos las conexiones por seguridad
            $stmt -> close();
            $conexion -> close();
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        // finalizamos las sentencias y la respuesta lo tranformamos a JSON para peticiones AJAX
        die(json_encode($respuesta));
    }

    #Acceso al sistema - Administrador
    if (isset($_POST['login-admin'])) {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];
        //Preparamos la consulta para verificar si el usuario ingresado en el login existe
        try {
            $stmt = $conexion->prepare("SELECT idUsuario, Usuario, NombreUs, Contrasena FROM usuarios WHERE Usuario = ?;");
            $stmt->bind_param('s',$usuario);
            // La ejecutamos
            $stmt->execute();
            // Tomamos el id del usuario, el nombre, usuario y contreseña de la consulta
            $stmt->bind_result($id_usuario,$n_usuario,$nombre_usuario,$password);
            // Verificamos si la consulta nos arrojo algo
            if ($stmt->affected_rows) {
                // Si nos arrojo algo
                $existe = $stmt->fetch();
                // evaluamos si existe un registro con el usuario capturado 
                if ($existe) {
                    // condicionamos para que PHP internamente haga un hash con la contraseña ingresa y verifica si coincida con la de la BD
                    if (password_verify($contrasena,$password)) {
                        // Si es valido
                        // abrimos una sesion
                        session_start();
                        // jalamos el nombre del usuario y el usuario
                        $_SESSION['Usuario'] = $n_usuario;
                        $_SESSION['Nombre_Us'] = $nombre_usuario;
                        // construimos una respuesta
                        $respuesta = array(
                            'respuesta' => 'exitoso',
                            'usuario' => $nombre_usuario
                        );
                        // en caso de no coincidir las contraseñas
                    } else {
                        // mostramos error
                        $respuesta = array(
                            'respuesta' => 'error'
                        );
                    }
                    // en caso de no existir un usuario
                } else {
                    // mostramos error
                    $respuesta = array(
                        'respuesta' => 'error'
                    );
                }
            }
        } catch (Exception $e) {
            echo "Error " . $e->getMessage();
        }
        die(json_encode($respuesta));
    }

    # Edicion de registro - La petición es muy similar a la inserción, solo se comentan las diferencias
    if ($_POST['registro']=='actualizar') {
        $nombre =     $_POST['nombre'];
        $apellidop =  $_POST['apellidop'];
        $apellidom =  $_POST['apellidom'];
        $usuario =   $_POST['usuario'];
        $tipo =       $_POST['tipo'];
        $contrasena = $_POST['contrasena'];
        $id_registro = $_POST['id_registro'];
        $directorio = "../../img/usuarios/"; 
        if(!is_dir($directorio)){
            mkdir($directorio, 0755, true);
        }
        if( move_uploaded_file($_FILES['foto']['tmp_name'] , $directorio . $_FILES['foto']['name'] ) ) {   
            $urlImagen = $_FILES['foto']['name'];
        } else {
            $respuesta = array(
                'respuesta' => error_get_last() //Función para imprimir el último error registrado por PHP
            );
        }
        $opciones = array(
            'cost' => 12
        );
        $hash_password = password_hash($contrasena,PASSWORD_BCRYPT,$opciones);
        try {
            // Si detectamos que no hay ningun cambio en la imagen de usuario
            if (($_FILES['foto']['size'] > 0)) {
                // y ademas detectamos que el campo de la contraseña queda vacio
                if (empty( $_POST['contrasena'])) {
                    // actualizamos todos los datos a excepción de la foto y la contraseña
                    $stmt = $conexion->prepare('UPDATE usuarios SET NombreUs = ?, ApellidoP_Us = ?, ApellidoM_Us = ?,fotoUsuario = ?, Usuario = ?,
                    TipoUsuario = ? WHERE idUsuario = ?');
                    $stmt->bind_param("ssssssi",$nombre,$apellidop,$apellidom,$urlImagen,$usuario,$tipo,$id_registro);
                    // en caso de si existir un cambio en la contraseña
                } else {
                    // se actualiza todo a excepción de la foto
                    $stmt = $conexion->prepare('UPDATE usuarios SET NombreUs = ?, ApellidoP_Us = ?, ApellidoM_Us = ?,fotoUsuario = ?, Usuario = ?,
                    TipoUsuario = ?, Contrasena = ? WHERE idUsuario = ?');
                    $stmt->bind_param("sssssssi",$nombre,$apellidop,$apellidom,$urlImagen,$usuario,$tipo,$hash_password,$id_registro);
                }
                // en caso de si haber subido una nueva foto
            } else {
                // pero si el campo de la contraseña esta vacio
                if (empty( $_POST['contrasena'])) {
                    // actualizamos todo a excepcion de la contraseña
                    $stmt = $conexion->prepare('UPDATE usuarios SET NombreUs = ?, ApellidoP_Us = ?, ApellidoM_Us = ?, Usuario = ?,
                    TipoUsuario = ? WHERE idUsuario = ?');
                    $stmt->bind_param("sssssi",$nombre,$apellidop,$apellidom,$usuario,$tipo,$id_registro); 
                    // en caso de todos los cambios tengan información
                } else {
                    // se actualizan todos los campos
                    $stmt = $conexion->prepare('UPDATE usuarios SET NombreUs = ?, ApellidoP_Us = ?, ApellidoM_Us = ?, Usuario = ?,
                    TipoUsuario = ?, Contrasena = ? WHERE idUsuario = ?');
                    $stmt->bind_param("ssssssi",$nombre,$apellidop,$apellidom,$usuario,$tipo,$hash_password,$id_registro);
                }
            }
            // ejecutamos la sentencia del if 
            $stmt->execute();
            if ($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'id_actualizado' => $stmt->insert_id
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }
            $stmt->close();
            $conexion->close();
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        die(json_encode($respuesta));
    }

    #Borrar registro
    if ($_POST['registro']=='eliminar') {
        // Tomamos el id del registro a eliminar
        $id_borrar = $_POST['id'];
        // Preparamos la conexion mediante un Statement
        try {
            $stmt = $conexion->prepare('DELETE FROM usuarios WHERE idUsuario = ?');
            $stmt->bind_param('i', $id_borrar); // tomamos el ID
            $stmt->execute();
            // Si la eliminación fue correcta
            if ($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'id_eliminado' => $id_borrar
                );
                // si la eliminacion no fue correcta
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );
            }            
            $stmt->close();
            $conexion->close();
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        // terminamos y la respuesta la transformamos a JSON para AJAX
        die(json_encode($respuesta));
    }

?>