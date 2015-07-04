
<?php
include("conexion.php");
$stri = "auto";
$res = select($stri);
echo $res;

if(isset($_GET['placa'],$_GET['kilometraje'],$_GET['clienteID'])){
	$placa=$_GET['placa'];
	$kilometraje=$_GET['kilometraje'];
	$clienteID=$_GET['clienteID'];
	insertarAuto($placa,$kilometraje,$clienteID);
}
?>
