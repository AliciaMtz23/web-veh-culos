<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <title>Catálogo</title>
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
    <?php
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $db = "renta";
    $conexion = new mysqli($servidor, $usuario, $password, $db);
    if ($conexion->connect_error) {
        die("Error en la conexión: " . $conexion->connect_error);
    }

    $consulta = "SELECT * FROM vehiculos";
    $resultado = $conexion->query($consulta);
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo "<div class='vehicle'>";
            if (isset($fila['imagen'])) {
                echo "<img src='" . htmlspecialchars($fila['imagen']) . "' alt='Imagen del vehículo' class='vehicle-image'>";
            }
            if (isset($fila['Modelo'])) {
                echo "<h2>" . htmlspecialchars($fila['Modelo']) . "</h2>";
            }
            if (isset($fila['Marca'])) {
                echo "<p>Marca: " . htmlspecialchars($fila['Marca']) . "</p>";
            }
            if (isset($fila['Descripcion'])) {
                echo "<p>Descripción: " . htmlspecialchars($fila['Descripcion']) . "</p>";
            }
            if (isset($fila['Pasajeros'])) {
                echo "<p>Pasajeros: " . htmlspecialchars($fila['Pasajeros']) . "</p>";
            }
            if (isset($fila['precio'])) {
                echo "<p>Precio por día: $" . htmlspecialchars($fila['precio']) . "</p>";
            }
            echo "<a href='prueba.php?id=" . htmlspecialchars($fila['id']) . "' class='btn-reserva'>Reservar</a>";
            echo "</div>";
        }
    } else {
        echo "No se encontraron vehículos.";
    }
    $conexion->close();
    ?>
</div>
</body>
</html>


