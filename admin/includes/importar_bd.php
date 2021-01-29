<?php 
/**
 * @author: Ray Garcia Gonzalez
 * @todo: Este Script permite importar un archivo SQL de respaldo
 */

/** @var message: esta variable nos permitira controlar los estados de importación */
$message = '';
// verificamos que exista un elemento que tenga el nombre "import" y si existe
if(isset($_POST["import"]))
{
  // verificamos que exista un archivo subido
 if($_FILES["database"]["name"] != '')
 {
   // Separamos el archivo hasta donde se encuentre un punto
  $array = explode(".", $_FILES["database"]["name"]);
  // verificamos la extension del archivo, por eso la separacion al punto
  $extension = end($array);
  // si la extension es .sql
  if($extension == 'sql')
  {
    // Preparamos la conexion a la base de datos
    $connect = mysqli_connect("localhost", "root", "", "MiTiendita");
   $output = '';
   $count = 0;
   // Comenzamos a analizar el contenido del archivo subido
   $file_data = file($_FILES["database"]["tmp_name"]);
   // Comenzamos a verificar la informacion
   foreach($file_data as $row)
   {
     // Comenzamos a verificar los caracters especiales, como comentarios que tienen 2 chars
    $start_character = substr(trim($row), 0, 2);
    // Si lo que leemos no es comentario o similar
    if($start_character != '--' || $start_character != '/*' || $start_character != '//' || $row != '')
    {
      // comenzamos a recorrer el archivo recibido
     $output = $output . $row;
     $end_character = substr(trim($row), -1, 1);
      // Si encontramos una terminación con ;
     if($end_character == ';')
     {
       // Si se genera al menos una sentencia 
      if(!mysqli_query($connect, $output))
      {
        // incrementamos un contador
       $count++;
      }
      $output = '';
     }
    }
   }
   // Una vez terminadas las iteraciones
   if($count > 0) 
   {
     // notificamos que el proceso fue finalizaodo
    $message = '<label class="text-danger">Proceso completado</label>';
   }
   else
   { // Que se importo correctamente
    $message = '<label class="text-success">Base de Datos Importada Correctamente</label>';
   }
  }
  else
  { // en caso de no terminar con extension sql el archivo 
   $message = '<label class="text-danger">Archivo Invalido</label>';
  }
 }
 else
 {  // En caso de no subir ningun archivo
  $message = '<label class="text-danger">Por Favor Seleccione un Archivo</label>';
 }
}
?>
