<!DOCTYPE html>
<html lang="es">

<head>

<?php require __DIR__.'/parts/head.view.php' ?>

</head>

<body>
    
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

        <h2 class="titulo titulo_amarillo">Registrar Usuario</h2>

        <form action="registro">

            <h3>Bienvenido</h3>

            <label for="email">Ingrese su email</label>
            <input required type="text" name="email" id="email">

            <label for="nombre">Ingrese su nombre completo</label>
            <input required type="text" name="nombre" id="nombre">

            <label for="contrasenia">Ingrese Password</label>
            <input required type="text" name="password" id="contrasenia">

            <label for="password_repetida">Confirme el Password</label>
            <input required type="password" name="password_repetida" id="password_repetida">

            <input type="submit" value="registrar_usuario">

        </form>

    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>