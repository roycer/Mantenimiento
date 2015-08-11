var app = angular.module('myApp', ['includeExample','checklist-model']);

app.controller('myCtrl',  function($scope, $http) {
  $http.get("server/orden.php").success(function (response) {$scope.ordenes = response;});

   $scope.leerDetalle = function(){
    $http({
      method: 'GET',
      url: 'server/orden.php',
      params:{ detalle: 5}  
    }).success(function (response) {$scope.detalles = response;});
  };
});

app.controller('myCtrlPersonal',  function($scope, $http) {
  $http.get("server/personal.php?tipoCargo=Tecnico").success(function (response) { $scope.personales = response;});
    $http.get("server/personal.php?tipoCargo=Encargado").success(function (response) { $scope.jefes = response;});  
  $scope.cargos = [{name:'Encargado'},{name:'Tecnico'}];
  
  $scope.add = function(){
    $http({
      method: 'GET',
      url: 'server/personal.php',
      params:{ newPersonal: JSON.stringify($scope.personal)}
    });
  };

});

app.controller('myCtrlCliente',  function($scope, $http) {
  $http.get("server/cliente.php").success(function (response) { $scope.clientes = response;});  
  $scope.aaa = "0"
  $scope.add = function(){
    $http({
      method: 'GET',
      url: 'server/cliente.php',
      params:{ newCliente: JSON.stringify($scope.cliente)}
    });
  };
});

app.controller('myCtrlClienteDel',  function($scope, $http) {
  $http.get("server/cliente.php").success(function (response) { $scope.clientes = response;});  

  $scope.user = { codigo: '0' };


  $scope.del = function(){
    $http({
      method: 'GET',
      url: 'server/cliente.php',
      params:{ codigo: $scope.ID}  
    });
    
  };
});

app.controller('myCtrlAuto',  function($scope, $http) {
  
  $http.get("server/cliente.php").success(function (response) {$scope.clientes = response;});
  $http.get("server/auto.php").success(function (response) { $scope.autos = response});

  $scope.ordenarPor = function(orden) {
    $scope.ordenSeleccionado = orden;
  };
  
  $scope.add = function(){
    $http({
      method: 'GET',
      url: 'server/auto.php',
      params:{ newAuto: JSON.stringify($scope.auto)}  
    });
  };
});

app.controller('myCtrlOrden',  function($scope, $http) {
  
  $http.get("server/personal.php?tipoCargo=Tecnico").success(function (response) { $scope.personales = response;});
  $http.get("server/auto.php").success(function (response) { $scope.autos = response});
  $http.get("server/personal.php?tipoCargo=Encargado").success(function (response) { $scope.jefes = response;});  
  $http.get("server/orden.php?trabajo").success(function (response) {$scope.trabajos = response;});


  $scope.List = {};
  $scope.OrdenCabecera = {CostoTotal: 0};
  $scope.OrdenDetalle = {};
  
  $scope.setTotals = function(){
    var costoTotal = 0;
    for (i = 0; i < $scope.List['Trabajos'].length; i++) { 
      costoTotal += $scope.OrdenDetalle['Costos'][$scope.List['Trabajos'][i]['TraCod']];
    }
    $scope.OrdenCabecera.CostoTotal = costoTotal;
  }

  $scope.add = function(){
    $http({
      method: 'GET',
      url: 'server/orden.php',
      params:{ OrdenCabecera: JSON.stringify($scope.OrdenCabecera) , OrdenDetalle: JSON.stringify($scope.OrdenDetalle) , ListTrabajos: JSON.stringify($scope.List)}  
    });
  };
});

