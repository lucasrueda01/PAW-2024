<!DOCTYPE html>
<html lang="es">

<head>

<?php require __DIR__.'/../parts/head.view.php' ?>

</head>

<body>
    
    <?php require __DIR__.'/../parts/header.view.php' ?>

<main>

        <section class="titulo titulo_portada">
            <h2>CARGA UN NUEVO PLATO</h2>
            <p>Envianos tu solicitud de nuevo plato</p>
        </section>

        <?php 
            if(isset($resultado['description'])) {
               var_dump($resultado['description']);
               echo("<pre>");
               var_dump($_POST);
               echo("<pre>");
            }
        ?>

        <section class="section_formulario">
            <form action="/datos_plato" method="post" class="formulario form_transparente">
                <h3 class="titulo_form_unite">COMPLETÁ EL FORMULARIO</h3>

                <label for="nombre_plato" class="etiqueta">Ingresa el nombre del plato</label>
                <input required type="text" name="nombre_plato" id="nombre_plato" class="campo">

                <label for="ingredientes" class="etiqueta">Indiquenos sus ingredientes</label>
                <textarea required name="ingredientes" id="ingredientes" cols="10" rows="10" class="campo"></textarea>


                <label for="imagen_plato" class="etiqueta">Cargue una imagen de ilustracion</label>
                <input type="file" id="cv" name="imagen_plato" accept=".jpeg, .png" class="campo">

                <input type="submit" value="ENVIAR" class="boton boton_enviar_unete">
            </form>
        </section>



    </main>

    <?php require __DIR__.'/../parts/footer.view.php' ?>

</body>

</html>