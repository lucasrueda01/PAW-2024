class appPAW {
	constructor() {
        
        document.addEventListener("DOMContentLoaded", () => {
        PAW.cargarScript("Datos", "/assets/js/components/datos.js");
		PAW.cargarScript("ServicioRestaurante", "/assets/js/components/serviciorestaurante.js", () => {	

            // const datos = new Datos();

            const servicioRestaurante = new ServicioRestaurante();

            // console.log(servicioRestaurante)

            // const mesasLocal = servicioRestaurante.cargarMesasDesdeLocal(datos.getLocales());
            let local = "Local A";
            let fecha = "2024/05/06";
            let hora = "13:30";

            let mesas = servicioRestaurante.obtenerMesasReservadasYDisponibles(local, fecha, hora);

            console.log(mesas)
            servicioRestaurante.cargarFormularioYComprobar()

            });
		}
        );
    }
}

let app = new appPAW();
