<?php
    /**
     * @author Ray Garcia Gonzalez
     */
    // llamado a la plantilla y conexion a base de datos
	include 'plantilla.php';
	include '../includes/conexion.php';

    // Consulta SQL con la que rellenaremos el PDF
	$query = "SELECT * FROM usuarios";
	$resultado = $conexion->query($query);
    
    // Creamos un nuevo objeto PDF y preparamos la pagina
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
    
    // Agregamos un color en formato RGB al encabezado de la tabla
    // a la vez establecemos un tamaño de los headers en Arial negrita 12
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(15,6,'ID',1,0,'C',1);
	$pdf->Cell(35,6,'Nombre',1,0,'C',1);
	$pdf->Cell(35,6,'APaterno',1,0,'C',1);
	$pdf->Cell(35,6,'AMaterno',1,0,'C',1);
    $pdf->Cell(35,6,'Usuario',1,0,'C',1);
    // En esta celda damos salto de linea, en el quinto parametro 1
    $pdf->Cell(35,6,'Tipo Usuario',1,1,'C',1); 
    
    // Al cuerpo de la tabla lo establecemos con Arial 10 texto normal
	$pdf->SetFont('Arial','',10);
    
    // Recorremos el resultado d ela consulta
	while($row = $resultado->fetch_assoc())
	{
        // Seteamos los valores en distintas celdas 
		$pdf->Cell(15,6,utf8_decode($row['idUsuario']),1,0,'C');
		$pdf->Cell(35,6,utf8_decode($row['NombreUs']),1,0,'C');
		$pdf->Cell(35,6,utf8_decode($row['ApellidoP_Us']),1,0,'C');
		$pdf->Cell(35,6,utf8_decode($row['ApellidoM_Us']),1,0,'C');
        $pdf->Cell(35,6,utf8_decode($row['Usuario']),1,0,'C');
        // Salto de linea en el 5to parametro
		$pdf->Cell(35,6,utf8_decode($row['TipoUsuario']),1,1,'C');
    }
    // cerramos el PDF y lo generamos
	$pdf->Output();
?>