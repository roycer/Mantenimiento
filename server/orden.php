
<?php
include("conexion.php");


if(isset($_GET['OrdenCabecera'], $_GET['OrdenDetalle'], $_GET['ListTrabajos'] )){

	$OrdenCabecera = json_decode($_GET['OrdenCabecera']);
	$OrdenDetalle = json_decode($_GET['OrdenDetalle']);
	$ListTrabajos = json_decode($_GET['ListTrabajos']);
	//$new_date = date('Y-m-d H:i:s', strtotime($HoraFin));

	$placaAuto  = $OrdenCabecera->{'auto'};
	$personal = $OrdenCabecera->{'personal'};
	$encargado = $OrdenCabecera->{'encargado'};
	$HoraInicio =  date('H:i:s', strtotime($OrdenCabecera->{'HoraInicio'}));
	$HoraFin = date('H:i:s', strtotime($OrdenCabecera->{'HoraFin'}));
	$FechaInicio = date('Y-m-d', strtotime($OrdenCabecera->{'FechaInicio'})) ;
	$FechaFin = date('Y-m-d', strtotime($OrdenCabecera->{'FechaFin'})) ;
	$costoTotal = $OrdenCabecera->{'CostoTotal'};

	$idCabecera = insertarOrdenCab($placaAuto,$personal,$encargado,$costoTotal,$FechaInicio,$FechaFin,$HoraInicio,$HoraFin);

	foreach ($ListTrabajos->{'Trabajos'} as $objTrabajo){
		$idTrabajo =  $objTrabajo->{'TraCod'};
	    $descripcion = $OrdenDetalle->{'Descripcion'}->{$idTrabajo};
	    $costo = $OrdenDetalle->{'Costos'}->{$idTrabajo};
	    insertarOrdenDet($placaAuto, $idCabecera, $idTrabajo, $descripcion, $costo);
	}
}
if(isset($_GET['trabajo'])){
	$stri = "trabajo";
	$res = select($stri);
	echo $res;
}
else if(isset($_GET['detalle'])){
	$idNumOrden =  $_GET['detalle'];
	echo LeerDetalle($idNumOrden);
}
else{
	echo LeerOrden();
}

function insertarOrdenCab($CodAuto, $CodPer, $CodJefe, $costoTotal, $FI, $FF, $HI, $HF){
    $pdo = conectar();
    $sql = "INSERT INTO ordcab (AutPla, EmpCod, PerCod, EncCod, OrdCabMonTot, OrdFecIni, OrdFecFin, OrdFecIniHH, OrdFecFinHH) VALUES (:pla,1, :per, :enc, :cost, :fi, :ff, :hi, :hf)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':pla'=>$CodAuto, ':per'=>$CodPer, ':enc'=>$CodJefe, ':cost'=>$costoTotal, ':fi'=>$FI, ':ff'=>$FF, ':hi'=>$HI, ':hf'=>$HF));
    return $pdo->lastInsertId('OrdNum');
}

function insertarOrdenDet($CodAuto, $idCabecera, $CodTrabajo, $Descripcion, $Monto){
    $pdo = conectar();
    $sql = "INSERT INTO orddet (AutPla, OrdNum, TraCod, OrdDetDes, OrdDetMonto) VALUES (:pla, :cab, :tra, :des, :mon)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':pla'=>$CodAuto,':cab'=>$idCabecera,':tra'=>$CodTrabajo,':des'=>$Descripcion,':mon'=>$Monto));
}
function LeerOrden(){
	$sql = 'SELECT OrdNum,AutPla,OrdCabMonTot,(SELECT TecNom from tecnico where TecCod=PerCod)as PerCod FROM ordcab WHERE OrdEsRe=1';
    // use prepared statements, even if not strictly required is good practice
	$dbh = conectar();
    $stmt = $dbh->prepare( $sql );
    $stmt->execute();
    $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
    $json = json_encode( $result );

    $dbh= null;
    // echo the json string
  	return  $json;
}

function LeerDetalle($idNumOrden){
	$sql = 'SELECT TraCod,OrdDetDes,OrdDetMonto FROM orddet where OrdNum='.$idNumOrden;
    // use prepared statements, even if not strictly required is good practice
	$dbh = conectar();
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll( PDO::FETCH_ASSOC );
    $json = json_encode( $result );

    $dbh= null;
    // echo the json string
  	return  $json;
}
?>