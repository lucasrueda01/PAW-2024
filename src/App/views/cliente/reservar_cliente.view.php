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
                    <label for="local">Selecciona un local:</label>
                    <select id="local" name="local" required>
                        <option value="ninguna">Ninguna Seleccionada</option>
                        <option value="local-avellaneda">Local Avellaneda</option>
                        <option value="local-2">Local 2</option>
                        <option value="local-3">Local 3</option>
                        <option value="local-4">Local 4</option>
                    </select>
                    <label for="date">Seleccione fecha:</label>
                    <input type="date" name="time" id="date" required>
                    <label for="time">Seleccione hora:</label>
                    <input type="time" name="time" id="time" required>
                    <label for="mesas_disponibles">Mesas Disponibles</label>

                        

                    <?php require __DIR__ . '\../parts/plano.view.php' ?>

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

                    <object type="image/svg+xml" data="/assets/imgs/svg/PlanoSucursalA.svg" id="planoDelLocal"></object>

                    <input type="submit" value="Reservar" class="boton boton_verde">
                </fieldset>

            </form>
        </section>
    </main>

    <?php require __DIR__ . '\../parts/footer.view.php' ?>

</body>

</html>