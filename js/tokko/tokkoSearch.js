var app = angular.module("tokkoSearch", ['ngRoute']);
app.controller("tokkoSearchController", function($scope, $http, $rootScope){
	$scope.habitaciones = 1;
	$scope.infoEstadoBusqueda = "Buscando...";
	$scope.propiedades = "";
	$scope.iniciarTokkoSearch = function(){
		key = 'd6461f2e41bad2eb759162dac0a8f54ac19c9b23';
		tipoOperacion = document.getElementById('tipoOperacion').value;
		tipoPopiedad = document.getElementById('propiedades').value;
		ambientes = document.getElementById('ambientes').value;
		provincia = document.getElementById('provincia').value;
		zona = document.getElementById('zona').value;
		pais = 1;
		$scope.realizarBusqueda();
		$scope.TraerTipoProp();
		$scope.TraerProvincias();
	}

	$scope.realizarBusqueda = function(){

		if (provincia != 0 ) {
				current_localization_type = "state";
				current_localization_id = provincia;
			}else{
				if (pais =='') {
					current_localization_type = "";
					current_localization_id =0;
				}else{
					current_localization_type = "country";
					current_localization_id = pais;
				}
				
			}


			if(ambientes == 0){
				var datosB = '{"price_from":0,"price_to":9999999999,"currency":"ANY","current_localization_type":"'+current_localization_type+'","current_localization_id":'+current_localization_id+',"operation_types":['+tipoOperacion+'],"property_types":['+tipoPopiedad+']}';
			}else{
				var datosB = '{"price_from":0,"price_to":9999999999,"currency":"ANY","current_localization_type":"'+current_localization_type+'","current_localization_id":'+current_localization_id+',"operation_types":['+tipoOperacion+'],"property_types":['+tipoPopiedad+'], "filters":[["room_amount","=",'+ambientes+']]}';
			}

	


		$http.get('http://www.tokkobroker.com/api/v1/property/search/?lang=es_ar&format=json&limit=100&key='+key+'&data='+datosB)
				.then(function(response){
				$scope.propiedades =  response.data.objects;
					console.log($scope.propiedades);
				if ($scope.propiedades.length == 0) {
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