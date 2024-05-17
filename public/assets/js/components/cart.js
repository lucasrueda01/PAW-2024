class Cart {
    constructor(cookieName = 'platos') {
        this.cookieName = cookieName;
    }

    setCookie(name, value, days) {
        const d = new Date();
        d.setTime(d.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${d.toUTCString()}`;
        document.cookie = `${name}=${value}; ${expires}; path=/`;
        console.log(document.cookie)
    }

    getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
        return null;
    }

    addToCart(plateId) {
        let plates = JSON.parse(this.getCookie(this.cookieName) || '[]');
        if (!plates.includes(plateId)) {
            plates.push(plateId);
            this.setCookie(this.cookieName, JSON.stringify(plates), 7);
        }
    }
    updateCarrito(data, table) {
        // Limpiar el cuerpo de la tabla
        const tbody = table.querySelector('tbody');
        tbody.innerHTML = '';

        // Recorrer los datos devueltos y agregar filas a la tabla
        data.forEach(plato => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${plato.nombre_plato}</td>
                <td>${plato.ingredientes}</td>
                <td>${plato.precio}</td>
                <td>
                    <button type="button" class="remove-from-cart" value="${plato.id}">-</button>
                </td>
            `;
        
            // Obtener el botón de la fila
            const boton = row.querySelector('.remove-from-cart');
        
            // Agregar evento clic al botón
            boton.addEventListener('click', () => {
                const platoId = this.value;
                this.removeFromCart(platoId);
            });
        
            // Agregar fila a la tabla
            tbody.appendChild(row);
        });

        // Calcular y mostrar el total
        const total = data.reduce((acc, plato) => acc + plato.precio, 0);
        const tfoot = table.querySelector('tfoot tr td');
        tfoot.textContent = `Total: $ ${total}`;
    }


    removeFromCart(platoId) {
        // Obtener la lista de platos de la cookie
        const platosCookie = this.getCookie('platos');
    
        // Verificar si la cookie existe y tiene datos
        if (platosCookie) {
            // Convertir la cookie a un array de IDs de platos
            let platosIds = JSON.parse(platosCookie);
    
            // Encontrar el índice del plato en la lista de IDs
            const index = platosIds.indexOf(platoId);
    
            // Verificar si el plato existe en la lista
            if (index !== -1) {
                // Eliminar el plato de la lista
                platosIds.splice(index, 1);
    
                // Actualizar la cookie con la nueva lista de platos
                this.setCookie('platos', JSON.stringify(platosIds), 7);
    
                // Actualizar el carrito después de eliminar el plato
                this.updateCart();
            }
        }
    }

    updateCart() {
        // Realizar una solicitud fetch para obtener los detalles de los platos
        fetch('/plato-all-in-cart?lista_encoded=' + encodeURIComponent(this.getCookie('platos')))
            .then(response => response.json())
            .then(data => {
                // Obtener la tabla del carrito
                const table = document.querySelector('table');
    
                // Llamar al método updateCarrito para actualizar la tabla
                this.updateCarrito(data, table);
            })
            .catch(error => {
                console.error('Error en la solicitud de platos-en-carrito: ' + error);
            });
    }

}