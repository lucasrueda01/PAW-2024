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

        <section class="container_articulos" id="container_articulos"> <!-- SECCION HAMBURGUESAS -->

            <nav class="selector_tipo_articulo">
                <ul>
                    <li>
                        <a href="#hamburguesas">Hamburguesas</a>
                    </li>   
                    <li>
                        <a href="#bebidas">Bebidas</a>
                    </li>
                    <li>
                        <a href="#otros_platos">Otros Platos</a>
                    </li>
                    <li>
                        <a href="#carrito" class="carrito">Cantidad de Articulos: 00 </a>
                    </li>
                </ul>

            </nav>

            <section id="hamburguesas" class="seccion_hamburguesas">
                <h3>HAMBURGUESAS</h3>    
                <ul class="lista_articulos">
                
                    <?php foreach ($platos as $plato) : ?> 
                        <?php if ($plato->getTipoPlato()== 'Hamburguesa') : ?> 
                            <li class="articulo" data-id="<?= $plato->getId(); ?>">
                                <img src="/plato?id=<?= $plato->getId(); ?>" alt="<?= $plato->getNombrePlato(); ?>"> 
                                <h4 data-id="<?= $plato->getNombrePlato(); ?>"><?= $plato->getNombrePlato(); ?></h4>
                                <p data-id="<?= $plato->getIngredientes(); ?>"><?= $plato->getIngredientes(); ?></p>
                                <p class="articulo_precio" data-id="<?= $plato->getPrecio(); ?>">$<?= number_format($plato->getPrecio(), 2, ',', '.'); ?></p>
                                <button class="btn_decrement" data-id="<?= $plato->getId(); ?>">-</button>
                                <input type="number" value="0" class="input_cantidad">
                                <button class="btn_increment" data-id="<?= $plato->getId(); ?>">+</button>
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
                            <li class="articulo" data-id="<?= $plato->getId(); ?>">
                                <img src="/plato?id=<?= $plato->getId(); ?>" alt="<?= $plato->getNombrePlato(); ?>"> 
                                <h4 data-id="<?= $plato->getNombrePlato(); ?>"><?= $plato->getNombrePlato(); ?></h4>
                                <p data-id="<?= $plato->getIngredientes(); ?>"><?= $plato->getIngredientes(); ?></p>
                                <p class="articulo_precio" data-id="<?= $plato->getPrecio(); ?>">$<?= number_format($plato->getPrecio(), 2, ',', '.'); ?></p>
                                <button class="btn_decrement" data-id="<?= $plato->getId(); ?>">-</button>
                                <input type="number" value="0" class="input_cantidad">
                                <button class="btn_increment" data-id="<?= $plato->getId(); ?>">+</button>
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
                            <li class="articulo" data-id="<?= $plato->getId(); ?>">
                                <img src="/plato?id=<?= $plato->getId(); ?>" alt="<?= $plato->getNombrePlato(); ?>"> 
                                <h4 data-id="<?= $plato->getNombrePlato(); ?>"><?= $plato->getNombrePlato(); ?></h4>
                                <p data-id="<?= $plato->getIngredientes(); ?>"><?= $plato->getIngredientes(); ?></p>
                                <p class="articulo_precio" data-id="<?= $plato->getPrecio(); ?>">$<?= number_format($plato->getPrecio(), 2, ',', '.'); ?></p>                               
                                <button class="btn_decrement" data-id="<?= $plato->getId(); ?>">-</button>
                                <input type="number" value="0" class="input_cantidad">
                                <button class="btn_increment" data-id="<?= $plato->getId(); ?>">+</button>
                            
                            </li>
                        <?php endif ?>    
                    <?php endforeach ?>    
                </ul>
            </section>

            <?php require __DIR__ . '/parts/formulario-pedido.view.php'; ?>

        </section>


                        

    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>