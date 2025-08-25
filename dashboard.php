<?php
// Inicia la sesión
session_start();

// Verifica si el usuario ha iniciado sesión
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard-container">
        <h2>Bienvenido al Dashboard</h2>
        <p>Hola, <?php echo htmlspecialchars($_SESSION["nombre"]); ?>.</p>
        <p><a href="logout.php">Cerrar sesión</a></p>
    </div>
</body>
</html>
