class GestorPedidos {

    actualizarEstado(pedido)
    {
        const estado = document.querySelector(`#estado`);
        estado.innerHTML = pedido['Estado'];
    }

    getEstadoPedido()
    {
        /**
         * 1) ajax donde envio el id
         * y recibo el estado del pedido
         */

        // Crear una instancia del objeto XMLHttpRequest
        var xhr = new XMLHttpRequest();        

        const idCompleto = document.querySelector(`[id^="pedido-nro-"]`);

        const soloIdPedido = idCompleto.id.split('-')[2];

        // Configurar la solicitud
        xhr.open('GET', 'get-estado?id=' + soloIdPedido, true);

        // Manejar el evento onload (cuando la solicitud se completa satisfactoriamente)
        xhr.onload = () => {
            // Verificar el estado de la solicitud
            if (xhr.status >= 200 && xhr.status < 300) {
                // Parsear la respuesta JSON
                var pedido = JSON.parse(xhr.responseText);
                
                // Función que se ejecutará si la solicitud tiene éxito
                console.log(`pedido Nro: ${pedido['Nro Pedido']}, estadoPedido: ${pedido['Estado']}`);
                this.actualizarEstado(pedido);

            } else {
                // Función que se ejecutará si hay un error en la solicitud
                console.error('Error al obtener el estado del pedido:', xhr.status, xhr.statusText);
                
            }
        };
        
        // Manejar el evento onerror (cuando hay un error en la solicitud)
        xhr.onerror = function() {
            console.error('Error de red al obtener el estado del pedido:', xhr.status, xhr.statusText);

        };

        // Enviar la solicitud
        xhr.send();        

    }
}