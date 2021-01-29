<?
include 'connection.php';

$j = array();

mysqli_set_charset($conexion, 'utf8');

$cuenta = $_POST['cuenta'];
$estado = $_POST['estado'];
$nombre = $_POST['nombre'];
$trabajo = $_POST['trabajo'];
$lecturaAC = $_POST['lecturaAC'];
$lecturaDC = $_POST['lecturaDC'];
$NNM = $_POST['N_N_M'];
$longitud = $_POST['lon'];
$latitud = $_POST['lat'];
$materiales = $_POST['Materiales'];
$observaciones = $_POST['observ'];
$fecha = $_POST['fecha'];
$imagenA = $_POST['imagenesAntes'];
$imagenD = $_POST['imagenesDespues'];
    
$result = $conexion->query("INSERT INTO registro(cuenta,estado,nombre_u,t_trabajo,lecturaAC,lecturaDC,Nuevo_N_Med,lon,lat,materiales,observ,fecha) 
VALUES ('".$cuenta."','".$estado."','".$nombre."','".$trabajo."','".$lecturaAC."','".$lecturaDC."',
'".$NNM."','".$longitud."','".$latitud."','".$materiales."','".$observaciones."','".$fecha."')");
    
$imagenEnBase64 = implode(', ', $imagenA);

$rutaImagenSalida = "../AcquApp.codeandcoffee.com.mx/fotografias/".$cuenta."_ANTES.jpg";
$imagenBinaria = base64_decode($imagenEnBase64);
$bytes = file_put_contents($rutaImagenSalida, $imagenBinaria);

$imagenEnBase64D = implode(', ', $imagenD);

$rutaImagenSalidaD = "../AcquApp.codeandcoffee.com.mx/fotografias/".$cuenta."_DESPUES.jpg";
$imagenBinariaD = base64_decode($imagenEnBase64D);
$bytesD = file_put_contents($rutaImagenSalidaD, $imagenBinariaD);

$result2 = $conexion->query("INSERT INTO imagenes(cuenta,a1,d1) 
VALUES ('".$cuenta."','".$rutaImagenSalida."','".$rutaImagenSalidaD."')");


$query = $conexion->query("SELECT EXISTS (SELECT * FROM registro WHERE cuenta = '".$cuenta."') as estado;");

for ($set = array (); $row = $query->fetch_assoc(); $set[] = $row);
$j = json_encode($set, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT );

print_r($j);

?>