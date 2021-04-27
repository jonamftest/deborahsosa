var app = angular.module("tokkoSendtasaciones", []);
app.controller("tokkoSendTasacionesController", function($scope, $http){
	$scope.enviarMensajeTasaciones = function(){
	

		nombre= document.getElementById('shipping-form-name').value;
		email= document.getElementById('shipping-form-address').value;
		telefono= document.getElementById('shipping-form-companyname').value;
		tipoOperacion= document.getElementById('template-contactform-service').value;
		tipoPropiedad= document.getElementById('propiedad').value;
		barrio= document.getElementById('billing-form-companyname').value;
		mensaje= document.getElementById('template-contactform-message').value;

		tags = ["Tasación", tipoOperacion, tipoPropiedad, barrio];


		if (nombre == '' || email == '' || telefono == '' || tipoOperacion =='' ||
			tipoPropiedad == '') {
		}else{

			var datosEnviar = new Object();

			datosEnviar.properties = "",
			datosEnviar.name = nombre;
			datosEnviar.email = email;
			datosEnviar.text = mensaje;
			datosEnviar.cellphone = telefono;
			datosEnviar.tags = tags;

			datosEnviarJson = JSON.stringify(datosEnviar);

			console.log(datosEnviar);

			$http.post('http://www.tokkobroker.com/api/v1/webcontact/?key=d6461f2e41bad2eb759162dac0a8f54ac19c9b23', datosEnviarJson)
				.then(function(response){

					$("#mensajeEnviadoOK").fadeIn(1500);
					$("#mensajeEnviadoOK").fadeOut(2000);
			});
		}
	}
});