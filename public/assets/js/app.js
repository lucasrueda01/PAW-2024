class appPAW {
	constructor() {
        
        document.addEventListener("DOMContentLoaded", () => {
        /**
         * cargo la clase Datos, contiene los datos de prueba
         * para la carga del formulario
         *  */    
        PAW.cargarScript("Datos", "/assets/js/components/datos.js");
        PAW.cargarScript("Carrousel", "/assets/js/components/carrousel.js");
        
		PAW.cargarScript("ServicioRestaurante", "/assets/js/components/serviciorestaurante.js", () => {	


            let imagenes = ["/assets/imgs/menu/Muzarelitas.jpg", "/assets/imgs/menu/Oklahoma.jpg","/assets/imgs/menu/Coca.jpg" , "/assets/imgs/menu/Fanta.jpg", "/assets/imgs/menu/BigPower.jpg"]
            let carrousel = new Carrousel(".destacados",imagenes)

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





