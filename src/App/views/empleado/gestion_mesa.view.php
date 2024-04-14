<!DOCTYPE html>
<html lang="es">

<head>
    <?php require __DIR__ . '\../parts/head.view.php' ?>
</head>

<body>
    <?php require __DIR__ . '\../parts/header.view.php' ?>

    <main>


        <section class="titulo titulo_portada">
            <h2>GESTION MESA</h2>
            <p>Nuestras hamburguesas te esperan cerca tuyo</p>
        </section>

        <section class="container_acciones_mesa">
            <a href="/gestion_lista_mesas"></a>

            <p class="info_mesa">
                Apertura de mesa
                Fecha / Hora
            </p>
        </section>

        <section class="container_gestion_mesa">
            <h3>Orden N° 4</h3>
            <a href="/cerrar_mesa?mesa=id_mesa" class="boton boton_rojo boton_rojo_gestion_mesa ">Cerrar Mesa</a>
            <table class="tabla_gestion_mesa">
                <thead>
                    <tr>
                        <th>Acciones</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <a href="/sacar_producto?producto=id_producto&mesa=id_mesa">-</a>
                            <a href="/eliminar_producto?producto=id_producto&mesa=id_mesa">-</a>
                        </td>
                        <td>
                            Nombre producto
                        </td>
                        <td>
                            Dato Cantidad</td>
                        <td>
                            Dato Subtotal</td>
                        <td>
                            Dato Observaciones
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            Total: $$$
                        </td>
                    </tr>
                </tfoot>
            </table>
            <a href="/agregar_producto?mesa=id_mesa" class="boton boton_negro">Agregar Producto</a>
            <a href="/finalizar_pedido?pedido=id_pedido" class="boton boton_verde">Finalizar Pedido</a>
        </section>

    </main>

    <?php require __DIR__ . '\../parts/footer.view.php' ?>

</body>

</html>