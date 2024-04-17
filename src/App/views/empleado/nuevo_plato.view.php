<!DOCTYPE html>
<html lang="es">

<head>

<?php require __DIR__.'\../parts/head.view.php' ?>

</head>

<body>
    
    <?php require __DIR__.'\../parts/header.view.php' ?>

<main>

        <section class="titulo titulo_portada">
            <h2>CARGA UN NUEVO PLATO</h2>
            <p>Envianos tu solicitud de nuevo plato</p>
        </section>

        <?php if(isset($resultado['exito'])) : ?>
            <h4 class="msj msj_exito">
                   <?= $resultado['description']; ?>
            </h4>
            <figure class="imagen_subida">
                <img src="/<?= $resultado['path_imagen'] ?>" alt="comida">
                <figcaption>
                    <h3><?= $resultado['nombre_comida'] ?></h3>
                    <p><?= $resultado['ingredientes_comida'] ?></p><br>
                </figcaption>
            </figure>
        <?php endif ?>


        <section class="section_formulario">
            <form action="/datos_plato" method="post" enctype="multipart/form-data" class="formulario form_transparente">

                <h3 class="titulo_form_unite">COMPLETÁ EL FORMULARIO</h3>

                <label for="nombre_plato" class="etiqueta">Ingresa el nombre del plato</label>
                <input required type="text" name="nombre_plato" id="nombre_plato" class="campo">

                <label for="ingredientes" class="etiqueta">Descripcion del plato</label>
                <textarea required name="ingredientes" id="ingredientes" cols="10" rows="10" class="campo"></textarea>


                <label for="imagen_plato" class="etiqueta">Cargue una imagen de ilustracion</label>
                <input type="file" id="imagen_plato" name="imagen_plato" accept=".jpeg, .png" class="campo">

                <input type="submit" value="ENVIAR" class="boton boton_enviar_unete">
            </form>

            <?php if(isset($resultado['error'])) : ?>
                <h4 class="msj msj_error">
                <?= $resultado['description']; ?>
                </h4>
            <?php endif ?>

        </section>

    </main>

    <?php require __DIR__.'\../parts/footer.view.php' ?>

</body>

</html>