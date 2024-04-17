<!DOCTYPE html>
<html lang="es">

<head>

    <?php require __DIR__.'/parts/head.view.php' ?>

</head>

<body class="home">

    <?php require __DIR__.'/parts/header.view.php' ?>

    <main>

        <section class="titulo titulo_portada">
            <h2>INICIAR SESION</h2>
            <p>Para acceder a nuestros servicios</p>
        </section>

        <section class="section_formulario">
            <form action="/iniciar_sesion" class="formulario form_amarillo" method="post">

                <h3 class="titulo_form_unite">BIENVENIDO</h3>

            <label for="nombre" class="etiqueta">USUARIO</label>
            <input required type="text" name="username" id="nombre" class="campo">
            <label for="contrasenia" class="etiqueta">PASSWORD</label>
            <input required type="text" name="password" id="contrasenia" class="campo">
            <input type="submit" value="iniciar sesion" class="boton boton_negro">
            <p>¿No tenes cuenta? <a href="/registrar_usuario">Registrate aca</a> </p>
        </form>

    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>