<!DOCTYPE html>
<html lang="es">

<head>
    <?php require __DIR__ . '/../parts/head.view.php'; ?>
</head>

<body>

    <?php require __DIR__ . '/../parts/header.view.php'; ?>

    <main>

        <!--CONTENIDO DE LA VIEW PEDIDOS-->
        <section class="titulo titulo_portada">
            <h2>PEDIDOS</h2>
            <p>Nuestras hamburguesas te esperan cerca tuyo</p>
        </section>

        <section>
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
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Las filas del carrito se actualizarán dinámicamente -->
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">Total: $00.00</td>
                            </tr>
                        </tfoot>
                    </table>
                    <a href="/nuestro_menu" class="boton boton_negro btn-pedido">Agregar</a>
                </fieldset>


                <fieldset class="container container_formulario container_delivery">

                    <label for="nombre">Ingrese su nombre</label>
                    <input type="text" name="nombre" id="nombre" required>
                    
                    <label for="tipo">Ingrese Tipo Pedido</label>
                    <select id="tipo" name="tipo" id="tipo" required>
                        <option value="delivery">Delivery</option>
                        <option value="en-el-local">Retiro por el Local</option>
                    </select>

                    <label for="local">Selecciona la sucursal:</label>
                    <select id="local" name="local">
                        <option value="Local A">Local A</option>
                        <option value="Local B">Local B</option>
                    </select>

                    <label for="direccion" id="direccion_label">Ingrese su direccion</label>
                    <input type="text" name="direccion" id="direccion" required>

                    <label for="observaciones">Observaciones</label>
                    <input type="text" name="observaciones" id="observaciones">

                    <label for="forma-de-pago">Selecciona una forma de pago:</label>
                    <select id="forma-de-pago" name="forma-de-pago">
                        <option value="mercado_pago">Mercado Pago</option>
                        <option value="efectivo">Pago en efectivo</option>
                    </select>

                </fieldset>

                <input type="submit" value="Pedir" class="boton boton_negro  btn-pedido"> <!--ESTA ACTIVO SOLO CUANDO EL USUARIO ELIGE LA OPCION PEDIR EN EL LUGAR -->
            </form>
        </section>
    </main>

    <?php require __DIR__ . '/../parts/footer.view.php'; ?>