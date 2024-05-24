<!DOCTYPE html>
<html lang="es">

<head>
    <?php require __DIR__ . '/parts/head.view.php'; ?>
</head>

<body>

    <?php require __DIR__ . '/parts/header.view.php'; ?>

    <main>

        <!--CONTENIDO DE LA VIEW PEDIDOS-->
        <section class="titulo titulo_portada">
            <h2>PEDIDOS</h2>
            <p>Nuestras hamburguesas te esperan cerca tuyo</p>
        </section>

        <?php require __DIR__ . '/parts/formulario-pedido.view.php'; ?>

    </main>

    <?php require __DIR__ . '/parts/footer.view.php'; ?>