var app = angular.module("tokkoDevelopment", ['ngRoute']);
app.controller("tokkoDevController", function($scope, $http, $rootScope){
	$scope.infoEstadoBusqueda = "Buscando...";
	$scope.emprendim = "";
	$scope.iniciarTokkoDev = function(){
		key = 'd6461f2e41bad2eb759162dac0a8f54ac19c9b23';
		$scope.realizarBusqueda();
	}

	$scope.realizarBusqueda = function(){


		$http.get('http://tokkobroker.com/api/v1/development/?format=json&key='+key+'&lang=es_ar')
				.then(function(response){
				$scope.emprendim =  response.data.objects;
					console.log($scope.emprendim);
				if ($scope.emprendim.length == 0) {
					$scope.infoEstadoBusqueda="No hay datos";
				}
				/*$scope.$apply(function($scope){
						$scope.propiedades =response.data.objects;
					});*/

			});
				

	}


	$scope.TraerTipoProp = function(){
		$http.get('http://www.tokkobroker.com/api/v1/property_type/?lang=es_ar&format=json&key='+key)
		.then(function(response){
			$scope.tipoPropiedades = response.data.objects;
			console.log($scope.tipoPropiedades);
		});
		
	}


	$scope.TraerProvincias = function(){
		$http.get('https://www.tokkobroker.com/api/v1/country/1/?lang=es_ar&format=json&key='+key)
		.then(function(response){
			$scope.provinciasFiltros = response.data.states;
			console.log($scope.provinciasFiltros);
		});
		
	}


});