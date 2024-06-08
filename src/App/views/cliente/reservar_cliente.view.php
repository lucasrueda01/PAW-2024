<!DOCTYPE html>
<html lang="es">

<head>

    <?php require __DIR__ . '\../parts/head.view.php' ?>

</head>

<body>

    <?php require __DIR__ . '\../parts/header.view.php' ?>

    <main>

        <section class="titulo titulo_portada">
            <h2>RESERVAR</h2>
            <p>Nuestras hamburguesas te esperan cerca tuyo</p>
        </section>

        <section>

            <?php if(isset($resultado['success'])) : ?>
                <h4 class="msj msj_exito">
                    <?= $resultado['message']; ?>
                    <a href="/ver_mi_reserva">Ver mi Reserva</a>
                </h4>
            <?php elseif(isset($resultado['success'])): ?>
                <h4 class="msj msj_error">
                    <?= $resultado['message']; ?>
                </h4>        
            <?php endif ?>            

            <form action="/reservar_cliente" class="form_reserva" id="formReserva" method="post">
                <fieldset class="container container_formulario container_delivery">
                    <label for="nombre">Ingrese su nombre completo</label>
                    <input type="text" name="nombre" id="nombre" required>
                    <label for="dni">Ingrese su DNI</label>
                    <input type="number" name="dni" id="dni" required>
                    <label for="local">Selecciona un local:</label>
                    <p class="control_input campo_local"></p> <!-- controles de input, estaran en hidden --> 
                    <select id="local" name="local" required>
                        <option value="ninguna">Ninguna Seleccionada</option>
                        <option value="1">Local A</option>
                        <option value="2">Local B</option>
                    </select>
                    <p class="control_input campo_fecha"></p> <!-- controles de input, estaran en hidden --> 
                    <label for="date">Seleccione fecha:</label>
                    <input type="date" name="date" id="date" required>
                    <p class="control_input campo_hora"></p>  <!-- controles de input, estaran en hidden -->
                     <label for="time">Seleccione hora:</label>
                    <input type="time" name="time" id="time" required>
                    <label for="mesas_disponibles">Mesas Disponibles</label>
                    <p class="control_input campo_plano"></p>  <!-- controles de input, estaran en hidden -->
                    <?php require __DIR__ . '\../parts/plano.view.php' ?>

                    <input type="text" id="nromesa-elegida" name="nromesa-elegida">
                    
                    <input type="submit" value="Reservar" class="boton boton_verde">
                </fieldset>

            </form>
        </section>
    </main>

    <?php require __DIR__ . '\../parts/footer.view.php' ?>

</body>

</html>