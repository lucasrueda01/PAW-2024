// function manejarRespuestaAjax(data){
    
//     var mesasDesocupadas = data.desocupadas;
//     console.log(mesasDesocupadas);
//     marcarMesas(mesasDesocupadas);
// }

// function enviarAjax(params){

//         // Configurar la solicitud AJAX
//         var xhr = new XMLHttpRequest();
//         xhr.open(params['method'], params['path'], true);
//         xhr.setRequestHeader("Content-Type", "application/json");

//         // Manejar la respuesta del servidor
//         xhr.onload = function () {
//             if (xhr.status === 200) {
//                 var response = JSON.parse(xhr.responseText);
//                 manejarRespuestaAjax(response);
//             }
//         };

//         // Convertir el objeto de datos a JSON y enviar la solicitud
//         xhr.send(JSON.stringify(params['datos']));
// }

// var localValue, dateValue, timeValue;

// function buscarMesas() {
//     console.log(localValue + dateValue + timeValue)
//     if (localValue && dateValue && timeValue) {
//         var xhr = new XMLHttpRequest();
//         var url = "local/mesas";
//         url += "?local=" + localValue + "&date=" + dateValue + "&time=" + timeValue;
//         xhr.open("GET", url, true);
//         xhr.onreadystatechange = function() {
//             if (xhr.readyState === XMLHttpRequest.DONE) {
//                 if (xhr.status === 200) {
//                     var response = JSON.parse(xhr.responseText);
//                     manejarRespuestaAjax(response);
//                 } else {
//                     console.error("Error al realizar la solicitud AJAX");
//                 }
//             }
//         };
//         xhr.send();
//     }
// }

// function cargarFormularioYComprobar() {
//     var local = document.querySelector("#local");
//     var date = document.querySelector("#date");
//     var time = document.querySelector("#time");

//     localValue = local.value;
//     dateValue = date.value;
//     timeValue = time.value;



//     local.addEventListener("change", function() {
//         localValue = local.value;
//         buscarMesas();
//     });

//     date.addEventListener("change", function() {
//         dateValue = date.value;
//         buscarMesas();
//     });

//     time.addEventListener("change", function() {
//         timeValue = time.value;
//         buscarMesas();
//     });

// }



// document.addEventListener("DOMContentLoaded", function () {

//     cargarFormularioYComprobar();

// });

class appPAW {
	constructor() {
        
        document.addEventListener("DOMContentLoaded", () => {
        PAW.cargarScript("Datos", "/assets/js/components/datos.js");
		PAW.cargarScript("ServicioRestaurante", "/assets/js/components/serviciorestaurante.js", () => {	

            const datos = new Datos();

            const servicioRestaurante = new ServicioRestaurante();

            const mesasLocal = servicioRestaurante.cargarMesasDesdeLocal(datos.getLocales());

            servicioRestaurante.cargarFormularioYComprobar()

            });
		}
        );
    }
}

let app = new appPAW();
