<?php
// Iniciar sesión antes de enviar cualquier salida
session_start();

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

// Procesamiento del formulario de inicio de sesión de usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_usuario'])) {
    // Obtener datos del formulario
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Consulta para verificar el usuario
    $sql = "SELECT id, nombre, password FROM usuarios WHERE email = '$email'";
    $resultado = $conexion->query($sql);

    // Verificar si el usuario existe
    if ($resultado->num_rows == 1) {
        $row = $resultado->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $row["password"])) {
            // Iniciar sesión y redirigir al usuario
            $_SESSION["loggedin"] = true;
            $_SESSION["id"] = $row["id"];
            $_SESSION["nombre"] = $row["nombre"];
            header("Location: prueba.php"); // Cambiado a prueba.php
            exit; // Salir del script después de redirigir
        } else {
            echo "<script>alert('El email o la contraseña son incorrectos.');</script>";
        }
    } else {
        echo "<script>alert('El email o la contraseña son incorrectos.');</script>";
    }
}

// Procesamiento del formulario de registro de nuevo usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registrar_nuevo'])) {
    // Obtener datos del formulario de registro
    $nombre_registro = $_POST["nombre_registro"];
    $email_registro = $_POST["email_registro"];
    $password_registro = $_POST["password_registro"];

    // Verificar si el correo ya está registrado
    $sql_check_email = "SELECT * FROM usuarios WHERE email = '$email_registro'";
    $result_check_email = $conexion->query($sql_check_email);

    if ($result_check_email->num_rows > 0) {
        echo "<script>alert('El correo electrónico ya está registrado.');</script>";
    } else {
        // hash de la contraseña
        $hashed_password = password_hash($password_registro, PASSWORD_DEFAULT);

        // Insertar nuevo usuario en la base de datos
        $sql_insert_user = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre_registro', '$email_registro', '$hashed_password')";

        if ($conexion->query($sql_insert_user) === TRUE) {
            echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.');</script>";
        } else {
            echo "Error: " . $sql_insert_user . "<br>" . $conexion->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión o Registrarse</title>
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>
<header>
    <div class="menu-container">
        <div class="logo">
            <img src="imagenes/LOGO.png" alt="Logo de la página">
        </div>
        <?php
        // Definir elementos del menú
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
<div class="login-container">
    <div class="button-container" id="btns-container">
        <button id="btn-login">Iniciar Sesión</button>
        <button id="btn-registro">Registrarse</button>
    </div>

    <!-- Formulario de inicio de sesión -->
    <div id="form-login" class="form-container" style="display: none;">
        <h2>Iniciar Sesión</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit" name="login_usuario">Iniciar Sesión</button>
        </form>
    </div>

    <!-- Formulario de registro -->
    <div id="form-registro" class="form-container" style="display: none;">
        <h2>Registrarse</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" name="nombre_registro" placeholder="Nombre">
            <input type="email" name="email_registro" placeholder="Correo electrónico" required>
            <input type="password" name="password_registro" placeholder="Contraseña" required>
            <button type="submit" name="registrar_nuevo">Registrarse</button>
        </form>
    </div>
</div>

<script>
    // Mostrar formulario de inicio de sesión
    document.getElementById("btn-login").addEventListener("click", function() {
        document.getElementById("btns-container").style.display = "none";
        document.getElementById("form-login").style.display = "block";
        document.getElementById("form-registro").style.display = "none";
    });

    // Mostrar formulario de registro
    document.getElementById("btn-registro").addEventListener("click", function() {
        document.getElementById("btns-container").style.display = "none";
        document.getElementById("form-login").style.display = "none";
        document.getElementById("form-registro").style.display = "block";
    });
</script>

</body>
</html>
