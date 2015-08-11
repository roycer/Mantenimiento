<?php

// $json = '{"Descripcion":{"1":"comentario","2":"ffff"},"Costos":{"1":12,"2":12}} ';
// $trabajos = '{"Trabajos":[{"TraCod":"1","TraNom":"Sistema Mecanico","TraEsRe":"1"},{"TraCod":"2","TraNom":"Sistema Electrico","TraEsRe":"1"}]}';
// $work = json_decode($trabajos);
// $obj = json_decode($json);



// foreach ($work->{'Trabajos'} as $id){
// 	echo  $id->{'TraCod'};
//     echo  $obj->{'Descripcion'}->{$id->{'TraCod'}};
//     echo  $obj->{'Costos'}->{$id->{'TraCod'}};
//     echo " ";
// } 



$jsonCab = '{"auto":"z-12","personal":"1","encargado":"1","HoraInicio":"1970-01-01T06:00:00.000Z","HoraFin":"1970-01-01T06:00:00.000Z","FechaInicio":"2015-01-01T05:00:00.000Z","FechaFin":"2015-01-01T05:00:00.000Z"}';
$OrdenCabecera = json_decode($jsonCab);

$placaAuto  = $OrdenCabecera->{'auto'};

$HoraInicio = $OrdenCabecera->{'HoraInicio'};
$HoraFin = $OrdenCabecera->{'HoraFin'};
$FechaInicio = $OrdenCabecera->{'FechaInicio'};



$new_date = date('Y-m-d H:i:s', strtotime($HoraFin));
echo $new_date;

$FechaFin = $OrdenCabecera->{'FechaFin'};

$personal = $OrdenCabecera->{'personal'};
$encargado = $OrdenCabecera->{'encargado'};



  // $http.get("server/orden.php?");
  // $http.get("server/personal.php").success(function (response) {$scope.empleados = response;});
  // $http.get("server/personal.php").success(function (response) { $scope.personales = response;});
  // $http.get("server/personal.php?tipoCargo=Jefe").success(function (response) { $scope.jefes = response;});
  // $http.get("server/auto.php").success(function (response) { $scope.autos = response;});
  // $http.get("server/cliente.php").success(function (response) { $scope.clientes = response;});

?>



<!-- if(isset($_GET['newAuto'])){

	$auto = json_decode($_GET['newAuto']);
	insertarAuto($auto->{'placa'},$auto->{'kilometraje'},$auto->{'cliente'});
}

Orden Cabecera

INSERT INTO `man2`.`ordcab` (`AutPla`, `EmpCod`, `PerCod`, `OrdCabMonTot`, `OrdFecIni`, `OrdFecFin`, `OrdFecIniHH`, `OrdFecFinHH`) VALUES ('A9Z-121', '1', '1', '2000.00', '2015-07-15', '2015-07-18', '15:24:00', '17:22:00');


Orden Detalle

INSERT INTO `man2`.`orddet` (`AutPla`, `OrdNum`, `TraCod`, `OrdDetDes`, `OrdDetMonto`) VALUES ('A9Z-121', '1', '1', 'El Sistema Mecanico sera modificado de tal manera q el auto pueda desarrollarse normalmente se llevara acabo el mantenimemto en el taller.', '2000.00'); -->


<!-- function eliminarPersonal($codigo,$cargo){
    $pdo = conectar();
    $sql = "DELETE FROM Personal WHERE PerCod =  :code";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':code', $codigo , PDO::PARAM_STR);   
    $stmt->execute();
}
 -->