class appPAW {
    constructor() {

        document.addEventListener("DOMContentLoaded", () => {

            /**
             * cargo la clase Datos, contiene los datos de prueba
             * para la carga del formulario
             *  */
            if (['/reservar_cliente', '/ver_mi_reserva'].includes(window.location.pathname))        
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

            if (['/ver_mi_reserva'].includes(window.location.pathname))
                {
                    
                    PAW.cargarScript("ServicioRestaurante", "/assets/js/components/serviciorestaurante.js", () => {
                    
                    console.log("Estoy en mi reserva")
                    const servicioRestaurante = new ServicioRestaurante()
                    
                    servicioRestaurante.marcarMesaReservada();

                })  
                }
    
            if (['/ver_mi_pedido'].includes(window.location.pathname)) {
                PAW.cargarScript("Animador", "/assets/js/components/animador.js");
                PAW.cargarScript("gestorPedidos", "/assets/js/components/gestorPedidos.js", () => {
            
                    let gestorPedidos = new GestorPedidos();
                    let notificationInterval = null;
                    let isNotifying = false;
                    let audio = null;
            
                    const toggleIcon = document.getElementById('toggleIcon');
                    const notificationMessage = document.getElementById('notificationMessage');

                    const estadoId = document.querySelector('#estado').getAttribute('data-estado');
                    const pedidoId = document.querySelector('.nro_pedido').getAttribute('data-estado');
                                                            

                    toggleIcon.addEventListener('click', async () => {
                        if (isNotifying) {
                            // Detener las notificaciones
                            clearInterval(notificationInterval);
                            isNotifying = false;
                            toggleIcon.src = "/assets/imgs/svg/campana-de-notificacion-off.svg"; // Cambiar a icono de iniciar
                            console.log('Notificaciones detenidas');
            
                            // Detener el sonido inmediatamente
                            if (audio) {
                                audio.pause();
                                audio.currentTime = 0; // Reiniciar el sonido
                            }
            
                            // Detener la vibración inmediatamente
                            if (navigator.vibrate) {
                                navigator.vibrate(0); // Parar la vibración
                            }

                            notificationMessage.textContent = 'Quieres que te avise como va tu pedido? Dame permiso haciendo click en la campanita'
            
                        } else {
                            // Solicitar permiso de notificación
                            try {
                                let permission = await Notification.requestPermission();
                                if (permission === 'granted') {
                                    console.log('Permiso de notificación concedido');
            
                                    // Iniciar la vibración y sonido cada 2 segundos
                                    notificationInterval = setInterval(async () => {

                                        /**
                                         *  metodo que controle si cambio el estado del pedido
                                         *  SOLO en caso positivo: 
                                         *      - Vibrar y sonar
                                         */

                                            gestorPedidos.cambioEstadoPedido(estadoId, pedidoId)
                                                .then(([estado_name, haCambiado]) => {
                                                    console.log('Estado:', estado_name);
                                                    console.log('¿Ha cambiado el estado?', haCambiado);
                                                    if(haCambiado) {

                                                        // Obtener el elemento HTML
                                                        const estadoElement = document.querySelector('#estado');
                                                        
                                                        console.log(estadoElement.textContent)
                                                        // Actualizar el contenido del elemento con el nuevo estado_name
                                                        estadoElement.textContent = `Estado: ${estado_name}`;                                                
                                                        // Hacer vibrar el dispositivo
                                                        if (navigator.vibrate) {
                                                            navigator.vibrate(200); // Vibrar durante 200 ms
                                                            console.log('El dispositivo está vibrando');
                                                        } else {
                                                            console.log('La API de Vibración no es soportada por este dispositivo');
                                                        }
                                                        
                                                        // Reproducir un sonido (opcional)
                                                        try {
                                                            audio = new Audio('/assets/audios/play-comida-lista.mp3');                                            
        
                                                            audio.play().catch(error => {
                                                                console.error('Error reproduciendo el sonido:', error);
                                                            });
                                                        } catch (error) {
                                                            console.error('Error creando el objeto de audio:', error);
                                                        }
                                                     }                                                    
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                });

                                         

            
                                    }, 2000);
            
                                    isNotifying = true;
                                    toggleIcon.src = "/assets/imgs/svg/campana-de-notificacion-on.svg"; // Cambiar a icono de detener
            
                                    // Ocultar el mensaje después de la primera interacción
                                    notificationMessage.textContent = 'Dale, te mantendre al tanto !';
                                    // notificationMessage.style.display = 'none';
                                } else {
                                    console.log('Permiso de notificación denegado');
                                    notificationInterval = setInterval(async () => {

                                        /**
                                         *  metodo que controla si cambio el estado del pedido
                                         */

                                            gestorPedidos.cambioEstadoPedido(estadoId, pedidoId)
                                                .then(([estado_name, haCambiado]) => {
                                                    console.log('Estado:', estado_name);
                                                    console.log('¿Ha cambiado el estado?', haCambiado);
                                                    if(haCambiado) {

                                                        // Obtener el elemento HTML
                                                        const estadoElement = document.querySelector('#estado');
                                                        
                                                        console.log(estadoElement.textContent)
                                                        // Actualizar el contenido del elemento con el nuevo estado_name
                                                        estadoElement.textContent = `Estado: ${estado_name}`;                                                

                                                     }                                                    
                                                })
                                                .catch(error => {
                                                    console.error('Error:', error);
                                                });
            
                                    }, 2000);                                    
                                }
                            } catch (error) {
                                console.log('Error solicitando permiso de notificación', error);
                            }
                        }
                    });
            
                    notificationInterval = setInterval(async () => {

                        /**
                         *  metodo que controla si cambio el estado del pedido
                         */

                            gestorPedidos.cambioEstadoPedido(estadoId, pedidoId)
                                .then(([estado_name, haCambiado]) => {
                                    console.log('Estado:', estado_name);
                                    console.log('¿Ha cambiado el estado?', haCambiado);
                                    if(haCambiado) {

                                        // Obtener el elemento HTML
                                        const estadoElement = document.querySelector('#estado');
                                        
                                        console.log(estadoElement.textContent)
                                        // Actualizar el contenido del elemento con el nuevo estado_name
                                        estadoElement.textContent = `Estado: ${estado_name}`;                                                

                                     }                                                    
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });

                    }, 2000);  

                    setInterval(gestorPedidos.getEstadoPedido.bind(gestorPedidos), 10000);
                });
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

                        const actualizarEstadoBtns = document.querySelectorAll('[id*="actualizarEstadoBtn"]');

                        actualizarEstadoBtns.forEach(boton => {
                            boton.addEventListener('touchstart', gestorPedidos.actualizarEstado.bind(gestorPedidos));
                            boton.addEventListener('click', gestorPedidos.actualizarEstado.bind(gestorPedidos));                            
                        });


                        // Llamar a la función obtenerEstadoPedido() cada 10 segundos
                        setInterval(gestorPedidos.getEstadoPedido.bind(gestorPedidos), 10000)
                    });
                }

            if(['/nuestro_menu'].includes(window.location.pathname)) 
                {
                    PAW.cargarScript("Utils", "/assets/js/components/Utils.js")
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

                        const formPedido = document.querySelector('.formulario_pedido');
                        console.log(formPedido)
                        const errorCargaCarrito = document.querySelector('.error_carga_carrito');
                    
                        formPedido.addEventListener('submit', function(event) {
                            // Evitar que el formulario se envíe automáticamente
                            event.preventDefault();
                    
                            // Verificar si el carrito tiene al menos un artículo
                            const cantidadArticulos = carrito.cant_articulos;
                            if (parseInt(cantidadArticulos) === 0) {
                                // Mostrar el mensaje de error
                                errorCargaCarrito.style.display = 'flex';
                            } else {
                                // Ocultar el mensaje de error y enviar el formulario
                                errorCargaCarrito.style.display = 'none';
                                this.submit();
                            }
                        });
                    
                        // Agregar evento al botón de aceptar en el mensaje de error
                        const btnAceptarError = document.querySelector('#btn_aceptar_msj_error_carrito');
                        btnAceptarError.addEventListener('click', function() {
                            errorCargaCarrito.style.display = 'none';
                        });                        

                    })
                }

        
            })
    }
}

let app = new appPAW();





