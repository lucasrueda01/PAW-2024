<!DOCTYPE html>
<html lang="es">

<head>

    <?php require __DIR__.'/parts/head.view.php' ?>

</head>

<body class="home">

    <?php require __DIR__.'/parts/header.view.php' ?>

    <main>

        <section class="imagen portada_sitio"> <!--Seccion Portada del sitio, va a estar en la mayoria de los sitios-->
            <!--acá esta la imagen de la portada
                                mas el anchor al home y
                                los dos enlaces al menu y reserva
                            -->
            <!-- LOGO -->
            <h2 class="logo logo_grande">Home</h2>
            <h2><a href="nuestro_menu.html" class="boton boton_amarillo" target="_blank">Menu</a></h2>
            <h2><a href="reservar_cliente.html" class="boton boton_amarillo" target="_blank">Reservar</a></h2>
        </section>

        <h2 class="titulo titulo_amarillo">Login</h2>

        <form action="iniciar_sesion" class="formulario form_amarillo">

            <h3> Bienvenido</h3>

            <label for="nombre" class="etiqueta">USUARIO</label>
            <input required type="text" name="username" id="nombre" class="campo">
            <label for="contrasenia" class="etiqueta">PASSWORD</label>
            <input required type="text" name="password" id="contrasenia" class="campo">
            <input type="submit" value="iniciar sesion" class="campo">
            <p>¿No tenes cuenta? <a href="#">Registrate aca</a> </p>
        </form>

    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>