
<?php
include("conexion.php");



if(isset($_GET['newCliente'])){

	$cliente = json_decode($_GET['newCliente']);
	insertarCliente($cliente->{'nombre'},$cliente->{'apellido'});
}

elseif(isset($_GET['codigo'])) {
	$codigo=$_GET['codigo'];
	eliminarCliente($codigo);
}
else{
	echo selectCliente();
}

function insertarCliente($nombre,$apellido){
    
    $pdo = conectar();
    $sql = "INSERT INTO Cliente (CliNom , CliApe) VALUES (:nom, :apel)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':nom'=>$nombre,':apel'=>$apellido ));
}

function eliminarCliente($codigo){
    $pdo = conectar();
    $sql = "UPDATE Cliente SET CliEsRe=0 WHERE CliCod =  :code";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':code', $codigo , PDO::PARAM_STR);   
    $stmt->execute();
}
function selectCliente(){
    $sql = 'SELECT *  FROM Cliente where CliEsRe=1';
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
?>
