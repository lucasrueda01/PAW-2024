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
        
        <?php if (isset($pedido['Nro Pedido'])) :?>

            <section class="detalles_pedido">

                <h2 class="nro_pedido" id="pedido-nro-<?= $pedido['Nro Pedido']; ?>">Pedido Nro: #0000<?= $pedido['Nro Pedido']; ?></h2>
                <p class="detalle"><strong>Fecha/Hora:</strong> <?= $pedido['Fecha/Hora']; ?></p>
                <p class="detalle"><strong>Tipo:</strong> <?= $pedido['Tipo']; ?></p>
                <p class="detalle"><strong>Nombre:</strong> <?= empty($pedido['Nombre']) ? '(No especificado)' : $pedido['Nombre']; ?></p>
                <p class="detalle"><strong>Método de Pago:</strong> <?= $pedido['Metodo de Pago']; ?></p>
                <p class="detalle"><strong>Dirección:</strong> <?= empty($pedido['Direccion']) ? '(No especificado)' : $pedido['Direccion']; ?></p>
                <p class="detalle"><strong>Observaciones:</strong> <?= empty($pedido['Observaciones']) ? '(No especificado)' : $pedido['Observaciones']; ?></p>
                <p class="detalle"><strong>Monto Total:</strong> $ <?= is_null($pedido['Monto Total']) ? '(No especificado)' : number_format($pedido['Monto Total'], 2, ',', '.'); ?></p>
                <p class="detalle estado" id="estado" data-estado="<?= $pedido['Estado']; ?>"><strong>Estado:</strong> <?= $pedido['Estado']; ?></p>

                <?php foreach($listaAcciones[$tipo][$pedido['Estado']] as $accion ): ?>
                    <a class="boton boton_negro" href="/pedidos/estado/modificar?id=<?= $pedido['Nro Pedido']; ?>&estado=<?= $urlsAccion[$accion]?>"><?= $accion ?></a>
                <?php endforeach; ?>    

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
                                <td><?= $articulo['nombre']; ?></td>
                                <td>$ <?= number_format($articulo['precio'], 2, ',', '.'); ?></td>
                                <td><?= $articulo['cantidad']; ?></td>
                                <td>$ <?= number_format($articulo['subtotal'], 2, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total:</td>
                            <td>$ <?= number_format($pedido['Monto Total'], 2, ',', '.'); ?></td>
                        </tr>
                    </tfoot>
                </table>

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
