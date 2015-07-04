
<?php
include("conexion.php");
$stri = "Personal";
$res = select($stri);
echo $res;

if(isset($_GET['nombre'],$_GET['apellido'],$_GET['cargo'])){
	$nombre=$_GET['nombre'];
	$apellido=$_GET['apellido'];
	$cargo=$_GET['cargo'];
	insertarPersonal($nombre,$apellido,$cargo);
}
elseif(isset($_GET['codigo'])) {
	$codigo=$_GET['codigo'];
	eliminarPersonal($codigo);
}



?>
