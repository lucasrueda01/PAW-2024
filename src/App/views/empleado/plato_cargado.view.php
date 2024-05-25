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


        <?php if(isset($resultado['exito'])) : ?>
            <section class="plato_subido">
                <h4 class="msj msj_exito">
                    <?= $resultado['description']; ?>
                </h4>
                <figure class="imagen_subida">
                <img src="/plato?id=<?= $newPlato->getId(); ?>" alt="<?= $newPlato->getNombrePlato(); ?>"> 
                    <figcaption>
                        <h3><?= $newPlato->getNombrePlato(); ?></h3>
                        <p><?= $newPlato->getIngredientes(); ?></p><br>
                    </figcaption>
                </figure>
                <a class="boton boton_negro" href="/plato/new">CARGAR OTRO PLATO</a>
            </section>
        <?php endif ?>
  
        </section>

    </main>

    <?php require __DIR__.'\../parts/footer.view.php' ?>

</body>

</html>