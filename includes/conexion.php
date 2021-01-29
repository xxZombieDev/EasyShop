<?php
    /**
     * @param hostname este parametro se refiere al host
     * @param database se refiere al nombre de la BD
     * @param username se refiere a nuestro nombre de usuario de BD
     * @param password se refiere a nuestra contrasena de BD
     */
    //Variables de Conexion
    $hostname="localhost"; 
    $database="MiTiendita";
    $username="root"; 
    $password=""; 

    // Establecimiento de la conexin a la BD
    $conexion=mysqli_connect($hostname,$username,$password,$database); 

    // Verificamos que la conexion sea exitosa
    if ($conexion->connect_error) {
        die("La conexion fallo: " . $conn->connect_error);
    }  
?>