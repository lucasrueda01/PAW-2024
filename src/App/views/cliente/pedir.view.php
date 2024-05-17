<!DOCTYPE html>
<html lang="es">

<head>

    <?php require __DIR__ . '\../parts/head.view.php' ?>

</head>

<body>

    <?php require __DIR__ . '\../parts/header.view.php' ?>


    <main>

        <!--CONTENIDO DE LA VIEW PEDIDOS-->
        <section class="titulo titulo_portada">
            <h2>PEDIDOS</h2>
            <p>Nuestras hamburguesas te esperan cerca tuyo</p>
        </section>

        <section>

            <form action="/pagar" method="post" class="formulario_pedido">

                <fieldset class="container container_carrito"> <!--Fieldset Carrito-->
                    <h3 class="titulo_fieldset">Mi Carrito</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">Total: $ </td>
                            </tr>
                        </tfoot>
                    </table>
                    <a href="/nuestro_menu" class="boton boton_negro">Agregar</a>
                </fieldset>

                <nav class="selector_fieldset">
                    <h3 class="titulo_fieldset_delivery">
                        <input type="checkbox" name="menuDelivery" id="menuDelivery">
                        <label for="menuDelivery" class="menuFieldSets"="menuMobile">Delivery</label>
                    </h3>
                    <h3 class="titulo_fieldset_take_away">Take Away</h3>
                    <h3 class="titulo_fieldset_en_el_lugar">En el Lugar</h3>
                </nav>

                <fieldset class="container container_formulario container_delivery">

                    <label for="nombre_delivery">Ingrese su nombre</label>
                    <input type="text" name="nombre_delivery" id="nombre_delivery">
                    <label for="direccion">Ingrese su direccion</label>
                    <input type="text" name="direccion" id="direccion">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" name="observaciones" id="observaciones">
                    <label for="forma_delivery">Selecciona una forma de pago:</label>
                    <select id="forma_delivery" name="forma_delivery">
                        <option value="mercado_pago">Mercado Pago</option>
                        <option value="efectivo">Pago en efectivo</option>
                    </select>
                    <aside>
                        <h4 class="titulo_resumen">Resumen</h4>
                        <ul>
                            <li>Producto 1 - $10</li>
                            <li>Producto 2 - $20</li>
                            <li>Producto 3 - $15</li>
                            <li>Total: $45</li>
                        </ul>
                    </aside>
                </fieldset>

                <fieldset class="container container_formulario container_take_away"> <!-- .container_take_away { display: none }-->

                    <label for="nombre_take_away">Ingrese su nombre</label>
                    <input type="text" name="nombre_take_away" id="nombre_take_away">
                    <label for="numero_sucursal_take_away">Selecciona la sucursal:</label>
                    <select id="numero_sucursal_take_away" name="numero_sucursal_take_away">
                        <option value="1">1 sucursal</option>
                        <option value="2">2 sucursales</option>
                        <option value="3">n sucursales</option>
                    </select>
                    <label for="forma_delivery">Selecciona una forma de pago:</label>
                    <select id="forma_pago_take_away" name="forma_pago_take_away">
                        <option value="mercado_pago">Mercado Pago</option>
                        <option value="efectivo">Pago en efectivo</option>
                    </select>
                    <aside>
                        <h4 class="titulo_resumen">Resumen</h4>
                        <ul>
                            <li>Producto 1 - $10</li>
                            <li>Producto 2 - $20</li>
                            <li>Producto 3 - $15</li>
                            <li>Total: $45</li>
                        </ul>
                    </aside>
                </fieldset>

                <fieldset class="container container_formulario container_en_el_lugar">

                    <label for="nombre_en_el_lugar">Ingrese su nombre</label>
                    <input type="text" name="nombre_en_el_lugar" id="nombre_en_el_lugar">
                    <label for="numero_sucursal_en_el_lugar">Selecciona la sucursal:</label>
                    <select id="numero_sucursal_en_el_lugar" name="numero_sucursal_en_el_lugar">
                        <option value="1">1 sucursal</option>
                        <option value="2">2 sucursales</option>
                        <option value="3">n sucursales</option>
                    </select>
                    <label for="numero_mesa">Selecciona el n&uacute;mero de mesa:</label>
                    <select id="numero_mesa" name="numero_mesa">
                        <option value="1">Mesa 1</option>
                        <option value="2">Mesa 2</option>
                        <option value="3">Mesa 3</option>
                    </select>
                    <aside>
                        <h4 class="titulo_resumen">Resumen</h4>
                        <ul>
                            <li>Producto 1 - $10</li>
                            <li>Producto 2 - $20</li>
                            <li>Producto 3 - $15</li>
                            <li>Total: $45</li>
                        </ul>
                    </aside>
                </fieldset>
                <!--<input type="submit" value="Pagar" class="boton boton_negro">-->
                <input type="submit" value="Pedir" class="boton boton_negro"> <!--ESTA ACTIVO SOLO CUANDO EL USUARIO
                                                        ELIGE LA OPCION PEDIR EN EL LUGAR
                                                    -->
            </form>

        </section>


    </main>

    <?php require __DIR__ . '\../parts/footer.view.php' ?>

</body>

</html>