function iniciarTokko(){
	key = 'd6461f2e41bad2eb759162dac0a8f54ac19c9b23';
	traerPropiedades();
	traerProv();
	//traerZonas();
	selectProvincias = document.getElementById('provincias');
	selectProvincias.addEventListener('change', traerZonas, false);

	selectOperacion = document.getElementById('tipoOperacion');

	selectOperacion.addEventListener('change', desactivarSelectProp, false);
}

const traerPropiedades=async()=>{
			const res = await fetch('https://www.tokkobroker.com/api/v1/property_type/?lang=es_ar&format=json&key='+key);
			const data = await res.json();
			console.log(data.objects);

			var $selectProp = $('#propiedades');
			$(data.objects).each(function(id, nombre) {
				if(nombre.name == 'Casa' || nombre.name == 'Local' || nombre.name == 'Departamento' || nombre.name == 'PH' || nombre.name == 'Terreno' || nombre.name == 'Oficina'){
      			$selectProp.append('<option value=' + nombre.id + '>' + nombre.name + '</option>');
      			}
    		});
    		$selectProp.selectpicker("refresh");
		};


const traerProv=async()=>{
				const provincias = await fetch('https://www.tokkobroker.com/api/v1/country/1/?lang=es_ar&format=json&key='+key);
				const dataProvincias = await provincias.json();
				console.log(dataProvincias.states);



				var $selectProvincias = $('#provincias');

				/*$selectProvincias.empty().append('<option selected disabled>Seleccione una opcion...</option>');*/

				$(dataProvincias.states).each(function(id, prov) {
	      			$selectProvincias.append('<option value=' + prov.id + '>' + prov.name + '</option>');
   					});
			$selectProvincias.selectpicker("refresh");
			}

const traerZonas=async()=>{

			var seleccion = selectProvincias.selectedIndex;
			var id_provincia = selectProvincias.options[seleccion].value;


			const zonas = await fetch('https://www.tokkobroker.com/api/v1/state/'+id_provincia+'/?lang=es_ar&format=json&key='+key);
			const dataZonas = await zonas.json();
			console.log(dataZonas.divisions);

			var $selectZonas = $('#zonas');
			$selectZonas.empty().append('<option selected disabled value="">Todos</option>');
			$(dataZonas.divisions).each(function(id, nombre) {
				
      			$selectZonas.append('<option value=' + nombre.id + '>' + nombre.name + '</option>');
    		});
    		$selectZonas.selectpicker("refresh");
		};

function desactivarSelectProp(){
	var seleccionTipoOpe = selectOperacion.selectedIndex;
	var tipoOperacionValue = selectOperacion.options[seleccionTipoOpe].value;

	if (tipoOperacionValue == 4) {
		$("#propiedades option[value='']").attr("selected",true);
		$('#propiedades').selectpicker("refresh");
		$("#propiedades").prop("disabled", true);
		$(".selectpicker[data-id='propiedades']").addClass("disabled");

		$("#ambientes option[value='']").attr("selected",true);
		$('#ambientes').selectpicker("refresh");
		$("#ambientes").prop("disabled", true);
		$(".selectpicker[data-id='ambientes']").addClass("disabled");


	}else{
		$("#propiedades").prop("disabled", false);
		$(".selectpicker[data-id='propiedades']").removeClass("disabled");

		$("#ambientes").prop("disabled", false);
		$(".selectpicker[data-id='ambientes']").removeClass("disabled");
	}
}

window.addEventListener('load', iniciarTokko, false);