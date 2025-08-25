<!DOCTYPE html>
<html lang="en">
<head>
    <link href="style.css" rel="stylesheet">   
    <title>Formulario de Reserva</title>
</head>
<body>
<header>
    <div class="menu-container">
        <div class="logo">
            <img src="imagenes/LOGO.png" alt="Logo de la pagina">
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

<h1>Formulario de Reserva</h1>

<div class="form-container">
    <form action="procesar_reserva.php" method="post">
        <div class="input-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
        </div>
        <div class="input-group">
            <label for="apellidos">Apellidos:</label>
            <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos">
        </div>
        <div class="input-group">
            <label for="edad">Edad:</label>
            <input type="number" name="edad" id="edad" placeholder="Edad" min="18" max="55">
        </div>
        <div class="input-group">
            <label for="identificacion">Identificación:</label>
            <select name="identificacion" id="identificacion">
                <option value="0">Seleccione una opción</option>
                <option value="1">INE</option>
                <option value="2">Pasaporte</option>
                <option value="3">Visa</option>
            </select>
        </div>
        <div class="input-group">
            <label for="correo">Correo electrónico:</label>
            <input type="email" name="correo" id="correo" placeholder="Correo electrónico">
        </div>
        <div class="input-group">
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion" id="direccion" placeholder="Dirección">
        </div>
        <div class="input-group">
            <label for="recoleccion">Recolección:</label>
            <select name="recoleccion" id="recoleccion">
                <option value="0">Seleccione una ubicación</option>
                <option value="1">La minerva</option>
                <option value="2">Andares</option>
                <option value="3">Centro de guadalajara</option>
            </select>
            <input type="date" name="fecha_recoleccion" id="fecha_recoleccion">
            <input type="time" name="hora_recoleccion" id="hora_recoleccion">
        </div>
        <div class="input-group">
            <label for="devolucion">Devolución:</label>
            <select name="devolucion" id="devolucion">
                <option value="0">Seleccione una ubicación</option>
                <option value="1">La minerva</option>
                <option value="2">Andares</option>
                <option value="3">Centro de guadalajara</option>
            </select>
            <input type="date" name="fecha_devolucion" id="fecha_devolucion">
            <input type="time" name="hora_devolucion" id="hora_devolucion">
        </div>
        <div class="input-group">
            <label for="pasajeros">Pasajeros:</label>
            <select name="pasajeros" id="pasajeros">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
        </div>
        <div class="input-group">
            <label for="vehiculo">Vehículo a rentar:</label>
            <select name="vehiculo" id="vehiculo">
                <?php
                // Conectar a la base de datos
                $conexion = new mysqli("localhost", "root", "", "renta");
                if ($conexion->connect_error) {
                    die("Error en la conexión: " . $conexion->connect_error);
                }
                // Obtener vehículos desde la base de datos
                $consulta = "SELECT id, Modelo FROM vehiculos";
                $resultado = $conexion->query($consulta);
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<option value='" . $fila['id'] . "'>" . $fila['Modelo'] . "</option>";
                    }
                }
                $conexion->close();
                ?>
            </select>
        </div>
        <button class="btn-reserva" type="submit" name="submit">Reservar</button>
    </form>
</div>
</body>
</html>


