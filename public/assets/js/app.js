class appPAW {
	constructor() {
        
        document.addEventListener("DOMContentLoaded", () => {
        PAW.cargarScript("Datos", "/assets/js/components/datos.js");
		PAW.cargarScript("ServicioRestaurante", "/assets/js/components/serviciorestaurante.js", () => {	

            const datos = new Datos();

            const servicioRestaurante = new ServicioRestaurante();

            const mesasLocal = servicioRestaurante.cargarMesasDesdeLocal(datos.getLocales());

            servicioRestaurante.cargarFormularioYComprobar()

            });
		}
        );
    }
}

let app = new appPAW();
