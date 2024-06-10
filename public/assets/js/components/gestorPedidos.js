
class GestorPedidos {

    actualizarEstado(nuevoEstado, permisoNotificacion = false) {
        const estadoElement = document.querySelector('#estado');
        const estadoAnterior = estadoElement.getAttribute('data-estado');
        
        if (estadoAnterior !== nuevoEstado) {
            estadoElement.setAttribute('data-estado', nuevoEstado);
            estadoElement.innerHTML = `<strong>Estado:</strong> ${nuevoEstado}`;
            const animador = new Animador();
            animador.animar(estadoElement, 5000, 'animado');
            
            // Verificar si el nuevo estado es 'pasar-a-retirar' 
                let tipoUsuario = getCookie('tipo_usuario');
                
                const estados = Object.keys(Pedido.accionesPorEstadoXTipoUsuario[tipoUsuario]);
                if (estados.includes(nuevoEstado) && permisoNotificacion) {
                    // Verificar si el dispositivo es un celular y si admite la vibración
                    const isMobile = /Mobi|Android/i.test(navigator.userAgent);
                    if (isMobile && 'vibrate' in navigator) {
                        // Hacer vibrar el dispositivo
                        navigator.vibrate(200); // La duración de la vibración en milisegundos
                    } 
                    
                    // Emitir una señal sonora
                    const audio = new Audio('/assets/audios/play-comida-lista.mp3');
                    audio.play().catch(error => console.error('Error al reproducir el sonido:', error));
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
        let tipoUsuario = getCookie('tipo_usuario');

        console.log(Pedido.accionesPorEstadoXTipoUsuario[tipoUsuario][estado])
        // const listaAcciones = pedido.obtenerAcciones(estado)

        const detallesPedido = document.querySelector('.detalles_pedido');

        // Obtener todos los enlaces <a> dentro de la sección
        const enlaces = detallesPedido.querySelectorAll('a');

        // Eliminar cada enlace
        enlaces.forEach(enlace => {
            enlace.remove();
        });        

        Pedido.accionesPorEstadoXTipoUsuario[tipoUsuario][estado].forEach((accion) => {
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

    async cambioEstadoPedido(estadoId, pedidoId) {
        const url = `/pedidos/get-estado?id=${pedidoId}`;
    
        // Realizar la solicitud de estado del pedido usando fetch y then
        try {
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error('No se pudo obtener el estado del pedido');
            }
            const data = await response.json();
            console.log(`data.estado_name: ${data.estado_name}, ${data.estado_id} !== ${estadoId}? : ${parseInt(data.estado_id) !== parseInt(estadoId)}`)
            return [data.estado_name, data.estado_id, parseInt(data.estado_id) !== parseInt(estadoId)];
        } catch (error) {
            console.error('Error al obtener el estado del pedido:', error);
            return false;
        }
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
      
    actualizarEstado(event) {
        event.preventDefault(); // Prevenir el comportamiento predeterminado del enlace
    
        // Obtener los datos del pedido del atributo data
        const pedidoId = event.target.getAttribute('data-id');
        const estadoActual = event.target.getAttribute('data-estado');
    
        // Obtener la referencia al elemento <section>
        const sectionElement = event.target.parentNode;
        // Crear la URL con los parámetros de la solicitud
        const url = `/pedido/actualizar-estado?id=${pedidoId}&estado=${estadoActual}`;
    
        console.log(url)
        // Enviar la solicitud al servidor
        fetch(url)
        .then(response => {
            // Verificar si la respuesta es exitosa
            if (!response.ok) {
                throw new Error('Error al actualizar el estado del pedido');
            }
            // Devolver los datos de la respuesta en formato JSON
            return response.json();
        })
        .then(data => {

            const estadoActualElement = sectionElement.querySelector('p:nth-child(7)')

            console.log(data)
            // console.log(data.next_status === "Pasar a retirar")
            let proximoEstado = "" 
            if(data.next_status === "Pasar a retirar"){
                proximoEstado += "pasar-a-retirar"
                sectionElement.classList.add(`status-${proximoEstado}`);
                console.log(sectionElement)                
            }else{
                proximoEstado += data.next_status 
                sectionElement.classList.add(`status-${proximoEstado.replace(' ', '-').toLowerCase()}`);
                console.log(sectionElement)                    
            }

            estadoActualElement.textContent = estadoActualElement.textContent
           
            const botonPedido = sectionElement.querySelector('a');

            if(data.next_status_to_next_status){            
                botonPedido.innerHTML = `Pasar a: ${data.next_status_to_next_status}`;
                botonPedido.setAttribute('data-estado', data.next_status_id); // Actualiza data-estado
            } else {

                    if (botonPedido) {
                        botonPedido.remove();
                    }
                    const p1 = document.createElement('p');
                    p1.className = 'cartel-finalizado';
                    p1.textContent = 'PEDIDO COMPLETADO';
                
                    const p2 = document.createElement('p');
                    p2.className = 'cartel-finalizado';
                    p2.textContent = '(Pasar a Retirar)';
                
                    sectionElement.appendChild(p1);
                    sectionElement.appendChild(p2);

            }

            // Cambiar la clase del elemento <article> para reflejar el estado actualizado
            // event.target.parentNode.classList.remove(`status-${estadoActual.replace(' ', '-').toLowerCase()}`);

        })
        .catch(error => {
            console.error('Error al actualizar el estado del pedido:', error);
        });
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