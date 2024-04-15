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


            <form action="/reservar_cliente" class="form_reserva">
                <fieldset class="container container_formulario container_delivery">
                    <label for="nombre">Ingrese su nombre completo</label>
                    <input type="text" name="nombre" id="nombre">
                    <label for="dni">Ingrese su DNI</label>
                    <input type="text" name="dni" id="dni">
                    <label for="sucursal">Selecciona una sucursal:</label>
                    <select id="sucursal" name="sucursal">
                        <option value="sucursal1">Sucursal 1</option>
                        <option value="sucursal2">Sucursal 2</option>
                        <option value="sucursal3">Sucursal 3</option>
                        <option value="sucursal4">Sucursal 4</option>
                    </select>
                    <label for="date">Seleccione fecha:</label>
                    <input type="date" name="time" id="date">
                    <label for="time">Seleccione hora:</label>
                    <input type="time" name="time" id="time">
                    <label for="mesas_disponibles">Mesas Disponibles</label>
                    <select name="mesas_disponibles" id="mesas_disponibles">
                        <option value="mesa-s1">Mesa Salon 1</option>
                        <option value="mesa-s2">Mesa Salon 2</option>
                        <option value="mesa-pf1">Mesa Pet Friendly 1</option>
                        <option value="mesa-pf2">Mesa Pet Friendly 1</option>
                    </select>

                    <aside class="resumen">
                        <h4 class="titulo_resumen">Resumen de reserva</h4>
                        <ul>
                            <li>Nombre del usuario</li>
                            <li>DNI: 12.456.789</li>
                            <li>Sucursal elegida: Av. de Mayo 450</li>
                            <li>Fecha: 05/03/2023</li>
                            <li>Hora: 12:45 hs</li>
                            <li>Mesa elegida: A45</li>
                        </ul>
                    </aside>

                    <input type="submit" value="Reservar" class="boton boton_verde">
                </fieldset>

            </form>
        </section>
    </main>

    <?php require __DIR__ . '\../parts/footer.view.php' ?>

</body>

</html>