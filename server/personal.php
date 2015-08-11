
<?php
include("conexion.php");

if(isset($_GET['newPersonal'])){
    $personal = json_decode($_GET['newPersonal']);
    $strCargo=$personal->{'cargo'};

    if($strCargo=="Encargado"){
        insertarEncargado($personal->{'nombre'},$personal->{'apellido'});
    }
    elseif($strCargo=="Tecnico"){
        insertarTecnico($personal->{'nombre'},$personal->{'apellido'});
    }
}

elseif(isset($_GET['tipoCargo'])){
	$tipoCargo=$_GET['tipoCargo'];	
	echo selectPersonal($tipoCargo);
}

function insertarEncargado($nombre,$apellido){
    $conn = conectar();
    $sql = "INSERT INTO Encargado (EncNom ,EncApe ) VALUES (:nom, :apel)";
    $q = $conn->prepare($sql);
    $q->execute(array(':nom'=>$nombre,':apel'=>$apellido));
}
function insertarTecnico($nombre,$apellido){
    $conn = conectar();
    $sql = "INSERT INTO Tecnico (TecNom ,TecApe ) VALUES (:nom, :apel)";
    $q = $conn->prepare($sql);
    $q->execute(array(':nom'=>$nombre,':apel'=>$apellido));
}

function selectPersonal($tipoCargo){ 
    $sql = "SELECT * FROM " . $tipoCargo ;
    $dbh = conectar();
    $stmt = $dbh->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
    $json = json_encode( $result );
    $dbh= null;
    return  $json;
}
?>
