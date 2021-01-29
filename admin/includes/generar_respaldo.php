<?php
	/**
	 * @author Ray Garcia Gonzalez
	 * @todo: Este script permite generar un respaldo de la Base de Datos
	 */
		//Creamos una variable con las tablas a respaldar, en este caso todas
        $tables = '*';
        // Preparamos la conexion
		$conn = new mysqli("localhost", "root", "", "MiTiendita");
		if ($conn->connect_error) {
		    die("La conexión falló: " . $conn->connect_error);
		}
		//Validamos si el respaldo sera para todas las tables
		if($tables == '*'){
            // Las almacenamos en un arreglo
            $tables = array();
            // Sacamos las tablas
			$sql = "SHOW TABLES";
			$query = $conn->query($sql);
			while($row = $query->fetch_row()){
                // Las almacenamos en el arreglo
				$tables[] = $row[0];
			}
        }
        // En caso de que tengamos un arreglo de tablas ya definido
		else{
            // Separamos el arreglo en tablas
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		//Empezamos a tomar la estructura de las tables
        $outsql = '';
        // recorreos con un Foreach
		foreach ($tables as $table) {
		    // Preparamos la consulta para crear las tabñes 
		    $sql = "SHOW CREATE TABLE $table";
		    $query = $conn->query($sql);
		    $row = $query->fetch_row();
		    // Vamos haciendo separaciones de tablas
		    $outsql .= "\n\n" . $row[1] . ";\n\n";
            // Vemos el contenido que tenga cada tabla actualmente
		    $sql = "SELECT * FROM $table";
		    $query = $conn->query($sql);
            // Almacenamos la tabla en un contador
		    $columnCount = $query->field_count;
		    // Comenzamos a leer toda la información
		    for ($i = 0; $i < $columnCount; $i ++) {
		        while ($row = $query->fetch_row()) {
                    // Insertamos los registros de cada tabla en el archivo de respaldo
		            $outsql .= "INSERT INTO $table VALUES(";
		            for ($j = 0; $j < $columnCount; $j ++) {
		                $row[$j] = $row[$j];
		                if (isset($row[$j])) {
		                    $outsql .= '"' . $row[$j] . '"';
		                } else {
		                    $outsql .= '""';
		                }
		                if ($j < ($columnCount - 1)) {
		                    $outsql .= ',';
		                }
		            }
		            $outsql .= ");\n";
		        }
		    }
		    
		    $outsql .= "\n"; 
		}

		// Fijamos un nombre al archivo de respaldo
        $backup_file_name = 'Easyshop' . '_respaldo.sql';
        // Abrimos el archivo de respaldo a generar y asignamos permisos
        $fileHandler = fopen($backup_file_name, 'w+');
        // Grabamos la información del resplado en el archivo sql
        fwrite($fileHandler, $outsql);
        // Cerramos el archivp
	    fclose($fileHandler);

	    // Preparamos las directivas para comenzar a descargar el archivo
	    header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
	    header('Content-Transfer-Encoding: binary');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($backup_file_name));
	    ob_clean();
	    flush();
	    readfile($backup_file_name);
	    exec('rm ' . $backup_file_name);

?>
