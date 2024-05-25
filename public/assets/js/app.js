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

            if (['/pedidos_entrantes','/pedidos/estado', '/pedido/new'].includes(window.location.pathname))
                {
                    PAW.cargarScript("Pedido", "/assets/js/components/pedido.js");
                    PAW.cargarScript("Animador", "/assets/js/components/animador.js");
                    PAW.cargarScript("gestorPedidos", "/assets/js/components/gestorPedidos.js", () => {

                                let gestorPedidos = new GestorPedidos()
                                
                                // Llamar a la función obtenerEstadoPedido() cada 10 segundos
                                setInterval(gestorPedidos.getEstadoPedido.bind(gestorPedidos), 10000)

                    });
                }

            if(['/nuestro_menu'].includes(window.location.pathname))    
            {
                PAW.cargarScript("Pedido", "/assets/js/components/pedido.js");
                PAW.cargarScript("Animador", "/assets/js/components/animador.js");
                PAW.cargarScript("gestorPedidos", "/assets/js/components/gestorPedidos.js", () => {
                    Notification.requestPermission().then(permission => {
                        if (permission === 'granted') {
                            permisoNotificacion = true; // Almacenar el estado del permiso
                            let gestorPedidos = new GestorPedidos()
                            
                            // Llamar a la función obtenerEstadoPedido() cada 10 segundos
                            setInterval(gestorPedidos.bind(gestorPedidos), 10000)

                        } else {
                            console.log('Permiso de notificación denegado');
                        }                        
                    });


                });                                 
            }

            if(['/nuestro_menu'].includes(window.location.pathname)) 
            {
                PAW.cargarScript("UtilsMaths", "/assets/js/components/UtilsMaths.js")
                PAW.cargarScript("Plato", "/assets/js/components/plato.js")
                PAW.cargarScript("carrito", "/assets/js/components/carrito.js", () =>{
                    /**
                     * instanciar un carrito
                     */
                    const carrito = new Carrito()
                    /**
                     * cargarPlatos en memoria, con cantidad vacia
                     */
                    carrito.cargarPlatos()
                    /**
                     * recorrer todos los botones btn-increment, por cada
                     * uno agregar evento de incrementarCarrito
                     * y a ese plato incrementar cantidad tambien
                     */
                    document.querySelectorAll('.btn_increment').forEach(btn_increment => {
                        btn_increment.addEventListener('click', function() {
                            const platoId = this.dataset.id;
                            carrito.incrementarCantidadPlato(platoId);
                            console.log(carrito)
                            // // Actualizar la cantidad en el input correspondiente
                            const inputCantidad = this.parentElement.querySelector('.input_cantidad');
                            inputCantidad.value = parseInt(inputCantidad.value) + 1;


                            const cantidadArticulos = document.querySelector('.carrito');
                            cantidadArticulos.textContent = `Cantidad de Articulos: ${String(carrito.cant_articulos).padStart(2, '0')}`;
                           
                        });
                    });

                    /**
                     * recorrer todos los botones btn-decrement, por cada
                     * uno agregar evento de decrementarCarrito
                     * y a ese plato decrementar cantidad tambien
                     */                    
                    document.querySelectorAll('.btn_decrement').forEach(btn_decrement => {
                        btn_decrement.addEventListener('click', function() {
                            const platoId = this.dataset.id;
                            
                            if(carrito.decrementarCantidadPlato(platoId)){
                                console.log(carrito);
                        
                                // Actualizar la cantidad en el input correspondiente
                                const inputCantidad = this.parentElement.querySelector('.input_cantidad');
                                console.log(`parseInt(inputCantidad.value): ${parseInt(inputCantidad.value)}`)
                                inputCantidad.value = parseInt(inputCantidad.value) - 1;
                        
                                const cantidadArticulos = document.querySelector('.carrito');
                                cantidadArticulos.textContent = `Cantidad de Articulos: ${String(carrito.cant_articulos).padStart(2, '0')}`;
                            }else{
                                console.log(`ya no se puede seguir decrementando`)
                            }
                        });
                    });     
                    
                    /**
                     * interacciones con el formulario
                     */

                    // Seleccionar el select y el campo de dirección
                    const formaPagoSelect = document.querySelector("#tipo");
                    const direccionInput = document.querySelector("#direccion");
                    const direccionLabel = document.querySelector("#direccion_label");

                    // Agregar un event listener al select para detectar cambios en su valor
                    formaPagoSelect.addEventListener("change", function() {
                        // Verificar el valor seleccionado
                        if (this.value === "en-el-local") {
                            // Ocultar el campo de dirección y su etiqueta
                            direccionInput.style.display = "none";
                            direccionLabel.style.display = "none";
                            direccionInput.removeAttribute("required");
                        } else {
                            // Mostrar el campo de dirección y su etiqueta
                            direccionInput.style.display = "block"; // O "inline-block", dependiendo del diseño deseado
                            direccionLabel.style.display = "block"; // O "inline-block", dependiendo del diseño deseado
                        }
                    }); 
                })
            }


            
        
        })
    }
}

let app = new appPAW();





