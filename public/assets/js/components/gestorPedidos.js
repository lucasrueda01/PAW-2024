
class GestorPedidos {

    actualizarEstado(pedido)
    {
        
        const estadoHTML = document.querySelector(`#estado`);
        estadoHTML.innerHTML = pedido.estado;

        const animador = new Animador();
        /**
         * establece una animacion de 5seg para indicar que se pidio informacion al servidor
         */
        animador.animar(estadoHTML, 5000 , 'animado'); 
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

    async getEstadoPedido()
    {
        /**
         * 1) ajax donde envio el id
         * y recibo el estado del pedido
         */     

        const idCompleto = document.querySelector(`[id^="pedido-nro-"]`)
        const estado_anterior = document.querySelector(`[id^="estado"]`)

        console.log(idCompleto)
        const soloIdPedido = idCompleto.id.split('-')[2]

        const pedido = new Pedido()

        try{
            const estado = await pedido.getEstado(soloIdPedido)
            if (estado != estado_anterior && estado){
                this.actualizarEstado({estado: estado, pedido: soloIdPedido})
                this.actualizarAccionesSegunEstadoPedido(estado, soloIdPedido)
            }
        }catch(error){
            console.error('Error al obtener el estado del pedido:', error)
        }      

    }
}