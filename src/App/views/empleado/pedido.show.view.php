<!DOCTYPE html>
<html lang="es">

<head>

    <?php require __DIR__.'/../parts/head.view.php'; ?>

</head>

<body>
    
    <?php require __DIR__.'/../parts/header.view.php'; ?>

    <main class="container_detalle">

        <section class="titulo titulo_portada">
            <h2>DETALLE PEDIDO</h2>
            <p>Estado del pedido y gestión</p>
        </section>
        
        <?php if (isset($pedido['id'])) :?>

            <section class="detalles_pedido">

                <h2 class="nro_pedido" data-estado="<?= $pedido['id']; ?>" id="pedido-nro-<?= $pedido['id']; ?>">Pedido Nro: #0000<?= $pedido['id']; ?></h2>
                <p class="detalle"><strong>Fecha/Hora:</strong> <?= $pedido['created_at']; ?></p>
                <p class="detalle"><strong>Tipo:</strong> <?= $pedido['tipo']; ?></p>
                <p class="detalle"><strong>Nombre:</strong> <?= empty($pedido['nombre']) ? '(No especificado)' : $pedido['nombre']; ?></p>
                <p class="detalle"><strong>Método de Pago:</strong> <?= $pedido['metodo_pago']; ?></p>
                <p class="detalle"><strong>Dirección:</strong> <?= empty($pedido['direccion']) ? '(No especificado)' : $pedido['direccion']; ?></p>
                <p class="detalle"><strong>Observaciones:</strong> <?= empty($pedido['observaciones']) ? '(No especificado)' : $pedido['observaciones']; ?></p>
                <p class="detalle"><strong>Monto Total:</strong> $ <?= is_null($pedido['monto_total']) ? '(No especificado)' : number_format($pedido['monto_total'], 2, ',', '.'); ?></p>
                <p class="detalle estado" id="estado" data-estado="<?= $pedido['estado_id']; ?>"><strong>Estado:</strong> <?= $pedido['estado_name']; ?></p>               
                
                <table class="stacked-table">
                    <thead>
                        <tr>
                            <th>Nombre Comida</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pedido["articulos"] as $articulo) : ?>
                            <tr>
                                <td><?= $articulo['nombre_articulo']; ?></td>
                                <td>$ <?= number_format($articulo['precio'], 2, ',', '.'); ?></td>
                                <td><?= $articulo['cantidad']; ?></td>
                                <td>$ <?= number_format($articulo['subtotal'], 2, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total:</td>
                            <td>$ <?= number_format($pedido['monto_total'], 2, ',', '.'); ?></td>
                        </tr>
                    </tfoot>
                </table>

                <article id="notificationContainer">
                    <p id="notificationMessage">Quieres que te avise como va tu pedido? Dame permiso haciendo click en la campanita</p>
                    <img id="toggleIcon" src="assets/imgs/svg/campana-de-notificacion-off.svg" alt="Toggle Notifications" style="cursor: pointer;">
                </article>                

            </section>
        
        <?php else : ?>  

            <h4 class="msj msj_error">
                <?= $resultado['error']; ?>
            </h4>

        <?php endif; ?>  
        
    </main>

    <?php require __DIR__.'/../parts/footer.view.php'; ?>

</body>

</html>
