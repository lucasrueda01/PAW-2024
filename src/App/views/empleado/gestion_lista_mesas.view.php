<!DOCTYPE html>
<html lang="es">

<head>
    <?php require __DIR__ . '\../parts/head.view.php' ?>
</head>

<body>
    <?php require __DIR__ . '\../parts/header.view.php' ?>

    <main>

        <section class="titulo titulo_portada">
            <h2>GESTION LISTA MESAS</h2>
            <p>Nuestras hamburguesas te esperan cerca tuyo</p>
        </section>


        <nav class="nav_mesas">
            <ul>
                <li class="boton selector_sector sector_seleccionado"><a href="#sector_a">SECTOR A</a></li>
                <li class="boton selector_sector"><a href="#sector_b">SECTOR B</a></li>
                <li class="boton selector_sector"><a href="#sector_c">SECTOR C</a></li>
                <li class="boton selector_sector"><a href="#sector_d">SECTOR D</a></li>
            </ul>
        </nav>

        <section class="sectores"> <!-- SECCION A -->

            <ul class="sector">
                <li class="mesa mesa_libre"> <!--MESA 1-->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">A1</a>
                </li>
                <li class="mesa mesa_libre"> <!--MESA 1-->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">A1</a>
                </li>
                <li class="mesa mesa_libre"> <!--MESA 1-->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">A1</a>
                </li>
                <li class="mesa mesa_libre"> <!--MESA 1-->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">A1</a>
                </li>
                <li class="mesa mesa_libre"> <!--MESA 1-->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">A1</a>
                </li>
                <li class="mesa mesa_libre"> <!--MESA 1-->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">A1</a>
                </li>
                <li class="mesa mesa_libre"> <!--MESA 1-->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">A1</a>
                </li>
                <li class="mesa mesa_libre"> <!--MESA 1-->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">A1</a>
                </li>
                <li class="mesa mesa_libre"> <!--MESA 1-->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">A1</a>
                </li>

                <li class="mesa mesa_ocupada"> <!--MESA 2 -->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">A2</a>
                </li>

                <li class="mesa mesa_ocupada"> <!--MESA 3 -->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">A3</a>
                </li>

                <li class="mesa mesa_libre"> <!--MESA 4 -->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">A4</a>
                </li>
            </ul>

            <ul class="sector">
                <li class="mesa mesa_libre"> <!--MESA 1-->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">B1</a>
                </li>

                <li class="mesa mesa_ocupada"> <!--MESA 2 -->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">B2</a>
                </li>

                <li class="mesa mesa_libre"> <!--MESA 3 -->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">B3</a>
                </li>

                <li class="mesa mesa_ocupada"> <!--MESA 4 -->
                    <a href="/ver_detalle_mesa?mesa=id_mesa">BA1</a>
                </li>
            </ul>

        </section>

    </main>

    <?php require __DIR__ . '\../parts/footer.view.php' ?>

</body>

</html>