class Pedido {

    static accionesPorEstado = {
        "sin-confirmar" : ["confirmar", "rechazar"],
        "confirmado" : [],
        "rechazado" : [],
        "en-preparacion" : ["finalizar", "cancelar"],
        "finalizado" : ["despachar", "pasar a retirar"]
    };


    async getEstado(id) {
        try {
            // Realizar la solicitud usando fetch
            const response = await fetch(`get-estado?id=${id}`);
            
            // Verificar si la solicitud fue exitosa
            if (!response.ok) {
                throw new Error(`Error al obtener el estado del pedido: ${response.status} - ${response.statusText}`);
            }

            // Parsear la respuesta JSON
            const pedido = await response.json();
            
            console.log(pedido);
            // Imprimir el estado del pedido
            console.log(`Pedido Nro: ${pedido['Nro Pedido']}, Estado: ${pedido['Estado']}`);

            // Devolver el estado del pedido
            return pedido['Estado'];
        } catch (error) {
            // Manejar errores de red u otros errores
            console.error('Error al obtener el estado del pedido:', error);
            throw error; // Puedes lanzar el error nuevamente o manejarlo de alguna otra forma según tus necesidades.
        }
    }

    obtenerAcciones(estado) {
        // Verificar si el estado dado existe en el objeto
        if (this.accionesPorEstado.hasOwnProperty(estado)) {
            return this.accionesPorEstado[estado];
        } else {
            return []; // Si el estado no está definido, devolver un arreglo vacío
        }
    }   
}