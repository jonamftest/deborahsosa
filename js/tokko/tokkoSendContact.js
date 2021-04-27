var app = angular.module("tokkoSendContact", []);
app.controller("tokkoSendContactController", function($scope, $http){
	$scope.enviarMensajeContacto = function(){
		key = 'd6461f2e41bad2eb759162dac0a8f54ac19c9b23';

		nombre= document.getElementById('template-contactform-name').value;
		email= document.getElementById('template-contactform-email').value;
		telefono= document.getElementById('template-contactform-phone').value;
		asunto= document.getElementById('template-contactform-subject').value;
		motivo= document.getElementById('template-contactform-service').value;
		mensaje= document.getElementById('template-contactform-message').value;

		tags = ["Contacto", asunto, motivo];

		/*tags=*/

		if (nombre == '' || email == '' || telefono == '' || asunto =='' ||
			motivo == '' || mensaje == '') {
		}else{

			var datosEnviar = new Object();

			datosEnviar.properties = "",
			datosEnviar.name = nombre;
			datosEnviar.email = email;
			datosEnviar.text = mensaje;
			datosEnviar.cellphone = telefono;
			datosEnviar.tags = tags;

			datosEnviarJson = JSON.stringify(datosEnviar);

			$http.post('http://www.tokkobroker.com/api/v1/webcontact/?key=d6461f2e41bad2eb759162dac0a8f54ac19c9b23', datosEnviarJson)
				.then(function(response){
					$("#mensajeEnviadoOK").fadeIn(1500);
					$("#mensajeEnviadoOK").fadeOut(2000);
			});
		}
	}
});