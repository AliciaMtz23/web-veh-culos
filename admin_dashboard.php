<!DOCTYPE html>
<html lang="en">
<head>
<link href="style.css" rel="stylesheet"> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            array("Ubicaciones", "services.php"),
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
</body>
</html>