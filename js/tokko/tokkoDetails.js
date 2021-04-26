var app = angular.module("tokkoDetails", []);
app.controller("tokkoDetailsControllers", function($scope, $http){
	$scope.iniciarTokkoDetails = function(){

		key = 'd6461f2e41bad2eb759162dac0a8f54ac19c9b23';

		$scope.id_propiedad = document.getElementById('id_propiedad').value;

		$scope.buscarDetallePropiedad();

		btnMP = document.getElementById('btnMP');


	}

	$scope.buscarDetallePropiedad = function(){



		$http.get('http://www.tokkobroker.com/api/v1/property/'+$scope.id_propiedad+'/?lang=es_ar&format=json&key='+key)
				.then(function(response){
				$scope.propiedades =  response.data;
					console.log($scope.propiedades);
				$scope.descripcionFormat = $scope.propiedades.description;
				$scope.descripFormat2= $scope.descripcionFormat.replace("\n\n", '<p>');
				document.getElementById('detalle').innerHTML = $scope.descripFormat2.replace("\n", '<p>');
				$scope.dinero =  $scope.propiedades.operations[0].prices[0].price;
				$scope.priceFormat = $scope.dinero.toLocaleString('es-MX').replace(',','.');
				var $mapa = $('#mapas');2
				$mapa.append("<iframe src='https://www.google.com/maps?q="+$scope.propiedades.geo_lat+","+$scope.propiedades.geo_long+"&#038;z=14&#038;t=&#038;ie=UTF8&#038;output=embed' width='500' height='500'></iframe>");
			});
	}
})