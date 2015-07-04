
<?php
include("conexion.php");

$stri = "cliente";
$res = select($stri);
echo $res;

if(isset($_GET['nombre'],$_GET['apellido'])){
	$nombre=$_GET['nombre'];
	$apellido=$_GET['apellido'];
	insertarCliente($nombre,$apellido);
}

elseif(isset($_GET['codigo'])) {
	$codigo=$_GET['codigo'];
	eliminarCliente($codigo);
}

?>
