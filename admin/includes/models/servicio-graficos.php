<?php 
    //Importamos la conexion a la base de datos
    include_once ('../conexion.php');
    // Creamos la consulta que nos traera los datos y la ejecutamos
    $sql = "SELECT FechaVenta, SUM(totalVenta) AS totalVenta FROM ventas GROUP BY DATE(FechaVenta)";
    $resultado = $conexion->query($sql);

    // Creamos un arreglo global vacio donde luego almacenaremos los datos
    $arreglo_registros =  array();

    // Recorremos los datos obtenidos por la consulta
    while($registro_dia = $resultado->fetch_assoc())
    {   //Almacenamos el valor del campo de la fecha
        $registro['fecha'] = $registro_dia['FechaVenta']; 
        //Tambien almacenamos el total de las ventas
        $registro['total'] = $registro_dia['totalVenta']; 
        // Almacenamos todo en el arreglo
        $arreglo_registros[] = $registro;
    }
    // Transformamos el arreglo a tipo JSON ya que en este formato
    // se grafican los datos en morris
    echo json_encode($arreglo_registros);
?>