<!DOCTYPE html>
<html lang="es">

<head>

<?php require __DIR__.'/parts/head.view.php' ?>

</head>

<body>
    
    <?php require __DIR__.'/parts/header.view.php' ?>

<main>

        <section class="titulo titulo_portada">
            <h2>UNITE A NUESTRO EQUIPO</h2>
            <p>Se parte de esta gran equipo</p>
        </section>


        <section class="section_formulario">
            <form action="/contactanos" method="post" class="formulario form_transparente">
                <h3 class="titulo_form_unite">COMPLETÁ EL FORMULARIO</h3>

                <label for="email" class="etiqueta">Ingrese su email</label>
                <input required type="text" name="email" id="email" class="campo">

                <label for="nombre" class="etiqueta">Ingrese su Nombre y Apellido</label>
                <input required type="text" name="nombre" id="nombre" class="campo">

                <label for="telefono" class="etiqueta">Ingrese su Telefono de Contacto</label>
                <input required type="number" name="telefono" id="telefono" class="campo">

                <label for="cv" class="etiqueta">Adjunte su CV</label>
                <input type="file" id="cv" name="archivo" accept=".pdf, .doc, .docx" class="campo">

                <input type="submit" value="ENVIAR" class="boton boton_enviar_unete">
            </form>
        </section>



    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>