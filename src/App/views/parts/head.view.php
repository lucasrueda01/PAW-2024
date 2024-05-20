<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="/assets/css/base.css">
<link rel="stylesheet" href="/assets/css/cliente.css">
<link rel="stylesheet" href="/assets/css/empleado.css">
<script src="/assets/js/components/paw.js"></script>
<script src="/assets/js/app.js"></script>
<link rel="shortcut icon" href="/assets/imgs/svg/Imagotipo_PAWPOWER.svg" type="image/svg+xml">
<title><?= $titulo ?? "Proyecto PAW" ?></title>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Restaurant",
        "name": "Casa de Comidas Rapidas",
        "image": "https://www.pawpower.com/Imagotipo_PAWPOWER.svg",
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Calle SiempreViva 123",
            "addressLocality": "Ciudad CABA",
            "addressRegion": "CABA",
            "postalCode": "1234",
            "addressCountry": "AR"
        },
        "telephone": "+54 123 456 789",
        "servesCuisine": ["Argentina", "Porteña"],
        "priceRange": "$$",
        "url": "https://www.pawpower.com",
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.5",
            "reviewCount": "27"
        },
        "menu": "https://www.pawpower.com/menu",
        "openingHours": [
            "Mo-Su 09:00-21:00"
        ],
        "acceptsReservations": true
    }
    </script>