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
                        <a href="#section-carrito" class="carrito">Cantidad de Articulos: 00</a>
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

            <section id="section-carrito">
    
                <form action="/pedido/new" method="post" class="formulario_pedido">
                    
                    <fieldset class="container container_carrito"> <!--Fieldset Carrito-->
                        <h3 class="titulo_fieldset">Mi Carrito</h3>
                        <table class="stacked-table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Las filas del carrito se actualizarán dinámicamente -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="total-compra">Total: $00.00</td>
                                </tr>
                            </tfoot>
                        </table>
                        <a href="#container_articulos" class="boton boton_negro btn-pedido">Agregar</a>
                    </fieldset>


                    <fieldset class="container container_formulario container_delivery">

                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" required>
                        
                        <label for="tipo">Tipo Pedido</label>
                        <select id="tipo" name="tipo" required>
                            <option value="">Sin seleccionar</option>
                            <option value="delivery">Delivery</option>
                            <option value="en-el-local">Retiro por el Local</option>
                        </select>

                        <label for="local">Sucursal:</label>
                        <select id="local" name="local">
                            <option value="Local A">Local A</option>
                            <option value="Local B">Local B</option>
                        </select>

                        <label for="direccion" id="direccion_label">Direccion</label>
                        <input type="text" name="direccion" id="direccion" required>

                        <label for="observaciones">Observaciones</label>
                        <input type="text" name="observaciones" id="observaciones">

                        <label for="forma-de-pago">Forma de pago:</label>
                        <select id="forma-de-pago" name="forma-de-pago">
                            <option value="mercado_pago">Mercado Pago</option>
                            <option value="efectivo">Pago en efectivo</option>
                        </select>

                    </fieldset>

                    <input type="text" name="carrito_data" id="carrito_data" value="nada" hidden>
                    <input type="submit" value="Pedir" class="boton boton_negro  btn-pedido"> 

                </form>
            </section>


        </section>                       

    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>