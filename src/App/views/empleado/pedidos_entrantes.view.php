<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="estilos.css"> <!-- Enlaza tu archivo de estilos CSS -->
    <?php require __DIR__ . '/../parts/head.view.php'; ?>
</head>

<body>
    <?php require __DIR__ . '/../parts/header.view.php'; ?>

    <main>
        <section class="titulo titulo_portada">
            <h2>PEDIDOS ENTRANTES</h2>
            <p>Nuestras hamburguesas te esperan cerca tuyo</p>
        </section>

        <section class="pedidos-grid">

            <?php if (isset($error['description'])) : ?>
                <h4 class="msj msj_error">
                    <?= $error['description']; ?>
                </h4>
            <?php endif ?>
            <?php foreach ($pedidos as $pedido): ?>
                <article class="pedido-item status-<?= strtolower($pedido['estado']); ?>">
                <h2 class="pedido-titulo">Pedido #<?= str_pad($pedido['id'], 4, '0', STR_PAD_LEFT); ?></h2>
                    <div class="pedido-datos">
                        <p>Fecha/Hora: <?= $pedido['created_at']; ?></p>
                        <p>Tipo: <?= $pedido['tipo']; ?></p>
                        <p>Dirección: <?= $pedido['direccion']; ?></p>
                        <p>Monto Total: $ <?= number_format($pedido['monto_total'], 2, ',', '.'); ?></p>
                        <p>Método de Pago: <?= $pedido['metodo_pago']; ?></p>
                        <p class="status">Estado: <?= $pedido['estado']; ?></p>
                    </div>
                    <div class="acciones">
                        <a href="/pedidos/estado?id=<?= $pedido['id'] ?>" class="icon icon_detalle">Aceptar</a>
                    </div>
                </article>
            <?php endforeach; ?>
        </section>
    </main>

    <?php require __DIR__ . '/../parts/footer.view.php'; ?>
</body>

</html>
