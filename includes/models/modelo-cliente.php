<?php
    include_once '../conexion.php';    

    #Insercion de registro
    if ($_POST['registro']=='registro') {
        $nombre =     $_POST['nombre'];
        $apellidop =  $_POST['apellidop'];
        $apellidom =  $_POST['apellidom'];
        $usuario =   $_POST['correo'];
        $contrasena = $_POST['contrasena'];

        $opciones = array(
            'cost' => 12
        );

        $contra_encriptada = password_hash($contrasena,PASSWORD_BCRYPT, $opciones);

        try {
            $stmt = $conexion -> prepare("INSERT INTO clientes 
                                        (NombreCli, ApellidoP_Cli, ApellidoM_Cli,CorreoUsuario,Contrasena) 
                                        VALUES (?,?,?,?,?)");
            $stmt -> bind_param("sssss",$nombre,$apellidop,$apellidom,$usuario,$contra_encriptada);
            $stmt -> execute();

            $id_registrado = $stmt->insert_id;
            if($id_registrado > 0) {
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'id_usuario' => $id_registrado
                );
            } else {
                $respuesta = array(
                    'respuesta' => 'error'
                );            
            }
            $stmt -> close();
            $conexion -> close();
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        die(json_encode($respuesta));
    }


    # Edicion de registro
    if ($_POST['registro']=='editar') {
        $nombre =      $_POST['nombre'];
        $apellidop =   $_POST['apellidop'];
        $apellidom =   $_POST['apellidom'];
        $correo =      $_POST['correo'];
        $contrasena =  $_POST['contrasena'];
        $id_registro = $_POST['id_registro'];

        $directorio = "../../admin/img/clientes/"; 

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

            if (($_FILES['foto']['size'] > 0)) {

                if (empty( $_POST['contrasena'])) {
                    $stmt = $conexion->prepare('UPDATE clientes SET NombreCli = ?, ApellidoP_Cli = ?, ApellidoM_Cli = ?,fotoCliente = ?, CorreoUsuario = ?,
                    WHERE idCliente = ?');
                   $stmt->bind_param("sssssi",$nombre,$apellidop,$apellidom,$urlImagen,$correo,$id_registro);
                } else {
                    $stmt = $conexion->prepare('UPDATE clientes SET NombreCli = ?, ApellidoP_Cli = ?, ApellidoM_Cli = ?,fotoCliente = ?, CorreoUsuario = ?,
                    Contrasena = ? WHERE idCliente = ?');
                   $stmt->bind_param("ssssssi",$nombre,$apellidop,$apellidom,$urlImagen,$correo,$hash_password,$id_registro);
                }

            } else {
                if (empty( $_POST['contrasena'])) {
                    $stmt = $conexion->prepare('UPDATE clientes SET NombreCli = ?, ApellidoP_Cli = ?, ApellidoM_Cli = ?, CorreoUsuario = ? 
                    WHERE idCliente = ?');
                    $stmt->bind_param("ssssi",$nombre,$apellidop,$apellidom,$correo,$id_registro);
                } else {
                    $stmt = $conexion->prepare('UPDATE clientes SET NombreCli = ?, ApellidoP_Cli = ?, ApellidoM_Cli = ?, CorreoUsuario = ?, Contrasena = ? 
                    WHERE idCliente = ?');
                    $stmt->bind_param("sssssi",$nombre,$apellidop,$apellidom,$correo,$hash_password,$id_registro);
                }
            }

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



    #Inicio de Sesion - Cliente
    if ($_POST['registro']=='login') {
        $usuario = $_POST['correo'];
        $contrasena = $_POST['contrasena'];

        try {
            $stmt = $conexion->prepare("SELECT idCliente, CorreoUsuario, NombreCli, Contrasena, fotoCliente FROM clientes WHERE CorreoUsuario = ?");
            $stmt->bind_param('s',$usuario);
            $stmt->execute();
            $stmt->bind_result($id_usuario,$correo,$nombre_cliente,$password,$fotoCliente);
            if ($stmt->affected_rows) {
                $existe = $stmt->fetch();
                if ($existe) {
                    if (password_verify($contrasena,$password)) {
                        session_start();
                        $_SESSION['id'] = $id_usuario;
                        $_SESSION['sesionIniciada'] = "si";
                        $_SESSION['cliente'] = $nombre_cliente;
                        $_SESSION['foto'] = $fotoCliente;
                        $respuesta = array(
                            'respuesta' => 'correcto',
                            'usuario' => $nombre_cliente
                        );
                    } else {
                        $respuesta = array(
                            'respuesta' => 'contrasena incorrecta'
                        );
                    }
                } else {
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