<!DOCTYPE html>
<html lang="es">

<head>

    <?php require __DIR__.'/parts/head.view.php' ?>
    
</head>

<body>
    
    <?php require __DIR__.'/parts/header.view.php' ?>

    <!--CONTENIDO DE LA VIEW NUESTRO MENU-->

    <main>

    <section class="titulo titulo_portada">
            <h2>PLATOS</h2>
            <p>Nuestras hamburguesas te esperan cerca tuyo</p>
    </section>   

    <table  class="tabla_gestion_mesa">
            <thead>
                <tr>
                    <th>Nombre Plato</th>
                    <th>Descripcion</th>
                    <th>Tipo Plato</th>
                    <th>Precio</th>
                    <th>Path Img</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($platos as $plato) : ?>

                    <tr>
                        <td><a href="/plato?id=<?= $plato->fields['id'] ?>"><?= $plato->fields['nombre_plato'] ?></a></td>                        
                        <td><?= $plato->fields['descripcion'] ?></td>
                        <td><?= $plato->fields['tipo_plato'] ?></td>
                        <td><?= $plato->fields['precio'] ?></td>
                        <td><?= $plato->fields['path_img'] ?></td>
                    </tr>

                <?php endforeach ?>   
            </tbody>

        </table>    

    </main>

    <?php require __DIR__.'/parts/footer.view.php' ?>

</body>

</html>    