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

    actualizarCantidadInput(platoId, nuevaCantidad) {
        // Buscar el elemento <li> con el data-id coincidente
        const articulo = document.querySelector(`.articulo[data-id='${platoId}']`);
        
        if (articulo) {
            // Encontrar el input dentro del <li>
            const inputCantidad = articulo.querySelector('.input_cantidad');
            if (inputCantidad) {
                // Actualizar el valor del input
                inputCantidad.value = nuevaCantidad;
            }
        }
    }

    actualizarTabla() {
        // Limpiar el cuerpo de la tabla
        this.tableBody.innerHTML = '';
        
        // Iterar sobre cada plato en el carrito y agregarlo a la tabla
        this.platos.forEach((plato) => {
            if (plato.cantidad > 0) {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${plato.nombre}</td>
                    <td>${plato.descripcion}</td>
                    <td>${Utils.formatCurrency(plato.precio)}</td>
                    <td>
                        <button class="btn_decrement_form" data-id="${plato.id}">-</button>
                        <input type="number" value="${plato.cantidad}" class="input_cantidad_form">
                        <button class="btn_increment_form" data-id="${plato.id}">+</button>
                    </td>
                    <td>${Utils.formatCurrency(plato.precio * plato.cantidad)}</td>
                `;
                this.tableBody.appendChild(tr);
            }
        });

        // Actualizar el total de la compra
        this.totalCompra.textContent = `Total: ${Utils.formatCurrency(this.total_pedido)}`;
        
        const carritoInput = document.getElementById('carrito_data');
        carritoInput.value = JSON.stringify(this);
        console.log(carritoInput.value)

        // Agregar eventos a los botones de incrementar
        document.querySelectorAll('.btn_increment_form').forEach(btn_increment => {
            btn_increment.addEventListener('click', () => {
                const platoId = btn_increment.dataset.id;
                this.incrementarCantidadPlato(platoId);
                console.log(this);

                // Actualizar la cantidad en el input correspondiente
                const inputCantidad = btn_increment.parentElement.querySelector('.input_cantidad_form');
                inputCantidad.value = parseInt(inputCantidad.value) + 1;
                this.actualizarCantidadInput(platoId, inputCantidad.value)
                // Actualizar el contador de artículos
                const cantidadArticulos = document.querySelector('.carrito');
                cantidadArticulos.textContent = `Cantidad de Articulos: ${String(this.cant_articulos).padStart(2, '0')}`;
            });
        });

        // Agregar eventos a los botones de decrementar
        document.querySelectorAll('.btn_decrement_form').forEach(btn_decrement => {
            btn_decrement.addEventListener('click', () => {
                const platoId = btn_decrement.dataset.id;
                if (this.decrementarCantidadPlato(platoId)) {
                    console.log(this);

                    // Actualizar la cantidad en el input correspondiente
                    const inputCantidad = btn_decrement.parentElement.querySelector('.input_cantidad_form');
                    inputCantidad.value = parseInt(inputCantidad.value) - 1;
                    this.actualizarCantidadInput(platoId, inputCantidad.value)
                    // Actualizar el contador de artículos
                    const cantidadArticulos = document.querySelector('.carrito');
                    cantidadArticulos.textContent = `Cantidad de Articulos: ${String(this.cant_articulos).padStart(2, '0')}`;
                } else {
                    console.log(`ya no se puede seguir decrementando`);
                }
            });
        });
    }
    

}