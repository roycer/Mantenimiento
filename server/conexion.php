<?php
function conectar(){
    // set up the connection variables
    $db_name  = 'mantenimiento';
    
    // connect to the database
    return new PDO("mysql:host=mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/;dbname=$db_name", $OPENSHIFT_MYSQL_DB_USERNAME, $OPENSHIFT_MYSQL_DB_PASSWORD);
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
