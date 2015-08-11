
<?php
include("conexion.php");


if(isset($_GET['newAuto'])){
	$auto = json_decode($_GET['newAuto']);
	insertarAuto($auto->{'placa'},$auto->{'kilometraje'},$auto->{'cliente'});
}
else{
	echo leerAuto();
}

function insertarAuto($placa,$kilometraje,$clienteID){ 
    $pdo = conectar();
    $sql = "INSERT INTO Auto (AutPla , AutKil, CliCod) VALUES (:pla, :kil, :cli)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':pla'=>$placa,':kil'=>$kilometraje ,':cli'=> $clienteID));
}
function leerAuto(){
	$sql = 'SELECT *  FROM Auto WHERE AutEsRe=1';
    // use prepared statements, even if not strictly required is good practice
	$dbh = conectar();
    $stmt = $dbh->prepare( $sql );

    // execute the query
    $stmt->execute();

    // fetch the results into an array
    $result = $stmt->fetchAll( PDO::FETCH_ASSOC) ;

    // convert to json
    $json = json_encode( $result );

    $dbh= null;
    // echo the json string
  	return  $json;
}

?>
