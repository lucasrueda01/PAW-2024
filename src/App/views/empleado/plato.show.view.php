<!DOCTYPE html>
<html lang="es">

<head>

<?php require __DIR__.'\../parts/head.view.php' ?>

</head>

<body>
    
    <?php require __DIR__.'\../parts/header.view.php' ?>

<main>

        <section class="titulo titulo_portada">
            <h2>NUEVO PLATO</h2>
            <p>Plato agregado al menu</p>
        </section>

        <?php if(isset($resultado['error'])) : ?>
                <h4 class="msj msj_error">
                <?= $resultado['description']; ?>
                </h4>
        <?php endif ?>

        <?php if(isset($plato)) : ?>
            <section class="plato_subido">
                <figure class="imagen_subida">
                    <img src="data:image/png;base64,<?= $plato->getImagenPlatoBase64(); ?>" alt="<?= $plato->getNombrePlato(); ?>">
                    <figcaption>
                        <h3><?= $plato->getNombrePlato(); ?></h3>
                        <p><?= $plato->getIngredientes(); ?></p><br>
                    </figcaption>
                </figure>
                <a class="boton boton_negro" href="/nuevo_plato">CARGAR OTRO PLATO</a>
            </section>
        <?php endif ?>
  
        </section>

    </main>

    <?php require __DIR__.'\../parts/footer.view.php' ?>

</body>

</html>