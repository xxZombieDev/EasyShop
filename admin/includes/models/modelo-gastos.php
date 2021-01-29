<?php
    //Llamamos a nuestra conexion
    include_once '../conexion.php';    

    #Verificamos si tenemos un elemento llamado registro con un value "nuevo"
    if ($_POST['registro']=='nuevo') {
        // Creamos variables para recibir los datos del formulario por POST
        $motivo =   $_POST['motivo'];
        $monto =    $_POST['monto'];
        $fecha =    $_POST['fecha'];

        // Preparamos un try catch en caso de que ocurra una excepción
        try {
            // Preparamos la sentencia que queremos que suceda
            // En este caso se trata de una inserción
            $stmt = $conexion -> prepare("INSERT INTO gastos 
                                        (MotivoGasto, MontoGasto, FechaGasto) 
                                        VALUES (?,?,?)");
            // Llamamos los parametros que queremos insertar, serian las variables declaradas al inicio
            $stmt -> bind_param("sss",$motivo,$monto,$fecha);
            // Ejecutamos la sentencia
            $stmt -> execute();
            // Almacenamos en una variable el ID del registro a insertar
            $id_registrado = $stmt->insert_id;
            // Si hubo un ID afectado
            if($id_registrado > 0) {
                // Significa que hubo inserción
                // Este arreglo lo creamos para llamarlo con AJAX
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'id_comentario' => $id_registrado
                );
            } else {
                // en caso contrario no hubo inserción o hubo un error
                $respuesta = array(
                    'respuesta' => 'error'
                );            
            }
            // Cerreamos la conexión para mejorar el rendimiento
            $stmt -> close();
            $conexion -> close();
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        // codificamos la respuesta en formato JSON para atender con petición AJAX
        die(json_encode($respuesta));
    }

    #Borrar registro
    if ($_POST['registro']=='eliminar') {
        $id_borrar = $_POST['id'];

        try {
            $stmt = $conexion->prepare('DELETE FROM gastos WHERE idGasto = ?');
            $stmt->bind_param('i', $id_borrar);
            $stmt->execute();
            if ($stmt->affected_rows) {
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'id_eliminado' => $id_borrar
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