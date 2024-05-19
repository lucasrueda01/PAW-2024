class Cart {
    constructor(cookieName = 'platos') {
        this.cookieName = cookieName;
    }

    setCookie(name, value, days) {
        const d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${d.toUTCString()}`;
        document.cookie = `${name}=${value}; ${expires}; path=/`;
        console.log(document.cookie);
    }

    getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    addToCart(plateId, cantidad = 1) {
        let plates = JSON.parse(this.getCookie(this.cookieName) || '[]');
        const plateIndex = plates.findIndex(plate => plate.id === plateId);

        if (plateIndex === -1) {
            plates.push({ id: plateId, cantidad: cantidad });
        } else {
            plates[plateIndex].cantidad += cantidad;
        }

        this.setCookie(this.cookieName, JSON.stringify(plates), 7);
    }

    updateCarrito(data, table) {

        // Limpiar el cuerpo de la tabla
        const tbody = table.querySelector('tbody');
        tbody.innerHTML = '';

        // Recorrer los datos devueltos y agregar filas a la tabla
        data.forEach(plato => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>$ ${plato.nombre_plato}</td>
                <td>$ ${plato.ingredientes}</td>
                <td>$ ${plato.precio}</td>
                <td>$ ${plato.cantidad}</td>
                <td>
                    <a href="#" class="remove-from-cart boton boton_negro_carrito" data-id="${plato.id}">-</a>
                </td>
            `;

            // Obtener el botón de la fila
            const boton = row.querySelector('.remove-from-cart');

            // Agregar evento clic al botón
            boton.addEventListener('click', (event) => {
                event.preventDefault();
                const platoId = event.target.getAttribute('data-id');
                console.log(platoId);
                this.removeFromCart(platoId);
            });

            // Agregar fila a la tabla
            tbody.appendChild(row);
        });

        // Calcular y mostrar el total
        const total = data.reduce((acc, plato) => acc + plato.precio * plato.cantidad, 0);
        console.log(total);
        const tfoot = table.querySelector('tfoot tr td');
        tfoot.textContent = `Total: $ ${total}`;
    }

    removeFromCart(platoId) {
        // Obtener la lista de platos de la cookie
        const platosCookie = this.getCookie(this.cookieName);

        // Verificar si la cookie existe y tiene datos
        if (platosCookie) {
            // Convertir la cookie a un array de objetos
            let plates = JSON.parse(platosCookie);

            // Encontrar el índice del plato en la lista de IDs
            const plateIndex = plates.findIndex(plate => plate.id == platoId);

            // Verificar si el plato existe en la lista
            if (plateIndex !== -1) {
                // Eliminar el plato de la lista
                plates.splice(plateIndex, 1);

                // Actualizar la cookie con la nueva lista de platos
                this.setCookie(this.cookieName, JSON.stringify(plates), 7);

                // Actualizar el carrito después de eliminar el plato
                this.updateCart();
            }
        }
    }

    updateCart() {
        // Realizar una solicitud fetch para obtener los detalles de los platos
        fetch('/plato-all-in-cart?lista_encoded=' + encodeURIComponent(this.getCookie(this.cookieName)))
            .then(response => response.json())
            .then(data => {
                // Obtener la tabla del carrito
                const table = document.querySelector('table');
                console.log(data)
                // Llamar al método updateCarrito para actualizar la tabla
                this.updateCarrito(data, table);
            })
            .catch(error => {
                console.error('Error en la solicitud de platos-en-carrito: ' + error);
            });
    }
}
