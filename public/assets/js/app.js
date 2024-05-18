class appPAW {
    constructor() {

        document.addEventListener("DOMContentLoaded", () => {

            /**
             * cargo la clase Datos, contiene los datos de prueba
             * para la carga del formulario
             *  */
            if (['/reservar_cliente'].includes(window.location.pathname))        
                PAW.cargarScript("Datos", "/assets/js/components/datos.js");

            if (['/'].includes(window.location.pathname))
                {
                    PAW.cargarScript("Carrousel", "/assets/js/components/carrousel.js", () => {
                        let imagenes = ["/assets/imgs/menu/Muzarelitas.jpg", "/assets/imgs/menu/Oklahoma.jpg", "/assets/imgs/menu/Coca.jpg", "/assets/imgs/menu/Fanta.jpg", "/assets/imgs/menu/BigPower.jpg"]
                        let carrousel = new Carrousel(".destacados", imagenes)
                    });
                }

            if (['/plato/new'].includes(window.location.pathname))
                {
                    PAW.cargarScript("Drag_Drop", "/assets/js/components/drag-drop.js", () => {
                        let dragAndDrop = new Drag_Drop()
                    })                   
                }

            if (['/reservar_cliente'].includes(window.location.pathname))
                {
                    PAW.cargarScript("ServicioRestaurante", "/assets/js/components/serviciorestaurante.js", () => {
        
                        const servicioRestaurante = new ServicioRestaurante()
                        /**
                         * carga los input local, fecha y hora con el evento click
                         * y controla cuando se hayan cliqueado todos
                         */
                        servicioRestaurante.cargarFormularioYComprobar()
                    });
                }

            if (['/pedidos/estado', '/pedido/new'].includes(window.location.pathname))
                {
                    PAW.cargarScript("Pedido", "/assets/js/components/pedido.js");
                    PAW.cargarScript("Animador", "/assets/js/components/animador.js");
                    PAW.cargarScript("gestorPedidos", "/assets/js/components/gestorPedidos.js", () => {
                        let gestorPedidos = new GestorPedidos()
                        
                        // Llamar a la función obtenerEstadoPedido() cada 10 segundos
                        setInterval(gestorPedidos.getEstadoPedido.bind(gestorPedidos), 10000)
                    });
                }
            if(['pedidos_entrantes'].includes(window.location.pathname))
            {
                PAW.cargarScript("Pedido", "/assets/js/components/pedido.js");
            }

            

           if(['/nuestro_menu'].includes(window.location.pathname))    
            {
                PAW.cargarScript("Cart", "/assets/js/components/cart.js", () =>{

                    const cart = new Cart();
    
                    document.querySelectorAll('.agregar-carrito').forEach(link => {
                        link.addEventListener('click', function(event) {
                            event.preventDefault();
                            const plateId = this.getAttribute('data-id');
                            cart.addToCart(plateId);
                            window.location.href = '/pedir';
                        });

                    });

                });
            }

            if(['/pedir'].includes(window.location.pathname))    
                {
                    PAW.cargarScript("Cart", "/assets/js/components/cart.js", () => {
                 
                        const cart = new Cart();

                        // const removeButtons = document.querySelectorAll('.remove-from-cart');

                        // console.log()
                        // removeButtons.forEach(button => {
                        //     button.addEventListener('click', function() {
                        //         const platoId = this.value;
                        //         cart.removeFromCart(platoId);
                        //     });
                        // });
                
                        // Obtener las cookies
                        const platosCookie = cart.getCookie('platos');
                        console.log(platosCookie);
                
                        // Verificar si la cookie existe
                        if (platosCookie) {
                            // Convertir la cookie a un array de IDs de platos
                            const platosIds = JSON.parse(platosCookie);
                            
                            // Realizar una solicitud fetch para obtener los detalles de los platos
                            fetch('/plato-all-in-cart?lista_encoded=' + encodeURIComponent(platosCookie))
                                .then(response => response.json())
                                .then(data => {
                                    // Manejar los datos devueltos
                                    console.log(data);
                                    const table = document.querySelector('table');
                                    cart.updateCarrito(data, table);
                                    
                                    // Aquí puedes hacer lo que necesites con los datos de los platos
                                })
                                .catch(error => {
                                    console.error('Error en la solicitud de platos-en-carrito: ' + error);
                                });
                        }
                    });
                }
        
            })
    }
}

let app = new appPAW();





