<!DOCTYPE html>
<html lang="es">

<head>

<?php require __DIR__.'/parts/head.view.php' ?>

</head>

<body>
    
    <?php require __DIR__.'/parts/header.view.php' ?>

<main>

        <section class="titulo titulo_portada">
            <h2>PERFIL PERSONAL</h2>
            <p>Aqui podras ver tus datos personales</p>
        </section>
        
        <section>
            <h3>Mi carrito</h3>
            <form>
                <fieldset class="container container_carrito"> <!--Fieldset Carrito-->
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre Producto</th>
                                <th>Descripcion</th>
                                <th>Precio</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4">Total: $</td>
                            </tr>
                        </tfoot>
                    </table>
                    <a href="/nuestro_menu.html" class="boton boton_violeta">Agregar +</a>
                    <a href="/pedir.html" class="boton boton_violeta">Continuar el pedido</a>
                </fieldset>
            </form>
        </section>

        <section>
            <h3>Mis pedidos</h3>
            <form>
                <fieldset class="container container_pedidos"> 
                    <table>
                        <thead>
                            <tr>
                                <th>Fecha-Hora pedido</th>
                                <th>Resumen productos</th>
                                <th>Total</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </fieldset>
            </form>
        </section>


    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>


</body>

</html>