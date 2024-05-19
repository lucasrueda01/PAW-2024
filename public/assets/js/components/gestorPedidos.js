
class GestorPedidos {

    actualizarEstado(nuevoEstado) {
        const estadoElement = document.querySelector('#estado');
        const estadoAnterior = estadoElement.getAttribute('data-estado');
        
        console.log(estadoAnterior);
    
        if (estadoAnterior !== nuevoEstado) {
            estadoElement.setAttribute('data-estado', nuevoEstado);
            estadoElement.innerHTML = `<strong>Estado:</strong> ${nuevoEstado}`;
            const animador = new Animador();
            /**
             * establece una animacion de 5seg para indicar que se pidió información al servidor
             */
            animador.animar(estadoElement, 5000, 'animado');
    
            console.log(`nuevoEstado: ${nuevoEstado}`);
            const estados = Object.keys(Pedido.accionesPorEstado);
            console.log(estados)
            // Verificar si el nuevo estado es 'pasar-a-retirar'
            if (estados.includes(nuevoEstado)) {
                // Verificar si el dispositivo es un celular
                const isMobile = /Mobi|Android/i.test(navigator.userAgent);
                if (isMobile && 'vibrate' in navigator) {
                    // Hacer vibrar el dispositivo
                    navigator.vibrate(200); // La duración de la vibración en milisegundos
                } else {
                    // Emitir una señal sonora
                    const audio = new Audio('/assets/audios/play-comida-lista.mp3');
                    audio.play().catch(error => console.error('Error al reproducir el sonido:', error));
                }
            } 
        }
    }
    
    

    actualizarAccionesSegunEstadoPedido(estado, id)
    {
        /**
         * recibo un estado y le pido a la clase pedido 
         * cuales son las opciones siguientes,
         * esta me devuelve la lista de acciones 
         * y agrego los botones correspondientes
         * como hijos de elemento section cuya clase es `detalles_pedido` 
         */

        console.log(Pedido.accionesPorEstado[estado])
        // const listaAcciones = pedido.obtenerAcciones(estado)

        const detallesPedido = document.querySelector('.detalles_pedido');

        // Obtener todos los enlaces <a> dentro de la sección
        const enlaces = detallesPedido.querySelectorAll('a');

        // Eliminar cada enlace
        enlaces.forEach(enlace => {
            enlace.remove();
        });        

        Pedido.accionesPorEstado[estado].forEach((accion) => {
            console.log(`accion: ${accion}`);

            // Crear un nuevo elemento <a>
            const nuevoEnlace = document.createElement('a');
    
            // Agregar clases al nuevo enlace
            nuevoEnlace.classList.add('boton', 'boton_negro');        
            
            nuevoEnlace.href = `/pedidos/estado/modificar?id=${id}&estado=${Pedido.urlsAccion[accion]}`

            nuevoEnlace.textContent = accion
    
            // Agregar el enlace a la sección "detalles_pedido"
            detallesPedido.appendChild(nuevoEnlace);
        });

    }

    async getEstadoPedido() {
        /**
         * 1) ajax donde envío el id
         * y recibo el estado del pedido
         */     
    
        const idCompleto = document.querySelector(`[id^="pedido-nro-"]`);
        const estadoElement = document.querySelector('#estado');
        const estado_anterior = estadoElement.getAttribute('data-estado');
    
        const soloIdPedido = idCompleto.id.split('-')[2];
        
        console.log(`estado_anterior: ${estado_anterior}`);
        console.log(`soloIdPedido: ${soloIdPedido}`);
        const pedido = new Pedido();
    
        try {
            const estado = await pedido.getEstado(soloIdPedido);
            if (estado != estado_anterior && estado) {
                this.actualizarEstado(estado);
                this.actualizarAccionesSegunEstadoPedido(estado, soloIdPedido);
            }
        } catch (error) {
            console.error('Error al obtener el estado del pedido:', error);
        }      
    }
    

    async getEstadosPedidos() {
        /**
         * Verifica el estado de todos los pedidos y actualiza la interfaz si ha cambiado.
         */
        const pedidoElements = document.querySelectorAll(`[id^="pedido-nro-"]`);

        for (const pedidoElement of pedidoElements) {
            const idCompleto = pedidoElement.id;
            const soloIdPedido = idCompleto.split('-')[2];
            const estado_anterior = pedidoElement.querySelector('.estado').innerHTML;

            const pedido = new Pedido();

            try {
                const estado = await pedido.getEstado(soloIdPedido);
                if (estado && estado !== estado_anterior) {
                    this.actualizarEstado(pedidoElement, estado);
                    this.actualizarAccionesSegunEstadoPedido(estado, soloIdPedido, pedidoElement);
                }
            } catch (error) {
                console.error('Error al obtener el estado del pedido:', error);
            }
        }
    }
}