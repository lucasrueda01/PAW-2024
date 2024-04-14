<!DOCTYPE html>
<html lang="es">

    <head>

    <?php require __DIR__.'/parts/head.view.php' ?>
    
    </head>
    
    <body>
        
        <?php require __DIR__.'/parts/header.view.php' ?>

    <main>


        <section class="titulo titulo_portada">
            <h2>NUESTRAS PROMOS</h2>
            <p>Estas son las mejor promos pensadas para vos</p>
        </section>

        <section class="container_articulos">
            
            <ul class="lista_articulos">
                <li class="articulo">
                    <img src="assets/imgs/destacados/comida-destacada-1.png" alt="hamburguesa">
                    <h3>Nombre de la Comida</h3>
                    <p>Descripcion</p>
                    <p class="articulo_precio">$8000</p>
                    <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                </li>
                <li class="articulo">
                    <img src="assets/imgs/destacados/comida-destacada-1.png" alt="hamburguesa">
                    <h3>Nombre de la Comida</h3>
                    <p>Descripcion</p>
                    <p class="articulo_precio">$8000</p>
                    <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                </li>
                <li class="articulo">
                    <img src="assets/imgs/destacados/comida-destacada-1.png" alt="hamburguesa">
                    <h3>Nombre de la Comida</h3>
                    <p>Descripcion</p>
                    <p class="articulo_precio">$8000</p>
                    <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                </li>
                <li class="articulo">
                    <img src="assets/imgs/destacados/comida-destacada-1.png" alt="hamburguesa">
                    <h3>Nombre de la Comida</h3>
                    <p>Descripcion</p>
                    <p class="articulo_precio">$8000</p>
                    <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                </li>
            </ul>

            <a href="/nuestro_menu" target="_blank" class="boton boton_negro link">Ver Menu Completo</a>

        </section>
    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>