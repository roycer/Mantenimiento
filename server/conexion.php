<?php
function conectar(){
    // set up the connection variables
    $db_name  = 'mantenimiento';
    $hostname = 'localhost';
    $username = 'bd1';
    $password = 'pass';

    // connect to the database
    return new PDO("mysql:host=$hostname;dbname=$db_name", $username, $password);
    // a query get all the records from the users table
}

function select($tabla){
	$sql = 'SELECT *  FROM '. $tabla;
    // use prepared statements, even if not strictly required is good practice
	$dbh = conectar();
    $stmt = $dbh->prepare( $sql );

    // execute the query
    $stmt->execute();

    // fetch the results into an array
    $result = $stmt->fetchAll( PDO::FETCH_ASSOC );

    // convert to json
    $json = json_encode( $result );

    $dbh= null;
    // echo the json string
  	return  $json;
}

function insertarPersonal($nombre,$apellido,$cargo){
    $conn = conectar();
    $sql = "INSERT INTO Personal (PerNom ,PerApel ,PerCar ) VALUES ( :nom, :apel, :carg)";
    $q = $conn->prepare($sql);
    $q->execute(array(':nom'=>$nombre,':apel'=>$apellido,':carg'=>$cargo));

}

function eliminarPersonal($codigo){
    $pdo = conectar();
    $sql = "DELETE FROM Personal WHERE PerCod =  :code";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':code', $codigo , PDO::PARAM_STR);   
    $stmt->execute();
}

function insertarCliente($nombre,$apellido){
    
    $pdo = conectar();
    $sql = "INSERT INTO Cliente (CliNom , CliApe) VALUES (:nom, :apel)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nom'=>$nombre,':apel'=>$apellido ));
}

function insertarAuto($placa,$kilometraje,$clienteID){ 
    $pdo = conectar();
    $sql = "INSERT INTO Auto (AutPla , AutKil, CliCod) VALUES (:pla, :kil, :cli)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':pla'=>$placa,':kil'=>$kilometraje ,':cli'=> $clienteID));
}

function eliminarCliente($codigo){
    $pdo = conectar();
    $sql = "DELETE FROM Cliente WHERE CliCod =  :code";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':code', $codigo , PDO::PARAM_STR);   
    $stmt->execute();
}
?>
