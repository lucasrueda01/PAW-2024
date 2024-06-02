
/**
 * clase que se encarga de manejar el llenado del formulario
 * para reservar una mesa. 
 */
class ServicioRestaurante {
   
    constructor() {
        /**
         * Mapa para almacenar la información de los locales
         */

        const data = new Datos()
        data.getLocales()
            .then(locales => {
                this.locales = locales;
                console.log(this.locales)
            })
            .catch(error => {
                console.error('Error al obtener los locales:', error);
            });
        /**
         * inicializo para el caso q el cliente se arrepiente 
         * de la mesa elegida y cliquea otra. En cuyo caso,
         * guardo el Id de la anterior para volverlo a marcar con azul
         *  */ 
        this.mesaElegida = "";
    }

    /**
     * metodo para cargar la informacion de las mesas
     */
    cargarLocales(){

        fetch("/locales/get")
            .then(response =>{
                if(!Response.ok) {
                    throw new Error('Error en la Respuesta ' + response.status)
                }
                return response.json()
            })
            .then(data => {
                console.log(data)
            })
            .catch(error => {
                console.error('Hubo un error en la solicitud' + error)
            })
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

        if(this.controlarLocalFechaYHora(localValue, dateValue, timeValue))
        {
            /* debo formatear la fecha porque viene con guiones 
            * y lo paso a / ejeplo: 2024-05-06 => 2024/05/06
            */
            dateValue = this.formatearFecha(dateValue);
        
            // console.log(`Estado de las mesas en el local ${localValue} el ${dateValue} a las ${timeValue}`);
            const estadoMesas = this.buscarMesas(localValue, dateValue, timeValue);
            // console.log(estadoMesas);
            this.marcarMesas(estadoMesas.mesasReservadas, "Ocupada");
            this.marcarMesas(estadoMesas.mesasDisponibles, "Disponible");
        }else{
            console.log(`localValue: ${localValue}, dateValue: ${dateValue}, timeValue: ${timeValue}`)
        }
    }

    controlarLocalFechaYHora(localValue, dateValue, timeValue)
    {   
        if (localValue !== null && dateValue !== null && timeValue !== null) 
        {
            if(this.locales[localValue]){
              if(this.comprobarFecha(dateValue)){
                 console.log("superado control de fecha")
                 if(this.comprobarHora(localValue, timeValue)){
                    console.log("superado control de horario")
                    console.log("todos los controles superados..");
                    return true;
                 }else{
                    this.marcarMesas(this.locales[localValue].mesa, "Reset");
                    console.log("fallo al comprobar hora");
                    return false;    
                }
               }else{
                    this.marcarMesas(this.locales[localValue].mesa, "Reset");
                    console.log("fallo al comprobar fecha");
                    return false;
               }
            }else{
                console.log("no existe local");
                return false;
            }
        }else{
            console.log("uno de los input nulo");
            return false;
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
     * 
     * @param {date} fecha 
     * @returns {boolean}
     */
    comprobarFecha(fechaInput) {
        // Obtener la fecha actual
        let fechaActual = new Date();
        // Sumar 7 días a la fecha actual
        let fechaLimite = new Date(fechaActual.getTime() + 7 * 24 * 60 * 60 * 1000);
        // Convertir la fecha a un formato comparable (sin incluir la hora)
        fechaActual.setHours(0, 0, 0, 0);
        fechaLimite.setHours(0, 0, 0, 0);

        console.log(`fechaInput-antes: ${fechaInput}`);
        let partesFecha = fechaInput.split('-');
        console.log(partesFecha);
        fechaInput = new Date(Date.UTC(partesFecha[0], partesFecha[1] - 1, partesFecha[2]));

        fechaInput = new Date(
            fechaInput.getUTCFullYear(),
            fechaInput.getUTCMonth(),
            fechaInput.getUTCDate()
        );
        
        console.log(`fechaActual: ${fechaActual}`);
        console.log(`fechaInput-despues: ${fechaInput}`);
        console.log(`fechaLimite: ${fechaLimite}`);

        // Verificar si la fecha está dentro del rango de 7 días a partir de hoy
        return fechaInput >= fechaActual && fechaInput <= fechaLimite;        
    }

    /**
     * 
     * @param {string} local 
     * @param {time} hora 
     * @returns {boolean}
     */
    comprobarHora(local, hora)
    {   
        console.log(`local: ${local}`);
        console.log(`hora: ${hora}`);
        console.log(`this.locales[local].horaApertura: ${this.locales[local].horaApertura}`);
        let horaApertura = new Date('1970-01-01T' + this.locales[local].horaApertura);
        let horaCierre = new Date('1970-01-01T' + this.locales[local].horaCierre);
        let horaConsulta = new Date('1970-01-01T' + hora);

        console.log(`horaApertura: ${horaApertura}`);
        console.log(`horaCierre: ${horaCierre}`);
        console.log(`horaConsulta: ${horaConsulta}`);

        // Verificar si la hora está dentro del rango de apertura y cierre del local
        if (horaConsulta >= horaApertura && horaConsulta <= horaCierre) {
            // Verificar el formato de la hora proporcionada
            if (/^(?:2[0-3]|[01][0-9]):[0-5][0-9]$/.test(hora)) {
                console.log("La hora está dentro del rango de apertura y cierre del local y tiene un formato válido");
                return true;  
            } else {
                console.log("La hora no tiene un formato válido");
                return false;  
            }
        } else {
            console.log("La hora está fuera del rango de apertura y cierre del local");
            return false; 
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
                }else if (estado === 'Reset'){
                    mesaElemento.style.fill = "#fff";
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
            console.log(`${this.mesaElegida}`);
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
