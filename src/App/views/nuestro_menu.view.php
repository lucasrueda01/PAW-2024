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
                    <li>
                        <p class="carrito">Cantidad de Articulos: 00 </p>
                    </li>
                </ul>

            </nav>

            <section id="hamburguesas" class="seccion_hamburguesas">
                <h3>HAMBURGUESAS</h3>    
                <ul class="lista_articulos">
                
                    <?php foreach ($platos as $plato) : ?> 
                        <?php if ($plato->getTipoPlato()== 'Hamburguesa') : ?> 
                            <li class="articulo">
                                <img src="/plato?id=<?= $plato->getId(); ?>" alt="<?= $plato->getNombrePlato(); ?>"> 
                                <h4><?= $plato->getNombrePlato(); ?></h4>
                                <p><?= $plato->getIngredientes(); ?></p>
                                <p class="articulo_precio" data-id="<?= $plato->getPrecio(); ?>">$<?= $plato->getPrecio(); ?></p>
                                <a href="#" class="agregar-carrito boton boton_amarillo" data-id="<?= $plato->getId(); ?>">Agregar</a>
                            </li>
                        <?php endif ?>    
                    <?php endforeach ?>    

                </ul>

                <h4>[TODAS LAS BURGERS ESTAN ACOMPAÑADAS DE PAPAS]</h4>
            </section>

            <section id="bebidas" class="seccion_bebidas">
                <h3>BEBIDAS</h3>
                <ul class="lista_articulos">
                    <?php foreach ($platos as $plato) : ?> 
                        <?php if ($plato->getTipoPlato()== 'Bebida') : ?> 
                            <li class="articulo">
                                <img src="/plato?id=<?= $plato->getId(); ?>" alt="<?= $plato->getNombrePlato(); ?>"> 
                                <h4><?= $plato->getNombrePlato(); ?></h4>
                                <p><?= $plato->getIngredientes(); ?></p>
                                <p class="articulo_precio">$<?= $plato->getPrecio(); ?></p>
                                <a href="#" class="agregar-carrito boton boton_amarillo" data-id="<?= $plato->getId(); ?>">Agregar</a>
                            </li>
                        <?php endif ?>    
                    <?php endforeach ?>    
                </ul>
            </section>

            <section id="otros_platos" class="seccion_otros_platos">
                <h3>OTROS PLATOS</h3>
                <ul class="lista_articulos">
                <?php foreach ($platos as $plato) : ?> 
                        <?php if ($plato->getTipoPlato()== 'Otro Plato') : ?> 
                            <li class="articulo">
                                <img src="/plato?id=<?= $plato->getId(); ?>" alt="<?= $plato->getNombrePlato(); ?>"> 
                                <h4><?= $plato->getNombrePlato(); ?></h4>
                                
                                <p><?= $plato->getIngredientes(); ?></p>
                                <p class="articulo_precio">$<?= $plato->getPrecio(); ?></p>
                                <a href="#" class="agregar-carrito boton boton_amarillo" data-id="<?= $plato->getId(); ?>">Agregar</a>
                            </li>
                        <?php endif ?>    
                    <?php endforeach ?>    
                </ul>
            </section>

        </section>

    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>