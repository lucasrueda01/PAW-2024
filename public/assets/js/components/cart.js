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
                    <button onclick="removeFromCart(${plato.id})">-</button>
                </td>
            `;
            tbody.appendChild(row);
        });

        // Calcular y mostrar el total
        const total = data.reduce((acc, plato) => acc + plato.precio, 0);
        const tfoot = table.querySelector('tfoot tr td');
        tfoot.textContent = `Total: $ ${total}`;
    }




}