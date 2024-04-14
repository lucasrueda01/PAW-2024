<!DOCTYPE html>
<html lang="es">

<head>

<?php require __DIR__.'/parts/head.view.php' ?>

</head>

<body>
    
    <?php require __DIR__.'/parts/header.view.php' ?>


    <main>

        <section class="titulo titulo_portada">
            <h2>SUCURSALES</h2>
            <p>Nuestras hamburguesas te esperan cerca tuyo</p>
        </section>
        

        <section class="container_sucursales">
            <ul class="lista_sucursales"> <!-- LISTA DE SUCURSALES -->

                <li class="sucursal"> <!-- LUJAN -->
                    <h3>LUJAN</h3>
                    <p>San Martin 560</p>
                    <figure>
                        <img src="assets/imgs/sucursales/sucursalLujan.jpg" alt="Sucursal Lujan">
                        <figcaption>
                            <a href="/pedir?=id_sucursal" class="boton boton_amarillo boton_amarillo_chico">Pedir</a>
                            <a href="/reservar?=id_sucursal"
                                class="boton boton_amarillo boton_amarillo_chico">Reservar</a>
                        </figcaption>
                    </figure>
                </li>
                <li class="sucursal"> <!-- SUCURSAL PILAR -->
                    <h3>PILAR</h3>
                    <p>Autopista Panamericana KM50</p>
                    <figure>
                        <img src="assets/imgs/sucursales/sucursalPilar.jpg" alt="Sucursal Pilar">
                        <figcaption>
                            <a href="/pedir?=id_sucursal" class="boton boton_amarillo boton_amarillo_chico">Pedir</a>
                            <a href="/reservar?=id_sucursal"
                                class="boton boton_amarillo boton_amarillo_chico">Reservar</a>
                        </figcaption>
                    </figure>
                </li>
                <li class="sucursal"> <!-- SUCURSAL PALERMO -->
                    <h3>PALERMO</h3>
                    <p>Av. Juan Bautista Justo 154</p>
                    <figure>
                        <img src="assets/imgs/sucursales/sucursalPalermo.jpg" alt="Sucursal Palermo">
                        <figcaption>
                            <a href="/pedir?=id_sucursal" class="boton boton_amarillo boton_amarillo_chico">Pedir</a>
                            <a href="/reservar?=id_sucursal"
                                class="boton boton_amarillo boton_amarillo_chico">Reservar</a>
                        </figcaption>
                    </figure>
                </li>
                <li class="sucursal"> <!-- SUCURSAL RECOLETA -->
                    <h3>RECOLETA</h3>
                    <p>Av. Alvear 1750</p>
                    <figure>
                        <img src="assets/imgs/sucursales/sucursalRecoleta.jpg" alt="Sucursal Recoleta">
                        <figcaption>
                            <a href="/pedir?=id_sucursal" class="boton boton_amarillo boton_amarillo_chico">Pedir</a>
                            <a href="/reservar?=id_sucursal"
                                class="boton boton_amarillo boton_amarillo_chico">Reservar</a>
                        </figcaption>
                    </figure>
                </li>

            </ul>
        </section>

    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>