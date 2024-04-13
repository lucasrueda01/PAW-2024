<!DOCTYPE html>
<html lang="es">

<head>

    <?php require __DIR__.'/parts/head.view.php' ?>
    
</head>

<body>
    
    <?php require __DIR__.'/parts/header.view.php' ?>

    <!--CONTENIDO DE LA VIEW NUESTRO MENU-->

    <main>


        <section class="titulo titulo_portada">
            <h2>MENU</h2>
            <p>Nuestras hamburguesas te esperan cerca tuyo</p>
        </section>       

        <section class="container_articulos"> <!-- SECCION HAMBURGUESAS -->

            <nav class="selector_tipo_articulo">
                <ul>
                    <li class="">
                        <a href="#hamburguesas">Hamburguesas</a>
                    </li>   
                    <li class="">
                        <a href="#bebidas">Bebidas</a>
                    </li>
                    <li class="">
                        <a href="#otros_platos">Otros Platos</a>
                    </li>
                </ul>
            </nav>

            <section id="hamburguesas" class="seccion_hamburguesas">
                <h3>HAMBURGUESAS</h3>    
                <ul class="lista_articulos">
                
                    <li class="articulo">
                        <img src="/assets/imgs/menu/Cheeseburger.jpg" alt="hamburguesa"> 
                        <h4>CHEESEBURGER</h4>
                        <p>DOBLE MEDALLON DE 100GR. CON QUESO CHEDDAR</p>
                        <p class="articulo_precio">$8000</p>
                        <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                    </li>

                    <li class="articulo">
                        <img src="/assets/imgs/menu/Oklahoma.jpg" alt="hamburguesa big power">
                        <h4>BURGER OKLAHOMA</h4>
                        <p>DOBLE MEDALLON DE 100GR. SMASHEADAS CON CEBOLLA Y CHEDDAR</p>
                        <p class="articulo_precio">$8000</p>
                        <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                    </li>

                    <li class="articulo">
                        <img src="/assets/imgs/menu/BigPower.jpg" alt="hamburguesa">
                        <h4>BIG-POWER</h4>
                        <p>DOBLE MEDALLON DE 100GR. LECHUGA, CHEDDAR, CEBOLLA, PEPINOS Y SALSA POWER.</p>
                        <p class="articulo_precio">$8000</p>
                        <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                    </li>

                    <li class="articulo">
                        <img src="/assets/imgs/destacados/comida-destacada-1.png" alt="hamburguesa">
                        <h4>BURGER OKLAHOMA</h4>
                        <p>DOBLE MEDALLON DE 100GR. SMASHEADAS CON CEBOLLA Y CHEDDAR</p>
                        <p class="articulo_precio">$8000</p>
                        <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                    </li>
                
                </ul>

                <h4>[TODAS LAS BURGERS ESTAN ACOMPAÑADAS DE PAPAS]</h4>
            </section>

            <section id="bebidas" class="seccion_bebidas">
                <h3>BEBIDAS</h3>
                <ul class="lista_articulos">
                    <li class="articulo">
                        <img src="../../public/imgs/menu/Coca.jpg" alt="lata coca-cola">
                        <h4>COCA-COLA</h4>
                        <p>Lata de 354ml</p>
                        <p class="articulo_precio">$1100</p>
                        <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                    </li>
                    <li class="articulo">
                        <img src="../../public/imgs/menu/Sprite.png" alt="lata sprite">
                        <h4>SPRITE</h4>
                        <p>Lata de 354ml</p>
                        <p class="articulo_precio">$1100</p>
                        <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                    </li>
                    <li class="articulo">
                        <img src="../../public/imgs/menu/Fanta.jpg" alt="lata fanta">
                        <h4>FANTA</h4>
                        <p>Lata de 354ml</p>
                        <p class="articulo_precio">$1100</p>
                        <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                    </li>
                </ul>
            </section>

            <section id="otros_platos" class="seccion_otros_platos">
                <h3>OTROS PLATOS</h3>
                <ul class="lista_articulos">
                    <li class="articulo">
                        <img src="../../public/imgs/menu/Papas.webp" alt="papas fritas">
                        <h4>PAPAS FRITAS</h4>
                        <p>PORCION DE PAPAS FRITAS</p>
                        <p class="articulo_precio">$3500</p>
                        <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                    </li>
                    <li class="articulo">
                        <img src="../../public/imgs/menu/Papas_Cheddar.jpg" alt="papas con cheddar">
                        <h4>PAPAS FRITAS CON CHEDDAR</h4>
                        <p>PORCION DE PAPAS FRITAS CON CHEDDAR</p>
                        <p class="articulo_precio">$4000</p>
                        <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                    </li>
                    <li class="articulo">
                        <img src="../../public/imgs/menu/Muzarelitas.jpg" alt="Muzarelitas">
                        <h4>MUZZARELITAS</h4>
                        <p>BASTONES DE MUZZARELLA CON DIP DE SALSA A ELECCION.</p>
                        <p class="articulo_precio">$4000</p>
                        <a href="/agregar?comida=id_comida" class="boton boton_amarillo">Agregar</a>
                    </li>
                </ul>
            </section>

        </section>

    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>