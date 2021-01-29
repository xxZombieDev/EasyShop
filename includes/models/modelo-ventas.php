<?php
    //Llamamos a nuestra conexion
    include_once '../conexion.php';    

    // Metodo que permite poner temporalmente en carrito los productos
    if ($_POST['registro']=='carrito') {
        // Creamos variables para recibir los datos del formulario por POST
        $producto =  $_POST['product'];
        $cantidad =  $_POST['cantidad'];
        $precio =    $_POST['precio'];
        $temporal =  $_POST['temporal'];

        // Preparamos un try catch en caso de que ocurra una excepción
        try {
            // Preparamos la sentencia que queremos que suceda
            // En este caso se trata de una inserción
            $stmt = $conexion -> prepare("INSERT INTO DetalleVentas 
                                        (idVenta,idProducto,Precio,Cantidad,ClienteTemp) 
                                        VALUES (9999,?,?,?,?)");
            // Llamamos los parametros que queremos insertar, serian las variables declaradas al inicio
            $stmt -> bind_param("issi",$producto,$precio,$cantidad,$temporal);
            // Ejecutamos la sentencia
            $stmt -> execute();
            // Almacenamos en una variable el ID del registro a insertar
            $id_registrado = $stmt->insert_id;

            //Actualización inventario, restar productos vendidos
            $stmt2 = $conexion -> prepare("UPDATE productos
                                            SET cantidad = cantidad - ?
                                            WHERE idProducto = ?");
            // Llamamos los parametros que queremos insertar, serian las variables declaradas al inicio
            $stmt2 -> bind_param("ii",$cantidad,$producto);
            // Ejecutamos la sentencia
            $stmt2 -> execute();


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
                    'respuesta' => 'Verifique su carrito de compras',
                    'id_comentario' => $stmt
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
/****************************************/
    // Metodo que permite efectuar la venta
    if ($_POST['registro']=='venta') {
        // Creamos variables para recibir los datos del formulario por POST
        $total =  $_POST['total'];
        $cliente =   $_POST['cliente'];

        // Preparamos un try catch en caso de que ocurra una excepción
        try {
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
                    'respuesta' => 'Verifique su carrito de compras',
                    'id_comentario' => $stmt
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


        $sql = "SELECT * FROM detalleventas WHERE idProducto = $id_borrar";
        $resultado = $conexion->query($sql);
        $producto = $resultado -> fetch_assoc();
      
        $cantidad = $producto['Cantidad'];

        try {
            $stmt = $conexion->prepare('DELETE FROM detalleventas WHERE idProducto = ?');
            $stmt->bind_param('i', $id_borrar);
            $stmt->execute();

            //Actualización inventario, regresamos los productos
            $stmt2 = $conexion -> prepare("UPDATE productos
                                            SET cantidad = cantidad + ?
                                            WHERE idProducto = ?");

            $stmt2 -> bind_param("ii",$cantidad,$id_borrar);
            $stmt2 -> execute();
            

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