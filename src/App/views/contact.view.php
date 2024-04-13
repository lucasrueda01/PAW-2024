<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <?php require __DIR__.'/parts/head.view.php' ?>
</head>
<body>
    <header>
        <h1><?= $titulo ?><h1>
    
        <?php require __DIR__ .'/parts/nav.view.php'; ?>        
    </header>
    <?php if ($procesado): ?>
        <div class="notification">
            Su peticion fue procesada con exito. <br>
            Nos pondremos en contacto con usted a la brevedad
        </div>
    <?php endif; ?>    
    <main>
        <h1><?= $main ?><h1>
        
        <form action="/contact" method="POST">
            <label for="subject"><strong>Asunto (*)</strong></label>
            <input type="text" name="subject">
            <label for="email"><strong>Correo (*)</strong></label>
            <input type="email" name="email">
            <label for="description"><strong>Descripción</strong></label>
            <textarea name="description" id="" cols="30" rows="10" col="30"></textarea>
            <input type="submit" name="submit" value="Enviar"> 
        </form>
    </main>

    
    
</body>
</html>