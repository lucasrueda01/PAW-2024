<section id="carrito">
    
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
