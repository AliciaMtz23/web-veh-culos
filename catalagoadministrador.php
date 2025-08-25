<?php


// Configuración de la conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$password = "";
$db = "renta";
$conexion = mysqli_connect($servidor, $usuario, $password, $db) or die(mysqli_error($conexion));

// Verificar conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Procesamiento del formulario para agregar un nuevo vehículo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar_vehiculo'])) {
    $marca = $_POST["marca"];
    $modelo = $_POST["modelo"];
    $descripcion = $_POST["descripcion"];
    $pasajeros = $_POST["pasajeros"];
    $precio = $_POST["precio"];
    $imagen = $_FILES["imagen"]["name"];
    $target_dir = "imagenes/";
    $target_file = $target_dir . basename($imagen);

    // Subir imagen
    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
        $sql_insert = "INSERT INTO vehiculos (marca, modelo, descripcion, pasajeros, precio, imagen) VALUES ('$marca', '$modelo', '$descripcion', $pasajeros, $precio, '$target_file')";

        if ($conexion->query($sql_insert) === TRUE) {
            echo "<script>alert('Vehículo agregado exitosamente.');</script>";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conexion->error;
        }
    } else {
        echo "<script>alert('Hubo un error al subir la imagen.');</script>";
    }
}

// Procesamiento del formulario para eliminar un vehículo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_vehiculo'])) {
    $id = $_POST["id"];

    $sql_delete = "DELETE FROM vehiculos WHERE id = $id";
    if ($conexion->query($sql_delete) === TRUE) {
        echo "<script>alert('Vehículo eliminado exitosamente.');</script>";
    } else {
        echo "Error: " . $sql_delete . "<br>" . $conexion->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Catálogo de Vehículos</title>
    <link rel="stylesheet" href="styleadmin.css">
</head>
<body>
<header>
    <div class="menu-container">
        <div class="logo">
            <img src="imagenes/LOGO.png" alt="Logo de la página">
        </div>
        <ul class="menu">
            <li><a href="CatalogoCoches.php">Catálogo</a></li>
            <li><a href="login.php">Iniciar sesión</a></li>
        </ul>
    </div>
</header>
<div class="admin-container">
    <h1>Administrar Catálogo de Vehículos</h1>

    <div class="form-container">
        <h2>Agregar Vehículo</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="marca" placeholder="Marca" required>
            <input type="text" name="modelo" placeholder="Modelo" required>
            <textarea name="descripcion" placeholder="Descripción" required></textarea>
            <input type="number" name="pasajeros" placeholder="Pasajeros" required>
            <input type="number" name="precio" placeholder="Precio" required>
            <input type="file" name="imagen" required>
            <button type="submit" name="agregar_vehiculo">Agregar Vehículo</button>
        </form>
    </div>

    <div class="vehiculos-container">
        <h2>Vehículos Disponibles</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Descripción</th>
                    <th>Pasajeros</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql_select = "SELECT * FROM vehiculos";
                $result = $conexion->query($sql_select);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . (isset($row["marca"]) ? $row["marca"] : '') . "</td>";
                        echo "<td>" . (isset($row["modelo"]) ? $row["modelo"] : '') . "</td>";
                        echo "<td>" . (isset($row["descripcion"]) ? $row["descripcion"] : '') . "</td>";
                        echo "<td>" . (isset($row["pasajeros"]) ? $row["pasajeros"] : '') . "</td>";
                        echo "<td>" . $row["precio"] . "</td>";
                        echo "<td><img src='" . $row["imagen"] . "' alt='Imagen del vehículo' class='vehicle-image'></td>";
                        echo "<td>";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='id' value='" . $row["id"] . "'>";
                        echo "<button type='submit' name='eliminar_vehiculo'>Eliminar</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No hay vehículos disponibles.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
