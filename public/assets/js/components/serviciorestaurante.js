
/**
 * clase que se encarga de manejar el llenado del formulario
 * para reservar una mesa. 
 */
class ServicioRestaurante {
    constructor() {
        /**
         * Mapa para almacenar la información de los locales
         */
        this.locales = Datos.locales; 
        /**
         * inicializo para el caso q el cliente se arrepiente 
         * de la mesa elegida y cliquea otra. En cuyo caso,
         * guardo el Id de la anterior para volverlo a marcar con azul
         *  */ 
        this.mesaElegida = "";
    }

    /**
     * agrego un evento click a cada input
     * local, fecha y hora
     * cuando cambian controlo q 
     * hayan cambiado todas, en caso
     * verdadero ejecuto la busqueda de mesas 
     * por local, fecha y hora
     */
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

    /**
     * 
     * @param {string} localValue 
     * @param {date} dateValue 
     * @param {time} timeValue 
     */
    buscarMesasSiTodosCambiaron(localValue, dateValue, timeValue) 
    {
        
        if (localValue !== null && dateValue !== null && timeValue !== null) {
            /* debo formatear la fecha porque viene con guiones 
            * y lo paso a / ejeplo: 2024-05-06 => 2024/05/06
            */
            dateValue = this.formatearFecha(dateValue);
        
            // console.log(`Estado de las mesas en el local ${localValue} el ${dateValue} a las ${timeValue}`);
            // const estadoMesas = this.obtenerMesasReservadasYDisponibles(localValue, dateValue, timeValue);
            const estadoMesas = this.buscarMesas(localValue, dateValue, timeValue);
            // console.log(estadoMesas);
            this.marcarMesas(estadoMesas.mesasReservadas, "Ocupada");
            this.marcarMesas(estadoMesas.mesasDisponibles, "Disponible");
        }else{
            console.log(`localValue: ${localValue}, dateValue: ${dateValue}, timeValue: ${timeValue}`)
        }
    }

    /**
     * 
     * @param {date} cadenaFecha 
     * @returns {date} la fecha formateada
     */
    formatearFecha(cadenaFecha)
    {
        // Verifica si la cadena de fecha contiene un guion "-"
        if (cadenaFecha.includes('-')) {
            // Reemplaza los guiones "-" por barras "/"
            cadenaFecha = cadenaFecha.replace(/-/g, '/');
        }
        return cadenaFecha;
    }

    /**
     * Función para obtener mesas reservadas y disponibles en un local, fecha y hora específicos
     * @param {string} local 
     * @param {date} fecha 
     * @param {time} hora 
     * @returns {array, array} mesas reservadas y disponibles
     */
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

    /**
     * 
     * @param {array} listadoMesas 
     * @param {string} estado 
     */
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

    /**
     * por cada mesa, la funcion recibe el div G 
     * y el Id del elemento q representa el grafico dentro del 
     * plano svg
     * @param {HTML Element} groupMesaElemento, 
     * agrega un evento clic a cada mesa disponible
     * @param {string} mesaElemento 
     * se usa para colorear de rojo las ocupadas
     */
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

    /**
     * 
     * @param {string} local 
     * @param {date} fecha 
     * @param {time} hora 
     * @returns {array, array} mesas disponibles y ocupadas 
     * de acuerdo al local, fecha y hora elegidos
     */
    buscarMesas(local, fecha, hora) {
        if (this.locales[local]) {
            let mesasDisponibles = [];
            let mesasOcupadas = [];
    
            if (this.locales[local][fecha]) {
                let mesasDelLocal = this.locales[local].mesa;
                for (let mesa of mesasDelLocal) {
                    if (this.locales[local][fecha][mesa]) {
                        let reservasMesa = this.locales[local][fecha][mesa];
                        let disponible = true;
                        for (let reserva of reservasMesa) {
                            let inicioReserva = new Date('1970-01-01T' + reserva.horaInicio);
                            let finReserva = new Date('1970-01-01T' + reserva.horaFin);
                            let horaConsulta = new Date('1970-01-01T' + hora);
    
                            if (horaConsulta >= inicioReserva && horaConsulta < finReserva) {
                                disponible = false;
                                mesasOcupadas.push(mesa);
                                break;
                            }
                        }
    
                        if (disponible) {
                            mesasDisponibles.push(mesa);
                        }
                    } else {
                        mesasDisponibles.push(mesa);
                    }
                }
            } else {
                mesasDisponibles = this.locales[local].mesa;
            }
    
            return { mesasDisponibles: mesasDisponibles, mesasReservadas: mesasOcupadas };
        } else {
            return { mesasDisponibles: [], mesasReservadas: [] };
        }
    }    



}
