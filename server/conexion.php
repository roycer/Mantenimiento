<?php
function conectar(){
    // set up the connection variables
    define('DB_HOST', getenv('OPENSHIFT_MYSQL_DB_HOST'));
    define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
    define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
    define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
    define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));
    
    // connect to the database
    $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT;
    
    return new PDO($dsn, DB_USER, DB_PASS);
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
?>
