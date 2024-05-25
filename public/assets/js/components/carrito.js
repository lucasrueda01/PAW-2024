class Carrito{
    constructor()
    {
        this.cant_articulos = 0
        this.total_pedido = 0
        this.platos = []
        this.tableBody = document.querySelector('.stacked-table tbody');
        this.totalCompra = document.querySelector('.total-compra');
    }

    actualizarTabla() {
        // Limpiar el cuerpo de la tabla
        this.tableBody.innerHTML = '';

        // Iterar sobre cada plato en el carrito y agregarlo a la tabla
        this.platos.forEach(plato => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${plato.nombre}</td>
                <td>${plato.descripcion}</td>
                <td>$${plato.precio.toFixed(2)}</td>
                <td>${plato.cantidad}</td>
                <td>
                    <!-- Botón de eliminar o cualquier otra acción -->
                </td>
            `;
            this.tableBody.appendChild(tr);
        });

        // Actualizar el total de la compra
        this.totalCompra.textContent = `Total: $${this.total_pedido.toFixed(2)}`;
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
            // Actualizar la tabla
            this.actualizarTabla();
            
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
        // Actualizar la tabla
        this.actualizarTabla();
    }    

    decrementarCantidadPlato(platoId) {
        let plato = null;
        
        for (let i = 0; i < this.platos.length; i++) {
            const id = JSON.stringify(this.platos[i].id);
                        
            if (id === platoId) {
                plato = this.platos[i];
                console.log(`encontre plato: ${plato}`);
                break;
            }
        }
        
        if (plato && plato.cantidad > 0) { // Me Aseguro de que la cantidad sea mayor que 0 antes de decrementar
            plato.cantidad -= 1;
            this.cant_articulos -= 1;
            this.total_pedido -= plato.precio;
            // Actualizar la tabla
            this.actualizarTabla();
            return true
        }else{
            return false
        }
    }

    actualizarTabla() {
        // Limpiar el cuerpo de la tabla
        this.tableBody.innerHTML = '';

        // Iterar sobre cada plato en el carrito y agregarlo a la tabla
        this.platos.forEach((plato, index) => {
            if(plato.cantidad > 0){
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${plato.nombre}</td>
                    <td>${plato.descripcion}</td>
                    <td>$${plato.precio.toFixed(2)}</td>
                    <td>${plato.cantidad}</td>
                    <td>$${(plato.precio * plato.cantidad).toFixed(2)}</td>
                `;
                this.tableBody.appendChild(tr);
            }
        });

        // Actualizar el total de la compra
        this.totalCompra.textContent = `Total: $${this.total_pedido.toFixed(2)}`;

        // Agregar eventos a los botones de eliminar
        document.querySelectorAll('.btn_eliminar').forEach(btn => {
            btn.addEventListener('click', () => {
                const index = parseInt(btn.dataset.index);
                this.eliminarPlato(index);
            });
        });
    }
    

}