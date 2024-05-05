class ServicioRestaurante {
    constructor() {
        this.asientosBarraDisponibles = 10; // Número de asientos disponibles en la barra
        this.clientesBarra = []; // Array para almacenar los clientes que están en la barra
        this.mesasDisponibles = 5; // Número de mesas disponibles
        this.clientesMesas = new Map(); // Mapa para almacenar los clientes asignados a cada mesa
        this.locales = new Map(); // Mapa para almacenar la información de los locales
        this.reservas = []; // Array para almacenar todas las reservas
    }

    // Método para agregar un local con su horario de apertura y cierre
    agregarLocal(nombreLocal, horaApertura, horaCierre) {
        this.locales.set(nombreLocal, { horaApertura, horaCierre });
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
        // Verificar si la local está registrado
        if (!this.locales.has(nombreLocal)) {
            console.log(`El local ${nombreLocal} no está registrado.`);
            return;
        }

        // Validar si la fecha es válida
        if (!this.esFechaValida(fecha)) {
            console.log(`La fecha ${fecha} no es válida.`);
            return;
        }

        // Validar si la hora es válida
        if (!this.esHoraValida(hora)) {
            console.log(`La hora ${hora} no es válida.`);
            return;
        }

        const mesasLocal = this.locales.get(nombreLocal).mesas;
        const estadoMesas = new Map();

        // Verificar el estado de cada mesa
        for (const mesa of mesasLocal) {
            const nombreMesa = mesa.nombre_mesa;
            const disponible = this.mesaEstaDisponible(nombreMesa, fecha, hora);
            estadoMesas.set(nombreMesa, disponible ? 'Disponible' : 'Ocupada');
        }

        return estadoMesas;
    }


    // Método para verificar si una mesa está disponible en un momento dado
    mesaEstaDisponible(nombreMesa, horaInicioReserva, horaFinReserva) {
        // Verificar si hay alguna reserva para la mesa en el momento dado
        for (const reserva of this.reservas) {
            if (reserva.nombreMesa === nombreMesa) {
                // Verificar si la reserva se solapa con el rango de tiempo de la nueva reserva
                if ((horaInicioReserva < reserva.horaFin && horaFinReserva > reserva.horaInicio)) {
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
