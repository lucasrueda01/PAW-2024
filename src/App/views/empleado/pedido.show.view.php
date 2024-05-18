<!DOCTYPE html>
<html lang="es">

<head>

<?php require __DIR__.'\../parts/head.view.php' ?>

</head>

<body>
    
    <?php require __DIR__.'\../parts/header.view.php' ?>

<main class="container_detalle">

        <section class="titulo titulo_portada">
            <h2>DETALLE PEDIDO</h2>
            <p>Estado del pedido y gestion</p>
        </section>
        <?php if (isset($pedido['Nro Pedido'])) :?>

            <div class="detalles_pedido">
                <h2 class="nro_pedido" id="pedido-nro-<?= $pedido['Nro Pedido']; ?>">#0000<?= $pedido['Nro Pedido']; ?></h2>
                <p class="detalle"><strong>Fecha/Hora:</strong> <?php echo $pedido['Fecha/Hora']; ?></p>
                <p class="detalle"><strong>Tipo:</strong> <?php echo $pedido['Tipo']; ?></p>
                <p class="detalle"><strong>Nombre:</strong> <?php echo empty($pedido['Nombre']) ? '(No especificado)' : $pedido['Nombre']; ?></p>
                <p class="detalle"><strong>Método de Pago:</strong> <?php echo $pedido['Metodo de Pago']; ?></p>
                <p class="detalle"><strong>Dirección:</strong> <?php echo empty($pedido['Direccion']) ? '(No especificado)' : $pedido['Direccion']; ?></p>
                <p class="detalle"><strong>Observaciones:</strong> <?php echo empty($pedido['Observaciones']) ? '(No especificado)' : $pedido['Observaciones']; ?></p>
                <p class="detalle"><strong>Monto Total:</strong> <?php echo is_null($pedido['Monto Total']) ? '(No especificado)' : $pedido['Monto Total']; ?></p>
                <p class="detalle" id="estado"><strong>Estado:</strong> <?php echo $pedido['Estado']; ?></p>

                <?php foreach($listaAcciones[$pedido['Estado']] as $accion ): ?>
                    <a class="boton boton_negro" href="/pedidos/estado/modificar?id=<?= $pedido['Nro Pedido']; ?>&estado=<?= $urlsAccion[$accion]?>"><?= $accion ?></a>
                <?php endforeach; ?>    

                <h3 class="nro_pedido">Artículos:</h3>
                <ul>
                    <?php foreach ($pedido['articulos'] as $articulo) : ?>
                        <li class="detalle">Artículo ID: <?php echo $articulo['id_plato']; ?>, Cantidad: <?php echo $articulo['cantida']; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        
        <?php else : ?>  

            <h4 class="msj msj_error">
                <?= $resultado['error']; ?>
            </h4>

        <?php endif ?>  
        
    </main>

    <?php require __DIR__.'\../parts/footer.view.php' ?>

</body>

</html>