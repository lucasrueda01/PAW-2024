<!DOCTYPE html>
<html lang="es">

<head>
    <?php require __DIR__ . '/../parts/head.view.php'; ?>
</head>

<body>
    <?php require __DIR__ . '/../parts/header.view.php'; ?>

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
                        <td data-label="Nro Pedido" id="pedido-nro-<?= $pedido['id']; ?>">#0000<?= $pedido['id']; ?></td>
                        <td data-label="Fecha/Hora"><?= $pedido['created_at']; ?></td>
                        <td data-label="Tipo"><?= $pedido['tipo']; ?></td>
                        <td data-label="Direccion"><?= $pedido['direccion']; ?></td>
                        <td data-label="Monto Total">$ <?= number_format($pedido['monto_total'], 2, ',', '.'); ?></td>
                        <td data-label="Metodo de Pago"><?= $pedido['metodo_pago']; ?></td>
                        <td data-label="Estado" class="estado-<?= $pedido['estado']; ?>"><?= $pedido['estado']; ?></td>
                        <td data-label="Acciones">
                            <a href="/pedidos/estado?id=<?= $pedido['id'] ?>" class="icon icon_detalle">Aceptar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <?php require __DIR__ . '/../parts/footer.view.php'; ?>
</body>

</html>
