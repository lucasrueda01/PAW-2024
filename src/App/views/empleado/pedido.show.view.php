<!DOCTYPE html>
<html lang="es">

<head>

<?php require __DIR__.'\../parts/head.view.php' ?>

</head>

<body>
    
    <?php require __DIR__.'\../parts/header.view.php' ?>

<main>

        <section class="titulo titulo_portada">
            <h2>DETALLE PEDIDO</h2>
            <p>Estado del pedido y gestion</p>
        </section>
        <?php if (isset($pedido['Nro Pedido'])) :?>

        <section class="detalles_pedido">
            
                <h3 class="nro_pedido">#0000<?= $pedido['Nro Pedido']; ?></h3>
                <p class="detalle"><?= $pedido['Fecha/Hora']; ?></p>
                <p class="detalle"><?= $pedido['Tipo']; ?></p>
                <p class="detalle"><?= $pedido['Direccion']; ?></p>
                <p class="detalle"><?= $pedido['Monto Total']; ?></p>
                <p class="detalle"><?= $pedido['Metodo de Pago']; ?></p>
                <p class="detalle"><?= $pedido['Estado']; ?></p>
                
                <a class="btn_accion">ACEPTAR</a>
                <a class="btn_accion">FINALIZAR</a>
                <a class="btn_accion">RECHAZAR</a>
                <a class="btn_accion">LISTO PARA RETIRAR</a>
                <a class="btn_accion">EN VIAJE</a>
            
        </section>
  
        <?php endif ?>  
        
    </main>

    <?php require __DIR__.'\../parts/footer.view.php' ?>

</body>

</html>