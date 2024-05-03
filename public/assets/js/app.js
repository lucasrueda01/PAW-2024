

function marcarMesas(planoDoc, mesas) {
    // Iterar sobre las mesas recibidas

    mesas.forEach(function (mesa) {
        // Obtener el nombre de la mesa
        var nombreMesa = mesa.nombre;

        // Buscar el elemento de la mesa con el nombre correspondiente y marcarlo con verde
        var mesaElemento = planoDoc.querySelector(`#${nombreMesa} .mesa`);

        console.log(mesaElemento);

        if (mesaElemento) {
            mesaElemento.style.fill = "green";
        }
    });
}

function manejarRespuestaAjax(response){
    console.log(response);
}

function enviarAjax(params){

        // Configurar la solicitud AJAX
        var xhr = new XMLHttpRequest();
        xhr.open(params['method'], params['path'], true);
        xhr.setRequestHeader("Content-Type", "application/json");

        // Manejar la respuesta del servidor
        xhr.onload = function () {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                manejarRespuestaAjax(response);
            }
        };

        // Convertir el objeto de datos a JSON y enviar la solicitud
        xhr.send(JSON.stringify(params['datos']));
}

document.addEventListener("DOMContentLoaded", function () {
    let planoDelLocal = document.querySelector("#planoDelLocal");

    var planoDoc = planoDelLocal.contentDocument;

    let local = document.querySelector("#local");

    local.addEventListener("change", function () {
        var localSeleccionado = this.value;


        enviarAjax({
            datos:  {
                local: localSeleccionado,
            },
            method: 'GET',
            path: 'local/mesas'
        });


    });

    var circulos = planoDoc.querySelectorAll(`[id^="mesa-"], [id^="barra-"]`);

    let mesas = planoDoc.querySelectorAll(".mesa");

    mesas.forEach(function (mesa) {
        mesa.addEventListener("click", function () {
            console.log(mesa);
        });
    });

    if (circulos) {
        circulos.forEach(function (circulo) {
            circulo.addEventListener("click", function () {
                console.log(circulo);
            });
        });
    }

});

document.addEventListener("DOMContentLoaded", function() {

    // Obtener todas las mesas
    const mesas = document.querySelectorAll('.mesa');

    console.log(mesas);

    // Agregar un evento de clic a cada mesa
    // mesas.forEach(mesa => {
    //   mesa.addEventListener('click', function(event) {
    //     // Obtener el ID de la mesa clickeada
    //     const mesaId = event.target.id;
        
    //     // Hacer lo que necesites con el ID de la mesa clickeada
    //     console.log('ID de la mesa clickeada:', mesaId);
        
    //     // Por ejemplo, podrías guardarlo en una variable global, enviarlo a un servidor, etc.
    //     // globalVariable = mesaId;
    //   });
    // });
    
});
    