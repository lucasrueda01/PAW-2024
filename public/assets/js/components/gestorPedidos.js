
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

    async getEstadoPedido()
    {
        /**
         * 1) ajax donde envio el id
         * y recibo el estado del pedido
         */     

        const idCompleto = document.querySelector(`[id^="pedido-nro-"]`);

        const soloIdPedido = idCompleto.id.split('-')[2];


        const pedido = new Pedido()

        try{
            const estado = await pedido.getEstado(soloIdPedido);
            this.actualizarEstado({estado: estado, pedido: soloIdPedido});
        }catch(error){
            console.error('Error al obtener el estado del pedido:', error);
        }      

    }
}