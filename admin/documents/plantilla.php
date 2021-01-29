<?php
	/**
	 * @author Ray Garcia Gonzalez
	 * @version 1.0
	 */
	//Llamamos al plugin de FPDF para generar el reporte
	require 'fpdf/fpdf.php';
	// Creamos una clase para establecer el encabezado y el pie de pagina
	class PDF extends FPDF
	{
		function Header()
		{
			/**
			 * El sistema de rejillas de FPDF tiene varios parametros,
			 * entre ellos algunos importantes son
			 * la longitud de la celda, el alto, salto de linea, etc @param Cell
			 */
			// Establecemos la fuente en negrita ademas en Arial 15
			$this->SetFont('Arial','B',15);
			$this->Cell(30);
			$this->Cell(120,10, 'Reporte de Usuarios',0,0,'C');
			$this->Ln(20);
		}
		// Funcion para el pie de pagina
		function Footer()
		{
			// Establecemos en el pie de pagina el paginado en Arial 8 en Negrita
			$this->SetY(-15);
			$this->SetFont('Arial','B', 8);
			$this->Cell(0,10, 'Pagina '.$this->PageNo().'/{nb}',0,0,'C' );
		}		
	}
?>