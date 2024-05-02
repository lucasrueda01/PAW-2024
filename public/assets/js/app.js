function marcarMesas(planoDoc, mesas) {
    // Iterar sobre las mesas recibidas

    mesas.forEach(function(mesa) {
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

document.addEventListener('DOMContentLoaded', function() {
    
    
    let planoDelLocal = document.querySelector('#planoDelLocal');

    planoDelLocal.addEventListener('load', function() {
        
        var planoDoc = planoDelLocal.contentDocument;

        if (planoDoc) {

            let local = document.querySelector("#local");

            local.addEventListener("change", function() {

                var localSeleccionado = this.value;
            
                // Objeto con los datos a enviar al servidor
                var datos = {
                    local: localSeleccionado
                };
            
                // Configurar la solicitud AJAX
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "local/mesas", true);
                xhr.setRequestHeader("Content-Type", "application/json");
            
                // Manejar la respuesta del servidor
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var mesas = JSON.parse(xhr.responseText);
                        
                        console.log(mesas);
                        // marcarMesas(planoDoc, mesas);
                    }
                };
            
                // Convertir el objeto de datos a JSON y enviar la solicitud
                xhr.send(JSON.stringify(datos));
            });
                    

            var circulos = planoDoc.querySelectorAll(`[id^="mesa-"], [id^="barra-"]`);

            let mesas = planoDoc.querySelectorAll('.mesa');

            mesas.forEach(function(mesa) {
                mesa.addEventListener('click', function() {
                    console.log(mesa);
                });
            });
        
            if (circulos) {
                circulos.forEach(function(circulo) {
                    circulo.addEventListener('click', function() {
                        console.log(circulo);
                    });
                });
            }
        }
    });
});
