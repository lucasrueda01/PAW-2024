class appPAW {
	constructor() {
        
        document.addEventListener("DOMContentLoaded", () => {
        PAW.cargarScript("Datos", "/assets/js/components/datos.js");
		PAW.cargarScript("ServicioRestaurante", "/assets/js/components/serviciorestaurante.js", () => {	

            const servicioRestaurante = new ServicioRestaurante();

            servicioRestaurante.cargarFormularioYComprobar()

            });
		}
        );
    }
}

let app = new appPAW();
