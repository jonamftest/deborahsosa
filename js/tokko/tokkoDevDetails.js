var app = angular.module("tokkoDevDetails", []);
app.controller("tokkoDevDetailsControllers", function($scope, $http){
	$scope.iniciarTokkoDevDetails = function(){

		key = 'd6461f2e41bad2eb759162dac0a8f54ac19c9b23';

		$scope.id_emprendimiento = document.getElementById('id_emprendimiento').value;

		$scope.buscarDetalleEmprendimiento();

		btnMP = document.getElementById('btnMP');


	}

	$scope.buscarDetalleEmprendimiento = function(){



		$http.get('http://www.tokkobroker.com/api/v1/development/'+$scope.id_emprendimiento+'/?lang=es_ar&format=json&key='+key)
				.then(function(response){
				$scope.emprendimiento =  response.data;
					console.log($scope.emprendimiento);
				$scope.descripcionFormat = $scope.emprendimiento.description;
				$scope.descripFormat2= $scope.descripcionFormat.replace("\n\n", '<p>');
				document.getElementById('detalle').innerHTML = $scope.descripFormat2.replace("\n", '<p>');
				var $mapa = $('#mapas');2
				$mapa.append("<iframe src='https://www.google.com/maps?q="+$scope.emprendimiento.geo_lat+","+$scope.emprendimiento.geo_long+"&#038;z=14&#038;t=&#038;ie=UTF8&#038;output=embed' width='500' height='500'></iframe>");
			});
	}
})