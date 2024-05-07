

class ServicioRestaurante {
    constructor() {

        this.locales = Datos.locales2; // Mapa para almacenar la información de los locales
        
        this.mesaElegida = "";
    }

    cargarFormularioYComprobar() {

        let localValue = null;
        let dateValue = null;
        let timeValue = null;
    
        let local = document.querySelector("#local");
        let date = document.querySelector("#date");
        let time = document.querySelector("#time");

        local.addEventListener("change", () => {
            localValue = local.value;
            this.buscarMesasSiTodosCambiaron(localValue, dateValue, timeValue);
        });

        date.addEventListener("change", () => {
            dateValue = date.value;
            this.buscarMesasSiTodosCambiaron(localValue, dateValue, timeValue);
        });

        time.addEventListener("change", () => {
            timeValue = time.value;
            this.buscarMesasSiTodosCambiaron(localValue, dateValue, timeValue);
        });

    }


    buscarMesasSiTodosCambiaron(localValue, dateValue, timeValue) 
    {
        
        if (localValue !== null && dateValue !== null && timeValue !== null) {
            /* debo formatear la fecha porque viene con guiones 
            * y lo paso a / ejeplo: 2024-05-06 => 2024/05/06
            */
            dateValue = this.formatearFecha(dateValue);
        
            // console.log(`Estado de las mesas en el local ${localValue} el ${dateValue} a las ${timeValue}`);
            const estadoMesas = this.obtenerMesasReservadasYDisponibles(localValue, dateValue, timeValue);
            // console.log(estadoMesas);
            this.marcarMesas(estadoMesas.mesasReservadas, "Ocupada");
            this.marcarMesas(estadoMesas.mesasDisponibles, "Disponible");
        }else{
            console.log(`localValue: ${localValue}, dateValue: ${dateValue}, timeValue: ${timeValue}`)
        }

    }

    marcarMesas(listadoMesas, estado) {
        // Iterar sobre el mapa estadoMesas
        // console.log(listadoMesas);

        listadoMesas.forEach(nombreMesa => {
            // Obtener el elemento de la mesa con el nombre correspondiente
            // console.log(`#${nombreMesa} .mesa // estado: ${estado}`);
            var groupMesaElemento = document.querySelector(`#${nombreMesa}`); // selecciono el group q identifica a la mesa
            var mesaElemento = document.querySelector(`#${nombreMesa} .mesa`); // selecciono el circulo q identifica la mesa
            
            // Verificar si la mesa está ocupada o disponible y aplicar el color correspondiente
            if (mesaElemento) {
                if (estado === 'Ocupada') {
                    // Marcar la mesa como roja si está ocupada
                    mesaElemento.style.fill = "red";
                } else if (estado === 'Disponible') {
                    // Marcar la mesa como azul si está disponible
                    mesaElemento.style.fill = "blue";
                    this.agregarEventoClic(groupMesaElemento, mesaElemento);
                }
            }
        });
    } 

    agregarEventoClic(groupMesaElemento, mesaElemento)
    {            
        groupMesaElemento.addEventListener("click", () => {
            if (this.mesaElegida !== "") {
                let anteriorMesaSeleccionada = document.querySelector(`#${this.mesaElegida} .mesa`);
                anteriorMesaSeleccionada.style.fill = "blue"; // VUELVO A COLOREARLA COMO DISPONIBLE
            }
            mesaElemento.style.fill = "red";
            let inputHiddenMesaSeleccionada = document.querySelector(`#nromesa-elegida`);
            inputHiddenMesaSeleccionada.value = groupMesaElemento.id;
            this.mesaElegida = groupMesaElemento.id;
        })
        
    }

    formatearFecha(cadenaFecha)
    {
        // Verifica si la cadena de fecha contiene un guion "-"
        if (cadenaFecha.includes('-')) {
            // Reemplaza los guiones "-" por barras "/"
            cadenaFecha = cadenaFecha.replace(/-/g, '/');
        }
        return cadenaFecha;
    }

    // Función para obtener mesas reservadas y disponibles en un local, fecha y hora específicos
    obtenerMesasReservadasYDisponibles(local, fecha, hora) {

        if (this.locales[local] && this.locales[local][fecha] && this.locales[local][fecha][hora]) {
            let mesasLocal = this.locales[local].mesa; // Obtener las mesas del local
            let mesasReservadas = this.locales[local][fecha][hora] || []; // Obtener las mesas reservadas para la hora, fecha y local proporcionados
            let mesasDisponibles = mesasLocal.filter(mesa => !mesasReservadas.includes(mesa)); // Obtener las mesas disponibles restando las mesas reservadas

            return {
                mesasReservadas: mesasReservadas,
                mesasDisponibles: mesasDisponibles
            };
        } else {
            return {
                mesasReservadas: [],
                mesasDisponibles: this.locales[local].mesa
            };
        }
    }


}
