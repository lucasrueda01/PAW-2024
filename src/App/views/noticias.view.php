<!DOCTYPE html>
<html lang="es">

<head>
    <!-- HEAD -->
    <?php require __DIR__.'/parts/head.view.php' ?>
</head>

<body>
    
    <!-- NAV -->
    <?php require __DIR__.'/parts/header.view.php' ?>


    <!--CONTENIDO DE LA VIEW NOTICIAS-->

    <main>

        <section class="titulo titulo_portada">
            <h2>NOTICIAS</h2>
            <p>Informate de todas nuestras novedades acá</p>
        </section>

        <section class="noticias">
            <ul>
                <li class="container_noticia">
                    <article class="noticia">
                        <h3>¡ESTAMOS EN LUJAN!</h3>
                        <img src="../../public/imgs/sucursales/sucursalLujan.jpg" alt="Noticia 1">
                        <!--si no hay una foto, por defecto se mostraria el icono de la empresa-->
                        <p>Ya inauguramos la nueva sucursal ubicada 1 hora de la Capital Federal. Esta ciudad con
                            gran cultura hamburguesera nos incentivo para que aterricemos acá. Desde este viernes ya
                            nos podes visitar en el nuevo local ubicado en - INSERTAR DIRECCION -. 
                        </p>
                        <time datetime="2024-03-24">Sabado, 16 de marzo de 2024</time>
                    </article>
                </li>
                <li class="container_noticia">
                    <article class="noticia">
                        <h3>¡PROXIMAMENTE ... !</h3>
                        <img src="../../public/imgs/svg/Imagotipo_PAWPOWER-negro.svg" alt="Noticia 2">
                        <!--si no hay una foto, por defecto se mostraria el icono de la empresa-->
                        <p>
                            Ya falta poco para que conozcas las mejores hamburguesas. Vamos a contar con sucursales en Capital
                            Federal y el Gran Buenos Aires. 
                        </p>
                        <time datetime="2024-02-10">Sabado, 10 de febrero de 2024</time>
                    </article>
                </li>

            </ul>
        </section>

    </main>

    <!-- FOOTER -->
    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>