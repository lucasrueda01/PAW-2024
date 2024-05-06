
class ServicioRestaurante {
    constructor() {
        this.asientosBarraDisponibles = 10; // Número de asientos disponibles en la barra
        this.clientesBarra = []; // Array para almacenar los clientes que están en la barra
        this.mesasDisponibles = 5; // Número de mesas disponibles
        this.clientesMesas = new Map(); // Mapa para almacenar los clientes asignados a cada mesa
        this.locales = new Map(); // Mapa para almacenar la información de los locales
        this.reservas = []; // Array para almacenar todas las reservas
    }

    getArrayLocales() {
        return this.locales;    // Array para almacenar Locales
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
        // const nombreLocal = "Local A";
        // const fecha = "2024-05-01";
        // const hora = "12:00";

        if (localValue !== null && dateValue !== null && timeValue !== null) {
        // if (nombreLocal !== null && fecha !== null && hora !== null) {
            console.log(`Estado de las mesas en el local ${localValue} el ${dateValue} a las ${timeValue}`);
            const estadoMesas = this.obtenerEstadoMesas(localValue, dateValue, timeValue);
            // const estadoMesas = this.obtenerEstadoMesas(nombreLocal, fecha, hora);
            this.marcarMesas(estadoMesas);
        }else{
            console.log(`localValue: ${localValue}, dateValue: ${dateValue}, timeValue: ${timeValue}`)
        }

    }

    marcarMesas(estadoMesas) {
        // Iterar sobre el mapa estadoMesas
        estadoMesas.forEach((estado, nombreMesa) => {
            // Obtener el elemento de la mesa con el nombre correspondiente
            console.log(`#${nombreMesa} .mesa // estado: ${estado}`);
            var groupMesaElemento = document.querySelector(`#${nombreMesa}`);
            var mesaElemento = document.querySelector(`#${nombreMesa} .mesa`);
            
            // Verificar si la mesa está ocupada o disponible y aplicar el color correspondiente
            if (mesaElemento) {
                if (estado === 'Ocupada') {
                    console.log(mesaElemento);
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
            console.log(groupMesaElemento)
            let inputHiddenMesaSeleccionada = document.querySelector(`#nromesa-elegida`);
            inputHiddenMesaSeleccionada.value = groupMesaElemento.id;
            mesaElemento.style.fill = "red";
            console.log(`inputHiddenMesaSeleccionada.value: ${inputHiddenMesaSeleccionada.value}`)
        })
    }

    cargarMesasDesdeLocal(locales)
    {
                // Iterar sobre cada local y sus mesas
                locales.forEach(local => {
                    const nombreLocal = local.nombre;
                    // console.log(`${local.nombre}, ${local.horaApertura}, ${local.horaCierre}`)
                    this.agregarLocal(local.nombre, local.horaApertura, local.horaCierre);
                    // console.log("verificacion despues de insercion: "+this.locales.has(local.nombre));

                    const mesas = local.mesas;
    
                    // Iterar sobre cada mesa del local
                    mesas.forEach(mesa => {
                        const nombreMesa = mesa.nombre_mesa;
                        const ocupada = mesa.ocupada;
                        const fechaReserva = mesa.fecha_reserva;
                        const horaReserva = mesa.hora_reserva;
    
                        // Si la mesa está ocupada, agregarla como reserva
                        if (ocupada) {
                            const horaInicioReserva = new Date(`${fechaReserva}T${horaReserva}`);
                            const horaFinReserva = new Date(horaInicioReserva.getTime() + (1.5 * 60 * 60 * 1000)); // 1.5 horas en milisegundos
                            // this.reservas.push({ nombreMesa, horaInicioReserva, horaFinReserva });
                            this.reservas.push({ nombreMesa, horaInicio: horaInicioReserva, horaFin: horaFinReserva });
                        }
                        this.locales.get(nombreLocal).mesas.push(mesa);
                    });
                });
                // console.log("verificacion 2 despues de insercion: "+this.locales.has("Local A"));        
    }

    cargarMesasDesdeJSON() {
        try {
            fetch('/local/mesas', {
                method: 'GET'
            }) 
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al obtener las mesas');
                }
                return response.json(); // Esta línea ya convierte la respuesta en un objeto JSON
            })
            .then(data => {
                // console.log(data);
    
                // Iterar sobre cada local y sus mesas
                data.locales.forEach(local => {
                    const nombreLocal = local.nombre;
                    console.log(`${local.nombre}, ${local.horaApertura}, ${local.horaCierre}`)
                    this.agregarLocal(local.nombre, local.horaApertura, local.horaCierre);
                    console.log("verificacion despues de insercion: "+this.locales.has(local.nombre));

                    const mesas = local.mesas;
    
                    // Iterar sobre cada mesa del local
                    mesas.forEach(mesa => {
                        const nombreMesa = mesa.nombre_mesa;
                        const ocupada = mesa.ocupada;
                        const fechaReserva = mesa.fecha_reserva;
                        const horaReserva = mesa.hora_reserva;
    
                        // Si la mesa está ocupada, agregarla como reserva
                        if (ocupada) {
                            const horaInicioReserva = new Date(`${fechaReserva}T${horaReserva}`);
                            const horaFinReserva = new Date(horaInicioReserva.getTime() + (1.5 * 60 * 60 * 1000)); // 1.5 horas en milisegundos
                            this.reservas.push({ nombreMesa, horaInicioReserva, horaFinReserva });
                        }
                        this.locales.get(nombreLocal).mesas.push(mesa);
                    });
                });
                console.log("verificacion 2 despues de insercion: "+this.locales.has("Local A"));
                // console.log('Reservas cargadas exitosamente desde el archivo JSON:', this.reservas);
            })
            .catch(error => {
                console.error('Error al obtener las mesas:', error);
            });             
        } catch (error) {
            console.error('Error al cargar las mesas desde el archivo JSON:', error);
        }
    }
    // Método para agregar un local con su horario de apertura y cierre
    agregarLocal(nombreLocal, horaApertura, horaCierre) {
        this.locales.set(nombreLocal, { horaApertura, horaCierre, mesas: [] });
    }

    // Método para agregar un cliente a una mesa
    agregarClienteMesa(nombreCliente, nombreMesa, nombreLocal, fecha, hora) {
        // Verificar si el local está registrado
        if (!this.locales.has(nombreLocal)) {
            console.log(`El local ${nombreLocal} no está registrado.`);
            return;
        }

        // Obtener el horario de apertura y cierre del local
        const horarioLocal = this.locales.get(nombreLocal);
        const horaApertura = horarioLocal.horaApertura;
        const horaCierre = horarioLocal.horaCierre;

        // Validar si la fecha es válida
        if (!this.esFechaValida(fecha)) {
            console.log(`La fecha ${fecha} no es válida.`);
            return;
        }

        // Validar si la hora es válida y está dentro del horario de funcionamiento del local
        if (!this.esHoraValida(hora) || !this.estaEnHorario(hora, horaApertura, horaCierre)) {
            console.log(`La hora ${hora} no es válida para el local ${nombreLocal}.`);
            return;
        }

        // Calcular la hora y fecha de finalización de la reserva
        const horaInicioReserva = new Date(`${fecha}T${hora}`);
        const horaFinReserva = new Date(horaInicioReserva.getTime() + (1.5 * 60 * 60 * 1000)); // 1.5 horas en milisegundos

        // Verificar si la mesa está disponible en el momento dado
        if (this.mesaEstaDisponible(nombreMesa, horaInicioReserva, horaFinReserva)) {
            // Resto del código para agregar el cliente a la mesa...
            this.reservas.push({ nombreMesa, horaInicio: horaInicioReserva, horaFin: horaFinReserva });
            console.log(`${nombreCliente} se ha sentado en la mesa ${nombreMesa} del local ${nombreLocal} a las ${hora} del día ${fecha}.`);
        } else {
            console.log(`La mesa ${nombreMesa} del local ${nombreLocal} no está disponible en el horario solicitado.`);
        }

    }

    // Método para obtener el estado de todas las mesas dado un local, fecha y hora
    obtenerEstadoMesas(nombreLocal, fecha, hora) {

        console.log(this.getArrayLocales());

        console.log(this.locales.has(nombreLocal));
        // Verificar si la local está registrado        
        if (!this.locales.has(nombreLocal)) {
            console.log(`El local ${nombreLocal} no est1á registrado.`);
            return;
        }else{
            console.log(`El local ${nombreLocal} ESTA registrado.`);
        }

        // Validar si la fecha es válida
        if (!this.esFechaValida(fecha)) {
            console.log(`La fecha ${fecha} no es válida.`);
            return;
        }else{
            console.log(`La fecha ${fecha} ES válida.`);
        }

        // Validar si la hora es válida
        if (!this.esHoraValida(hora)) {
            console.log(`La hora ${hora} no es válida.`);
            return;
        }else{
            console.log(`La hora ${hora} ES válida.`);
        }

        const mesasLocal = this.locales.get(nombreLocal).mesas;
        const estadoMesas = new Map();

        // Verificar el estado de cada mesa
        if (Array.isArray(mesasLocal)) {
            // Si mesasLocal es un array
            for (const mesa of mesasLocal) {
                const nombreMesa = mesa.nombre_mesa;
                const disponible = this.mesaEstaDisponible(nombreMesa, fecha, hora);
                estadoMesas.set(nombreMesa, disponible ? 'Disponible' : 'Ocupada');
            }
        } else if (mesasLocal instanceof Map) {
            // Si mesasLocal es un objeto Map
            for (const [nombreMesa, mesa] of mesasLocal) {
                const disponible = this.mesaEstaDisponible(nombreMesa, fecha, hora);
                estadoMesas.set(nombreMesa, disponible ? 'Disponible' : 'Ocupada');
            }
        } else {
            console.log(`Error: mesasLocal no es un array ni un objeto Map.`);
            return;
        }

        return estadoMesas;
    }

    // Método para verificar si una mesa está disponible en un momento dado
    mesaEstaDisponible(nombreMesa, fecha, hora) {
        // Calcular la hora y fecha de finalización de la reserva
        const horaInicioReserva = new Date(`${fecha}T${hora}`);
        const horaFinReserva = new Date(horaInicioReserva.getTime() + (1.5 * 60 * 60 * 1000)); // 1.5 horas en milisegundos

        // Verificar si hay alguna reserva para la mesa en el momento dado
        for (const reserva of this.reservas) {
            if (reserva.nombreMesa === nombreMesa) {
                // Verificar si la reserva se solapa con el rango de tiempo
                console.log(`horaInicioReserva: ${horaInicioReserva} < reserva.horaFin ${reserva.horaFin} //
                // horaFinReserva: ${horaFinReserva} > reserva.horaInicio ${reserva.horaInicio}`)
                if (horaInicioReserva < reserva.horaFin && horaFinReserva > reserva.horaInicio) {
                    return false; // La mesa está ocupada en el momento solicitado
                }
            }
        }
        return true; // La mesa está disponible en el momento solicitado
    }
    
    // Método para validar si la hora está dentro del horario de apertura y cierre del local
    estaEnHorario(hora, horaApertura, horaCierre) {
        return hora >= horaApertura && hora <= horaCierre;
    }
    
    // Método para validar si la fecha es válida
    esFechaValida(fecha) {
        // Comprobar si la fecha tiene el formato 'YYYY-MM-DD'
        const regexFecha = /^\d{4}-\d{2}-\d{2}$/;
        if (!regexFecha.test(fecha)) {
            return false;
        }

        // Comprobar si la fecha es una fecha válida utilizando el objeto Date de JavaScript
        const partesFecha = fecha.split('-');
        const anio = parseInt(partesFecha[0]);
        const mes = parseInt(partesFecha[1]);
        const dia = parseInt(partesFecha[2]);
        const fechaValidada = new Date(anio, mes - 1, dia); // Meses en JavaScript van de 0 a 11
        return fechaValidada.getFullYear() === anio &&
            fechaValidada.getMonth() === mes - 1 &&
            fechaValidada.getDate() === dia;
    }

    // Método para validar si la hora es válida
    esHoraValida(hora) {
        // Comprobar si la hora tiene el formato 'HH:mm'
        const regexHora = /^([01]?[0-9]|2[0-3]):[0-5][0-9]$/;
        if (!regexHora.test(hora)) {
            return false;
        }

        // Comprobar si la hora es una hora válida
        const partesHora = hora.split(':');
        const horas = parseInt(partesHora[0]);
        const minutos = parseInt(partesHora[1]);
        return horas >= 0 && horas < 24 && minutos >= 0 && minutos < 60;
    }
}
