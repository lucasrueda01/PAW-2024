<!DOCTYPE html>
<html lang="es">
<head>
    <?php require __DIR__.'/parts/head.view.php' ?>
</head>
<body>
    <?php require __DIR__.'/parts/header.view.php' ?>
    <main>
        <section class="titulo titulo_portada">
            <h2>PERFIL PERSONAL</h2>
            <p>Aquí podrás ver tus datos personales</p>
        </section>
        
        <section>
            <h3>Mis Datos</h3>
            <ul>
            <li>Nombre de usuario: <?= htmlspecialchars($usuario['username'] ?? 'No hay') ?></li>
                <li>Email: <?= htmlspecialchars($usuario['email'] ?? 'No hay') ?></li>
                <li>Tipo: <?= htmlspecialchars($usuario['tipo'] ?? 'No hay') ?></li>
            </ul>
        </section>
    </main>
    <?php require __DIR__.'/parts/footer.view.php' ?>
</body>
</html>
