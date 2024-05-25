<!DOCTYPE html>
<html lang="es">

<head>

    <?php require __DIR__.'/parts/head.view.php' ?>

</head>

<body class="home">

    <?php require __DIR__.'/parts/header.view.php' ?>


    <main>

        <section class="imagen portada_sitio"> <!--Seccion Portada del sitio, va a estar en la mayoria de los sitios-->
            <!--acá esta la imagen de la portada
                                mas el anchor al home y
                                los dos enlaces al menu y reserva
                            -->
            <!-- LOGO -->
            <h2 class="logo logo_grande">Home</h2>
            <h2><a href="/nuestro_menu" class="boton boton_amarillo">Menu</a></h2>
            <h2><a href="/reservar_cliente" class="boton boton_amarillo">Reservar</a></h2>
        </section>


        <!-- carrousel  -->
        <section class="destacados">
            <h2 class="subtitulo">Los destacados de Power</h2>
            
        </section>

        


        <section class="sucursales"> <!--NUESTRAS SUCURSALES-->
            <h2 class="subtitulo">Nuestras Sucursales</h2>
            <ul class="lista">

                <!-- LUJAN -->

                <li class="item">
                    <figure>
                        <img src="assets/imgs/sucursales/sucursalLujan.jpg" alt="Sucursal Lujan">
                        <figcaption>
                            <h3>LUJAN</h3>
                            <p>San Martin 560</p><br>
                            <a href="/sucursales">VER MAS</a>
                        </figcaption>
                        
                    </figure>
                </li>

                <!-- PILAR -->
                

                <li class="item">
                    <figure>
                        <img src="/assets/imgs/sucursales/sucursalPilar.jpg" alt="Sucursal Pilar">
                        <figcaption>
                            <h3>PILAR</h3>
                            <p>Autopista Panamericana KM50</p><br>
                            <a href="/sucursalel">VER MAS</a>
                        </figcaption>
                    </figure>
                </li>

                <!-- PALERMO -->
                
                 <li class="item">
                    <figure>
                        <img src="/assets/imgs/sucursales/sucursalPalermo.jpg" alt="Sucursal Palermo">
                        <figcaption>
                            <h3>PALERMO</h3>
                            <p>Av. Juan Bautista Justo 154</p><br>
                            <a href="/sucursales">VER MAS</a>
                        </figcaption>
                    </figure>
                </li>

                <!-- RECOLETA -->

                <li class="item">
                    <figure>
                        <img src="/assets/imgs/sucursales/sucursalRecoleta.jpg" alt="Sucursal Recoleta">
                        <figcaption>
                            <h3>RECOLETA</h3>
                            <p>Av. Alvear 1750</p><br>
                            <a href="/sucursales">VER MAS</a>
                        </figcaption>
                    </figure>
                </li>
            </ul>
        </section>

        <section class="promos" id="promos">
            <!--Promos imperdibles-->
            <h2 class="subtitulo">Promos Imperdibles</h2>

            <figure class="item">
                <img src="/assets/imgs/promos/promo-1.png" alt="imagen-promo"> 
                <figcaption>
                    <h3>2X1 Todos los jueves en nuestras burgers</h3>
                    <a href="/pedir?comida=id_comida" class="boton boton_amarillo">Pedir</a>
                </figcaption>
            </figure>

        </section>

        <section class="empresa">
            <h2> Queremos que seas <strong>parte de nuestro equipo</strong> </h2>
            <a href="/unete_al_equipo" class="boton boton_negro">Trabaja con nosotros</a>
        </section>

    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>