class appPAW {
	constructor() {
        
        document.addEventListener("DOMContentLoaded", () => {
        /**
         * cargo la clase Datos, contiene los datos de prueba
         * para la carga del formulario
         *  */    
        PAW.cargarScript("Datos", "/assets/js/components/datos.js");
        
		PAW.cargarScript("ServicioRestaurante", "/assets/js/components/serviciorestaurante.js", () => {	

            const servicioRestaurante = new ServicioRestaurante();

            /**
             * carga los input local, fecha y hora con el evento click
             * y controla cuando se hayan cliqueado todos
             */
            servicioRestaurante.cargarFormularioYComprobar()

            });
		}
        );
    }
}

let app = new appPAW();
