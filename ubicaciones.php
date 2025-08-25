<?php
$locations = [
    [
        "name" => "Glorieta de La Minerva",
        "url" => "https://www.google.com.mx/maps/embed?pb=!1m18!1m12!1m3!1d3732.674938572104!2d-103.3899931!3d20.6743943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428b1fb67ef00ad%3A0x565792d14c620e!2sGlorieta%20de%20La%20Minerva!5e0!3m2!1ses-419!2smx!4v1689825557774!5m2!1ses-419!2smx"
    ],
    [
        "name" => "Andares Centro Comercial",
        "url" => "https://www.google.com.mx/maps/embed?pb=!1m18!1m12!1m3!1d3732.8320919752783!2d-103.4145426!3d20.7104414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428aefd86a6e48d%3A0xee86b7bd74920eeb!2sAndares%20Centro%20Comercial!5e0!3m2!1ses-419!2smx!4v1689825647345!5m2!1ses-419!2smx"
    ],
    [
        "name" => "Centro de Guadalajara",
        "url" => "https://www.google.com.mx/maps/embed?pb=!1m18!1m12!1m3!1d3732.690732472273!2d-103.3497885!3d20.6762083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8428b1bdb0074459%3A0x3f15de3380d225c1!2sCentro%20de%20Guadalajara!5e0!3m2!1ses-419!2smx!4v1689825712345!5m2!1ses-419!2smx"
    ]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubicaciones de Recolección/Entrega de Vehículos</title>
    <link rel="stylesheet" href="styleubicacion.css">
</head>
<body>
<header>
    <div class="menu-container">
        <div class="logo">
            <img src="imagenes/LOGO.png" alt="Logo de la página">
        </div>
        <?php
        $menuItems = array(
            array("Catálogo", "CatalogoCoches.php"),
            array("Reserva", "prueba.php"),
            array("Ubicaciones", "ubicaciones.php"),
            array("Iniciar sesión", "login.php")
        );
        ?>
        <ul class="menu">
            <?php foreach ($menuItems as $item): ?>
                <li><a href="<?php echo $item[1]; ?>"><?php echo $item[0]; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</header>
<div class="d-grid">
    <h1>Explora sin límites con LDR Cars.</h1>
</div>
<div class="container">
    <h1>Ubicaciones para Recolección/Entrega de Vehículos</h1>
    <div class="locations">
        <?php foreach ($locations as $location): ?>
            <div class="location">
                <h2><?php echo $location["name"]; ?></h2>
                <iframe src="<?php echo $location["url"]; ?>" allowfullscreen></iframe>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
