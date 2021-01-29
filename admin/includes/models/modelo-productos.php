<?php
    include_once '../conexion.php';    
    //El modelo es similar al del modelo usuario, solo cambia la tabla y  los atributos de la misma, por eso no se documento
    #Insercion de registro
    if ($_POST['registro']=='nuevo') {

        $producto =    $_POST['nombre'];
        $categoria =   $_POST['categoria'];
        $precio =      $_POST['precio'];
        $cantidad =    $_POST['existencias'];
        $descripcion = $_POST['descripcion'];

        $directorio = "../../img/productos/";

        if (!is_dir($directorio)) {
            mkdir($directorio, 0755,true);
        }

        if (move_uploaded_file($_FILES['foto']['tmp_name'],$directorio . $_FILES['foto']['name'])) {
            $imagen_url = $_FILES['foto']['name'];
            $imagen_resultado = "Se subio correctamente";
        } else {
            $respuesta = array(
                'respuesta' => error_get_last()
            );
        }


        try {
            $stmt = $conexion->prepare("INSERT INTO productos (NombreProducto,Categoria,Precio,Cantidad,Descrip,fotoProducto) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssss", $producto, $categoria,$precio,$cantidad,$descripcion,$imagen_url);
            $stmt->execute();
            $id_insertado = $stmt->insert_id;
            if($stmt->affected_rows){
                
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'idInsertado' => $id_insertado,
                    'resultadoSubida' => $imagen_resultado
                );
    
            } else {
    
                $respuesta = array(
                    'respuesta' => 'Ocurrió un error'
                );
            }
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        die(json_encode($respuesta));
    }

if($_POST['registro'] == "actualizar"){
    $producto =    $_POST['nombre'];
    $categoria =   $_POST['categoria'];
    $precio =      $_POST['precio'];
    $cantidad =    $_POST['existencias'];
    $descripcion = $_POST['descripcion'];

    $id = $_POST['id_registro'];

    $directorio = "../../img/productos/"; 


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

    try {

        if($_FILES['foto']['size'] > 0){

            //Con imagen
            $stmt = $conexion->prepare("UPDATE productos SET  NombreProducto = ?, Categoria = ?, Precio = ?, Cantidad = ?, Descrip = ?, fotoProducto = ? WHERE idProducto = ?");
            $stmt->bind_param("ssssssi",$producto, $categoria, $precio, $cantidad, $descripcion, $urlImagen, $id);

        } else {
            //Sin imagen
            $stmt = $conexion->prepare("UPDATE productos SET NombreProducto = ?, Categoria = ?, Precio = ?, Cantidad = ?, Descrip = ? WHERE idProducto = ?");
            $stmt->bind_param("sssssi", $producto, $categoria, $precio, $cantidad, $descripcion, $id);
        }

        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows){
            
                
                $respuesta = array(
                    'respuesta' => 'correcto',
                    'idInsertado' => $id_insertado
                );
    
            } else {
    
                $respuesta = array(
                    'respuesta' => 'Ocurrió un error'
                );
            }
        } catch (Exception $e) {
            $respuesta = array(
                'respuesta' => $e->getMessage()
            );
        }
        die(json_encode($respuesta));
    }

        #Borrar registro
        if ($_POST['registro']=='eliminar') {
            $id_borrar = $_POST['id'];
    
            try {
                $stmt = $conexion->prepare('DELETE FROM productos WHERE idProducto = ?');
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