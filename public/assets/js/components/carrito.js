class Carrito{
    constructor()
    {
        this.cant_articulos = 0
        this.total_pedido = 0
        this.platos = []
    }

    cargarPlatos(){
        /**
         * recorro todos los platos 
         * y cargo por plato una clase plato
         */
        document.querySelectorAll('.articulo').forEach(articulo => {
            const nombre = articulo.querySelector('h4').dataset.id;
            const descripcion = articulo.querySelector('p').dataset.id;
            const precio = parseFloat(articulo.querySelector('.articulo_precio').dataset.id.replace('$', '').replace(',', '.'));
            const cantidad = parseInt(articulo.querySelector('.input_cantidad').value);
            const id = parseInt(articulo.dataset.id);

            const newPlato = new Plato(nombre, descripcion, precio, cantidad, id);
            console.log(newPlato)
            this.platos.push(newPlato);
        })
    }


    incrementarCantidadPlato(platoId) {
        
        let plato = null;
        
        for (let i = 0; i < this.platos.length; i++) {

            const id = JSON.stringify(this.platos[i].id)
                       
            if (id === platoId) {
                plato = this.platos[i];
                console.log(`encontre plato: ${plato}`)
                break;
            }
        }
        
        if (plato) {
            plato.cantidad += 1;
            this.cant_articulos += 1;
            this.total_pedido += plato.precio;
        }
    }    

    actualizarCartel(cantidad)
    {
        /**
         * obtener htmlObject cartel `cantidad-articulos`
         * actualizar con la cantidad q envian por parametro
         */
        const enlaceCarrito = document.querySelector('.carrito');

        // Actualiza el contenido del enlace con la cantidad de artículos del carrito
        enlaceCarrito.textContent = `Cantidad de Articulos: 0${this.cant_articulos}`;         
    }
    

}