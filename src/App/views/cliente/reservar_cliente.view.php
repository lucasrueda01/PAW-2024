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

            <?php if(isset($resultado['exito'])) : ?>
                <h4 class="msj msj_exito">
                    <?= $resultado['description']; ?>
                </h4>
            <?php elseif(isset($resultado['error'])): ?>
                <h4 class="msj msj_error">
                    <?= $resultado['description']; ?>
                </h4>        
            <?php endif ?>            

            <form action="/reservar_cliente" class="form_reserva" method="post">
                <fieldset class="container container_formulario container_delivery">
                    <label for="nombre">Ingrese su nombre completo</label>
                    <input type="text" name="nombre" id="nombre" required>
                    <label for="dni">Ingrese su DNI</label>
                    <input type="number" name="dni" id="dni" required>
                    <label for="sucursal">Selecciona una sucursal:</label>
                    <select id="sucursal" name="sucursal" required>
                        <option value="sucursal1">Sucursal 1</option>
                        <option value="sucursal2">Sucursal 2</option>
                        <option value="sucursal3">Sucursal 3</option>
                        <option value="sucursal4">Sucursal 4</option>
                    </select>
                    <label for="date">Seleccione fecha:</label>
                    <input type="date" name="time" id="date" required>
                    <label for="time">Seleccione hora:</label>
                    <input type="time" name="time" id="time" required>
                    <label for="mesas_disponibles">Mesas Disponibles</label>
                    <select name="mesas_disponibles" id="mesas_disponibles" required>
                        <option value="mesa-s1">Mesa Salon 1</option>
                        <option value="mesa-s2">Mesa Salon 2</option>
                        <option value="mesa-pf1">Mesa Pet Friendly 1</option>
                        <option value="mesa-pf2">Mesa Pet Friendly 1</option>
                    </select>

                    <aside class="resumen">
                        <h4 class="titulo_resumen">Resumen de reserva</h4>
                        <ul>
                          <?php  
                            if(isset($resultado['resumen'])) :
                              foreach ($resultado['resumen'] as $clave => $valor) : ?>

                             <li><?= ucfirst($clave) ?> : <?= $valor ?> </li>

                          <?php endforeach; 
                             endif;   
                          ?>                            
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