<?php
// Llamamos a la conexion BD
include('../includes/conexion.php');
    // Establecemos las directivas para dar salida como CSV, recomendado en Excel 
    // para generacion de reportes y respaldos
	header('Content-Type:text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename="Reporte_Usuarios.csv"');
	//Establecemos la salida del archivo
	$salida=fopen('php://output', 'w');
	// Establecemos los encabezados del Excel
	fputcsv($salida, array('Reporte de Usuarios'));
	fputcsv($salida, array('ID','Nombre','A.Paterno', 'A.Materno','Usuario','Tipo'));
	// Creamos la consulta para crear el query
	$reporteCsv=$conexion->query("SELECT * FROM usuarios");
    //Recorremos la salida para agregar en cada celda un atributo
    while($filaR= $reporteCsv->fetch_assoc())
		fputcsv($salida, array($filaR['idUsuario'], 
								$filaR['NombreUs'],
								$filaR['ApellidoP_Us'],
								$filaR['ApellidoM_Us'],
								$filaR['Usuario'],
								$filaR['TipoUsuario']));

?>