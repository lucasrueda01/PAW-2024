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
            <?php if (isset($error['description'])) : ?>
                <h4 class="msj msj_error">
                    <?= $error['description']; ?>
                </h4>
            <?php endif ?>
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
                        <td data-label="Nro Pedido" id="pedido-nro-<?= $pedido['Nro Pedido']; ?>">#0000<?= $pedido['Nro Pedido']; ?></td>
                        <td data-label="Fecha/Hora"><?= $pedido['Fecha/Hora']; ?></td>
                        <td data-label="Tipo"><?= $pedido['Tipo']; ?></td>
                        <td data-label="Direccion"><?= $pedido['Direccion']; ?></td>
                        <td data-label="Monto Total">$ <?= number_format($pedido['Monto Total'], 2, ',', '.'); ?></td>
                        <td data-label="Metodo de Pago"><?= $pedido['Metodo de Pago']; ?></td>
                        <td data-label="Estado" class="estado-<?= $pedido['Estado']; ?>"><?= $pedido['Estado']; ?></td>
                        <td data-label="Acciones">
                            <a href="/pedidos/estado?id=<?= $pedido['Nro Pedido'] ?>" class="icon icon_detalle">Aceptar</a>
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