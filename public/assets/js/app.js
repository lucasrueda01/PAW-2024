class appPAW {
    constructor() {

        document.addEventListener("DOMContentLoaded", () => {
            /**
             * cargo la clase Datos, contiene los datos de prueba
             * para la carga del formulario
             *  */
            PAW.cargarScript("Datos", "/assets/js/components/datos.js");

            PAW.cargarScript("Carrousel", "/assets/js/components/carrousel.js", () => {
                let imagenes = ["/assets/imgs/menu/Muzarelitas.jpg", "/assets/imgs/menu/Oklahoma.jpg", "/assets/imgs/menu/Coca.jpg", "/assets/imgs/menu/Fanta.jpg", "/assets/imgs/menu/BigPower.jpg"]
                let carrousel = new Carrousel(".destacados", imagenes)
            });

            PAW.cargarScript("Drag_Drop", "/assets/js/components/drag-drop.js", () => {
                let dragAndDrop = new Drag_Drop(".input-dad", ".output-dad"); //Tienen que estar dentro de un div containter-dad
            });

            PAW.cargarScript("ServicioRestaurante", "/assets/js/components/serviciorestaurante.js", () => {

                const servicioRestaurante = new ServicioRestaurante();
                /**
                 * carga los input local, fecha y hora con el evento click
                 * y controla cuando se hayan cliqueado todos
                 */
                servicioRestaurante.cargarFormularioYComprobar()
            });

            PAW.cargarScript("gestorPedidos", "/assets/js/components/gestorPedidos.js", () => {
                let gestorPedidos = new GestorPedidos();
                
                // Llamar a la función obtenerEstadoPedido() cada 5 segundos
                setInterval(gestorPedidos.getEstadoPedido.bind(gestorPedidos), 5000);
            });

        });
    }
}

let app = new appPAW();





