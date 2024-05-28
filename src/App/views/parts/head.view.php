<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/assets/css/base.css">
<link rel="stylesheet" href="/assets/css/cliente.css">
<link rel="stylesheet" href="/assets/css/empleado.css">
<script src="/assets/js/components/paw.js"></script>
<script src="/assets/js/app.js"></script>
<link rel="shortcut icon" href="/assets/imgs/svg/Imagotipo_PAWPOWER.svg" type="image/svg+xml">

    <!-- Content-Security-Policy -->
    <meta http-equiv="Content-Security-Policy" content="
        default-src 'self';
        style-src 'self';
        img-src 'self';
        font-src 'self';
        object-src 'none';
        base-uri 'self';
        form-action 'self';
        frame-ancestors 'self';
    ">
    
<title><?= $titulo ?? "Proyecto PAW" ?></title>

<?php require __DIR__.'/json-ld.view.php' ?>            