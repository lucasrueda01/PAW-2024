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

    getCantidadPlato(platoId) {
        // Obtener la lista de platos de la cookie
        const platosCookie = this.getCookie(this.cookieName);
    
        // Verificar si la cookie existe y tiene datos
        if (platosCookie) {
            // Convertir la cookie a un array de objetos
            const plates = JSON.parse(platosCookie);
    
            // Encontrar el plato en la lista de platos
            
            const plate = plates.find(plate => parseInt(plate.id) === parseInt(platoId));
    
            // Retornar la cantidad del plato o 0 si no se encuentra
            return plate ? plate.cantidad : 0;
        }
    
        return 0;
    }

    

    updateCarrito(data, table) {
        // Limpiar el cuerpo de la tabla
        const tbody = table.querySelector('tbody');
        tbody.innerHTML = '';
    
        // Recorrer los datos devueltos y agregar filas a la tabla
        data.forEach(plato => {
        // Obtener la cantidad del plato de la cookie
            console.log(`plato.id : ${plato.id}`)
            const cantidadPlato = this.getCantidadPlato(plato.id);            

            const row = document.createElement('tr');
            row.innerHTML = `
                <td data-label="Nombre">${plato.nombre_plato}</td>
                <td data-label="Descripción">${plato.ingredientes}</td>
                <td data-label="Precio">$${plato.precio}</td>
                <td data-label="Cantidad">${cantidadPlato}</td>
                <td data-label="Acción">
                    <a href="#" class="remove-from-cart boton boton_negro_carrito" data-id="${plato.id}">Eliminar</a>
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
        const total = data.reduce((acc, plato) => acc + plato.precio * parseInt(this.getCantidadPlato(plato.id)), 0);
        console.log(total);
        const tfoot = table.querySelector('tfoot tr td');
        tfoot.textContent = `Total: $${total}`;
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

    mostrarCarritoActual()
    {
        // Obtener la cookie y parsear los datos
        const cookieData = JSON.parse(this.getCookie(this.cookieName));

        // Calcular la cantidad total de artículos en el carrito
        const totalArticulos = cookieData.reduce((total, plato) => total + plato.cantidad, 0);

        // Actualizar el contenido del elemento con clase "carrito"
        const carritoElement = document.querySelector('.carrito');
        carritoElement.textContent = `Cantidad de Articulos: ${totalArticulos}`;        
    }

    updateCart() {
        // const plato = JSON.parse(this.getCookie(this.cookieName))
        // console.log(`plato`)
        // console.log(`${plato[0].cantidad}`)
        // Realizar una solicitud fetch para obtener los detalles de los platos
        fetch('/plato-all-in-cart?lista_encoded=' + encodeURIComponent(this.getCookie(this.cookieName)))
            .then(response => response.json())
            .then(data => {
                // Obtener la tabla del carrito
                const table = document.querySelector('table');
                // console.log('data[0].id')
                // console.log(data[0].id)
                // Llamar al método updateCarrito para actualizar la tabla
                this.updateCarrito(data, table);
            })
            .catch(error => {
                console.error('Error en la solicitud de platos-en-carrito: ' + error);
            });
    }
}
