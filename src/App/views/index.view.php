<!DOCTYPE html>
<html lang="es">

<head>

    <?php require __DIR__.'/parts/head.view.php' ?>

</head>

<body class="home">
    <header> <!--block-->
        <h1><a href="../cliente/index.html" class="logo logo_chico" id="menuDesktop">Paw Burger</a></h1>
        <input type="checkbox" name="menuHamburguesa" id="menuHamburguesa">
        <label for="menuHamburguesa"class="logo logo_chico" id="menuMobile">Paw Burger</label>
        <h1><a href="../cliente/index.html" class="logo logo_grande_mobile">Paw Burger</a></h1>
        <nav class="container_nav"> <!--block-->
            <ul class="nav_menu"> <!--block-->
                <li class="opciones_nav">
                    <a href="../cliente/nuestro_menu.html">MENU</a>
                </li>
                <li class="opciones_nav">
                    <a href="../cliente/promociones.html">PROMOS</a>
                </li>
                <li class="opciones_nav">
                    <a href="../cliente/sucursales.html">SUCURSALES</a>
                </li>
                <li class="opciones_nav">
                    <a href="../cliente/noticias.html">NOTICIAS</a>
                </li>
                <li class="opciones_nav">
                    <a href="../cliente/pedir.html">PEDIR</a>
                </li>
                <li class="opciones_nav">
                    <a href="../cliente/reservar_cliente.html">RESERVAR</a>
                </li>
                <li class="opciones_nav">
                    <input type="checkbox" name="menuGestionEmpleado" id="checkPerfilEmpleado">
                    <label for="checkPerfilEmpleado" class="labelPerfilEmpleado">PERFIL EMPLEADO</label>
                    <ul class="submenu">
                        <li class="opciones_nav">
                            <a href="../empleado/gestion_lista_mesas.html">GESTION MESAS</a>
                        </li>
                        <li class="opciones_nav">
                            <a href="../empleado/gestion_mesa.html">GESTION MESA</a>
                        </li>
                        <li class="opciones_nav">
                            <a href="../empleado/pedidos_entrantes.html">PEDIDOS ENTRANTES</a>
                        </li>
                    </ul>
                </li>
            </ul>
             <ul class="nav_usuario">
                <li class="opciones_nav">
                    <input type="checkbox" name="menuPerfil" id="menuPerfil">
                    <label for="menuPerfil" class="icono_usuario">Perfil Usuario</label>
                    <ul class="submenu">
                        <li class="opciones_nav opciones_nav_oculto"><a href="inicio_sesion.html">Cliente</a></li>
                        <li class="opciones_nav opciones_nav_oculto"><a href="#">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <main>

        <section class="imagen portada_sitio"> <!--Seccion Portada del sitio, va a estar en la mayoria de los sitios-->
            <!--acá esta la imagen de la portada
                                mas el anchor al home y
                                los dos enlaces al menu y reserva
                            -->
            <!-- LOGO -->
            <h2 class="logo logo_grande">Home</h2>
            <h2><a href="nuestro_menu.html" class="boton boton_amarillo" target="_blank">Menu</a></h2>
            <h2><a href="reservar_cliente.html" class="boton boton_amarillo" target="_blank">Reservar</a></h2>
        </section>


        <section class="destacados">
            <!--SECCION DESTACADOS-->
            <h2 class="subtitulo">Los destacados de Power</h2>
            <ul class="lista">
                <li class="item">
                
                        <img src="../../public/imgs/menu/BigPower.jpg" alt="hamburguesa destacada">
                        <p>Big Power</p>
                </li>
                <li class="item">
                
                    <img src="../../public/imgs/menu/Oklahoma.jpg" alt="hamburguesa destacada">
                    <p>Oklahoma</p>
            </li>
            </ul>
        </section>

        <section class="sucursales"> <!--NUESTRAS SUCURSALES-->
            <h2 class="subtitulo">Nuestras Sucursales</h2>
            <ul class="lista">

                <!-- LUJAN -->

                <li class="item">
                    <figure>
                        <img src="../../public/imgs/sucursales/sucursalLujan.jpg" alt="Sucursal Lujan">
                        <figcaption>
                            <h3>LUJAN</h3>
                            <p>San Martin 560</p><br>
                            <a href="../cliente/sucursales.html">VER MAS</a>
                        </figcaption>
                        
                    </figure>
                </li>

                <!-- PILAR -->
                

                <li class="item">
                    <figure>
                        <img src="../../public/imgs/sucursales/sucursalPilar.jpg" alt="Sucursal Pilar">
                        <figcaption>
                            <h3>PILAR</h3>
                            <p>Autopista Panamericana KM50</p><br>
                            <a href="../cliente/sucursales.html">VER MAS</a>
                        </figcaption>
                    </figure>
                </li>

                <!-- PALERMO -->
                
                 <li class="item">
                    <figure>
                        <img src="../../public/imgs/sucursales/sucursalPalermo.jpg" alt="Sucursal Palermo">
                        <figcaption>
                            <h3>PALERMO</h3>
                            <p>Av. Juan Bautista Justo 154</p><br>
                            <a href="../cliente/sucursales.html">VER MAS</a>
                        </figcaption>
                    </figure>
                </li>

                <!-- RECOLETA -->

                <li class="item">
                    <figure>
                        <img src="../../public/imgs/sucursales/sucursalRecoleta.jpg" alt="Sucursal Recoleta">
                        <figcaption>
                            <h3>RECOLETA</h3>
                            <p>Av. Alvear 1750</p><br>
                            <a href="../cliente/sucursales.html">VER MAS</a>
                        </figcaption>
                    </figure>
                </li>
            </ul>
        </section>

        <section class="promos" id="promos">
            <!--Promos imperdibles-->
            <h2 class="subtitulo">Promos Imperdibles</h2>

            <figure class="item">
                <img src="../../public/imgs/promos/promo-1.png" alt="imagen-promo"> 
                <figcaption>
                    <h3>2X1 Todos los jueves en nuestras burgers</h3>
                    <a href="/pedir?comida=id_comida" class="boton boton_amarillo" target="_blank">Pedir</a>
                </figcaption>
            </figure>

        </section>

        <section class="empresa">
            <h2> Queremos que seas <strong>parte de nuestro equipo</strong> </h2>
            <a href="unete_al_equipo.html" class="boton boton_negro">Trabaja con nosotros</a>
        </section>

    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>