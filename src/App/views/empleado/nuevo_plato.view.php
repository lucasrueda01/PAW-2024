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
            <p>Agrega un plato al menu</p>
        </section>

        <section class="section_formulario">
            <form action="/datos_plato" method="post" enctype="multipart/form-data" class="formulario form_transparente">

                <h3 class="titulo_form_unite">COMPLETÁ EL FORMULARIO</h3>

                <label for="nombre_plato" class="etiqueta">Ingresa el nombre del plato</label>
                <input required type="text" name="nombre_plato" id="nombre_plato" class="campo">

                <label for="ingredientes" class="etiqueta">Descripcion del plato</label>
                <textarea required name="ingredientes" id="ingredientes" cols="10" rows="10" class="campo"></textarea>
                
                <label for="tipo_plato" class="etiqueta">Tipo de Plato</label>
                <select name="tipo_de_plato" id="tipo_de_plato" class="campo">
                    <option value="burger">Hamburguesa</option>
                    <option value="bebida">Bebida</option>
                    <option value="otros">Otros Platos</option>
                </select>

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