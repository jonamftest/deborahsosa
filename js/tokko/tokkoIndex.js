var app = angular.module("tokkoIndex", []);
app.controller("tokkoIndexController", function($scope, $http){

	$scope.iniciarTokkoIndex = function(){
		key = 'd6461f2e41bad2eb759162dac0a8f54ac19c9b23';

		$scope.buscarNuevosIngresos();

	}
	$scope.buscarNuevosIngresos = function(){
		var datosB = '{"price_from":0,"price_to":9999999999,"currency":"ANY","current_localization_type":"country","current_localization_id":1,"operation_types":[],"property_types":[]}';
		$http.get('http://www.tokkobroker.com/api/v1/property/search/?lang=es_ar&format=json&limit=4&order=-id&key='+key+'&data='+datosB)
				.then(function(response){
				$scope.NuevasPropiedades =  response.data.objects;
					console.log($scope.NuevasPropiedades);
			});
	}
});