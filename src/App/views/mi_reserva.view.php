<!DOCTYPE html>
<html lang="es">
<head>
    <?php require __DIR__.'/parts/head.view.php' ?>

</head>
<body>
    <?php require __DIR__.'/parts/header.view.php' ?>
    <main class="mi_reserva">
        <section class="titulo titulo_portada">
            <h2>MIS RESERVAS</h2>
            <p>Aquí podrás ver los detalles de tus reservas</p>
        </section>
        
        <section class="mi_reserva_content">
            <h3>Detalles de la Reserva</h3>
            <ul>
                <li>ID de Reserva: <?= htmlspecialchars($reserva['id'] ?? 'No disponible') ?></li>
                <li>Fecha de Reserva: <?= htmlspecialchars($reserva['fecha'] ?? 'No disponible') ?></li>
                <li>Hora de Reserva: <?= htmlspecialchars($reserva['hora_inicio'] ?? 'No disponible') ?></li>
                
                <li id="nombre_mesa" data-id="<?= htmlspecialchars($reserva['nombre_mesa']);?>">Mesa Nro: <?= ucwords(str_replace('-', ' ', $reserva['nombre_mesa'])) ?></li>
                <?php require __DIR__ . '/parts/plano.view.php' ?>
            </ul>
        </section>
    </main>
    <?php require __DIR__.'/parts/footer.view.php' ?>
</body>
</html>
