
/**
 * clase que se encarga de manejar el llenado del formulario
 * para reservar una mesa. 
 */
class ServicioRestaurante {
    static MAXIMO_PERMITIDO = 1;
    
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
        this.estadoMesas = []
        this.cantMesasElegidas = 0

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
            this.cantMesasElegidas = 0;
            this.buscarMesasSiTodosCambiaron(localValue, dateValue, timeValue);
        });

        date.addEventListener("change", () => {
            dateValue = date.value;
            this.cantMesasElegidas = 0;
            this.buscarMesasSiTodosCambiaron(localValue, dateValue, timeValue);
        });

        time.addEventListener("change", () => {
            timeValue = time.value;
            this.cantMesasElegidas = 0;
            this.buscarMesasSiTodosCambiaron(localValue, dateValue, timeValue);
        });

    }

    /**
     * si todos los input de local, fecha y hora cambiaron
     * @param {string} localValue 
     * @param {date} dateValue 
     * @param {time} timeValue 
     */
    buscarMesasSiTodosCambiaron(localValue, dateValue, timeValue) {
        if (this.controlarLocalFechaYHora(localValue, dateValue, timeValue)) {
            const dateValueConFormatoGuiones = dateValue;
            dateValue = this.formatearFecha(dateValue);
    
            console.log(`Estado de las mesas en el local ${localValue} el ${dateValueConFormatoGuiones} a las ${timeValue}`);
            
            this.buscarMesasEnElBack(localValue, dateValueConFormatoGuiones, timeValue)
                .then(estadoMesas => {
                    console.log(estadoMesas);
                    // Aquí puedes realizar cualquier operación que necesites con estadoMesas
                    // Por ejemplo, marcar las mesas según su estado
                    this.estadoMesas.mesasDisponibles = estadoMesas.mesasDisponibles
                    this.estadoMesas.mesasReservadas = estadoMesas.mesasReservadas

                    this.marcarMesas(estadoMesas.mesasDisponibles);
                    this.marcarMesas(estadoMesas.mesasReservadas);
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Manejar el error de la solicitud si es necesario
                });
        } else {
            console.log(`localValue: ${localValue}, dateValue: ${dateValue}, timeValue: ${timeValue}`);
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
                    this.cantMesasElegidas = ServicioRestaurante.MAXIMO_PERMITIDO
                    return false;    
                }
               }else{
                    this.marcarMesas(this.locales[localValue].mesa, "Reset");
                    this.cantMesasElegidas = ServicioRestaurante.MAXIMO_PERMITIDO
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
    marcarMesas(listadoMesas, estado=null) {
        // Iterar sobre el listado de mesas
        listadoMesas.forEach(item => {
            let idMesa, estadoMesa;
            if (estado === 'Reset') {
                // En caso de reinicio, el listadoMesas es un array de strings
                idMesa = item;
                estadoMesa = null; // Estado nulo
            } else {
                // En otro caso, listadoMesas es un array de objetos con propiedades específicas
                idMesa = item.nombre_mesa;
                estadoMesa = item.estado;
            }
    
            // Obtener el elemento de la mesa y su grupo correspondientes
            const groupMesaElemento = document.querySelector(`#${idMesa}`);
            const mesaElemento = document.querySelector(`#${idMesa} .mesa`);
            
            // Verificar si se debe marcar la mesa con un color específico
            if (estado !== 'Reset') {
                // Eliminar el oyente de evento de clic si existe
                groupMesaElemento.removeEventListener('click', this.agregarEventoClic);
                
                // Aplicar el color correspondiente a la mesa
                if (mesaElemento) {
                    if (estadoMesa === 'reservada') {
                        mesaElemento.style.fill = "red";
                    } else if (estadoMesa === 'disponible') {
                        mesaElemento.style.fill = "blue";
                        // Agregar el evento de clic
                        // groupMesaElemento.addEventListener('click', () => {
                        this.agregarEventoClic(groupMesaElemento, mesaElemento);
                        // });
                    }
                }
            } else {
                // Eliminar el oyente de evento de clic si existe
                groupMesaElemento.removeEventListener('click', this.agregarEventoClic);  
                console.log(`Se eliminó el evento de clic de la mesa ${groupMesaElemento.id}`)              
                // Marcar la mesa con blanco
                if (mesaElemento) {
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
    agregarEventoClic(groupMesaElemento, mesaElemento) {            
        console.log("Dentro de agregar eventoClic")
        groupMesaElemento.addEventListener("click", () => {
            const mesaReservada = this.estadoMesas.mesasReservadas.includes(groupMesaElemento.id);
            
            if (mesaReservada) {
                console.log('La mesa está reservada.');
                return; // No realizar más acciones si la mesa está reservada
            } 
            
            if (this.cantMesasElegidas >= ServicioRestaurante.MAXIMO_PERMITIDO) {
                console.log("Excedió el máximo número de mesas permitido");
                this.cantMesasElegidas = ServicioRestaurante.MAXIMO_PERMITIDO
                return; // No realizar más acciones si se excede el máximo número de mesas
            }
            
            console.log(`this.cantMesasElegidas: ${this.cantMesasElegidas}`)
            if(this.cantMesasElegidas < ServicioRestaurante.MAXIMO_PERMITIDO ){
                // Marcar la mesa como seleccionada (roja)
                mesaElemento.style.fill = "red";
        
                // Actualizar la mesa seleccionada
                let inputHiddenMesaSeleccionada = document.querySelector(`#nromesa-elegida`);
                console.log(`Cambio inputHiddenMesaSeleccionada ${inputHiddenMesaSeleccionada}`)
                inputHiddenMesaSeleccionada.value = groupMesaElemento.id;
                this.mesaElegida = groupMesaElemento.id;
        
                // Incrementar el contador de mesas elegidas
                this.cantMesasElegidas++;
        
                console.log(`Mesa seleccionada: ${this.mesaElegida}`);
            }
        });
    }
    

    /**
     * 
     * @param {string} local 
     * @param {date} fecha 
     * @param {time} hora 
     * @returns {array, array} mesas disponibles y ocupadas 
     * de acuerdo al local, fecha y hora elegidos
     */
    buscarMesasEnElBack(local, fecha, hora) {
        // Codificar el nombre del local
        const localCodificado = encodeURIComponent(local).toLowerCase();
    
        // Generar la URL con los parámetros
        const url = `/get-reservas?local=${localCodificado}&fecha=${fecha}&hora=${hora}`;
        
        console.log(url);
        
        // Realizar la solicitud GET
        return fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error fetching data: ' + response.statusText);
                }
                return response.json();
            })
            .catch(error => {
                console.error('Error:', error);
                return { mesasDisponibles: [], mesasReservadas: [] };
            });
    }
    buscarMesas(local, fecha, hora) {
        if (this.locales[local]) {
            let mesasDisponibles = [];
            let mesasOcupadas = [];
            console.log("Encontre Local..")
            console.log(`Fecha..${fecha}`)
            if (this.locales[local][fecha]) {
                let mesasDelLocal = this.locales[local].mesa;
                console.log("Encontre mesasDelLocal:")
                console.log(mesasDelLocal)                
                for (let mesa of mesasDelLocal) {
                    if (this.locales[local][fecha][mesa]) {
                        let reservasMesa = this.locales[local][fecha][mesa];
                        console.log("Encontre Reservas:")
                        console.log(reservasMesa)
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
