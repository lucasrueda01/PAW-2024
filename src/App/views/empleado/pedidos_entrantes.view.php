<!DOCTYPE html>
<html lang="es">

<head>
    <?php require __DIR__ . '\../parts/head.view.php' ?>
</head>

<body>
    <?php require __DIR__ . '\../parts/header.view.php' ?>


    <main>

        <section class="titulo titulo_portada">
            <h2>PEDIDOS ENTRANTES</h2>
            <p>Nuestras hamburguesas te esperan cerca tuyo</p>
        </section>


        <section class="container_gestion_mesa">
            <table class="tabla_gestion_mesa">
                <thead>
                    <tr>
                        <th>Fecha/Hora</th>
                        <th>Productos</th>
                        <th>Tipo</th>
                        <th>Direccion</th>
                        <th>Monto Total</th>
                        <th>Metodo de Pago</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Delivery/TakeAway</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Pendiente/ en Preparacion/ rechazado/ terminado</td>
                        <td>
                            <a href="/aceptar_pedido?pedido=id_pedido" class="icon icon_aceptar">Aceptar</a>
                            <a href="/rechazar_pedido?pedido=id_pedido" class="icon icon_rechazar">Rechazar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

    </main>

    <?php require __DIR__ . '\../parts/footer.view.php' ?>

</body>

</html>