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
                        <th>Nro Pedido</th>
                        <th>Fecha/Hora</th>
                        <th>Tipo</th>
                        <th>Direccion</th>
                        <th>Monto Total</th>
                        <th>Metodo de Pago</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                        <tr>
                            <td id="pedido-id"><?= $pedido['Nro Pedido']; ?></td>
                            <td><?= $pedido['Fecha/Hora']; ?></td>
                            <td><?= $pedido['Tipo']; ?></td>
                            <td><?= $pedido['Direccion']; ?></td>
                            <td><?= $pedido['Monto Total']; ?></td>
                            <td><?= $pedido['Metodo de Pago']; ?></td>
                            <td id="estado"><?= $pedido['Estado']; ?></td>
                            <td>
                                <a href="/pedidos/estado?id=<?= $pedido['Nro Pedido'] ?>" class="icon icon_detalle">Aceptar</a>
                            </td>                                
                            </td>
                        </tr>
                    <?php endforeach; ?>                    

                </tbody>
            </table>
        </section>

    </main>

    <?php require __DIR__ . '\../parts/footer.view.php' ?>

</body>

</html>