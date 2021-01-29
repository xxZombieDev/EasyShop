<?php
    //Llamamos a nuestra conexion
    include_once '../conexion.php';    

    #Verificamos si tenemos un elemento llamado registro con un value "nuevo"
    if ($_POST['registro']=='nuevo') {
        // Creamos variables para recibir los datos del formulario por POST
        $cliente =     $_POST['cliente'];
        $producto =    $_POST['producto'];
        $comentario =  $_POST['comentario'];

        // Preparamos un try catch en caso de que ocurra una excepción
        try {
            // Preparamos la sentencia que queremos que suceda
            // En este caso se trata de una inserción
            $stmt = $conexion -> prepare("INSERT INTO opinionproducto 
                                        (idCliente, idProducto, Opinion, Fecha) 
                                        VALUES (?,?,?,NOW())");
            // Llamamos los parametros que queremos insertar, serian las variables declaradas al inicio
            $stmt -> bind_param("iis",$cliente,$producto,$comentario);
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