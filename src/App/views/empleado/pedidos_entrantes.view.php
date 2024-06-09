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

        <section class="pedidos-grid">

            <?php if (isset($error['description'])) : ?>
                <h4 class="msj msj_error">
                    <?= $error['description']; ?>
                </h4>
            <?php endif ?>
            <?php foreach ($pedidos as $pedido): ?>
                <article class="pedido-item status-<?= str_replace(' ', '-', strtolower($pedido['current_status'])); ?>" id="pedido-<?= $pedido['id'] ?>">
                <h2 class="pedido-titulo">Pedido #<?= str_pad($pedido['id'], 4, '0', STR_PAD_LEFT); ?></h2>

                        <p>Fecha/Hora: <?= $pedido['created_at']; ?></p>
                        <p>Tipo: <?= $pedido['tipo']; ?></p>
                        <p>Dirección: <?= $pedido['direccion']; ?></p>
                        <p>Monto Total: $ <?= number_format($pedido['monto_total'], 2, ',', '.'); ?></p>
                        <p>Método de Pago: <?= $pedido['metodo_pago']; ?></p>
                        <p>Estado Actual: <?= $pedido['current_status']; ?></p>
                        <?php if ($pedido['estado_id'] != 5): ?>
                            <a href="#" class="boton boton_accion" id="actualizarEstadoBtn-<?= $pedido['id'] ?>" data-id="<?= $pedido['id'] ?>" data-estado="<?= $pedido['estado_id'] ?>">Pasar a: <?= $pedido['next_status']; ?></a>  
                        <?php else: ?>
                            <p class="cartel-finalizado">PEDIDO COMPLETADO</p>
                            <p class="cartel-finalizado">(Pasar a Retirar)</p>
                        <?php endif; ?>
                </article>
            <?php endforeach; ?>
        </section>
    </main>

    <?php require __DIR__ . '/../parts/footer.view.php'; ?>
</body>

</html>
