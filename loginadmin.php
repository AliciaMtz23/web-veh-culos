
<!DOCTYPE html>
<html>
<head>
    <title>Sistema de Administración</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h1>Bienvenido al Sistema de Administración</h1>
    <h2>Iniciar Sesión o Registrarse</h2>
    <form method="POST" action="catalogoadministrador.php">
        <!--  seleccionar la acción de iniciar sesión o registrarse -->
        <div class="radio-group">
            <input type="radio" id="login" name="action" value="login" checked>
            <label for="login">Iniciar Sesión</label>
            <input type="radio" id="register" name="action" value="register">
            <label for="register">Registrarse</label>
        </div>
        
        <!-- Formulario de inicio de sesión -->
        <div id="login-form">
            <label for="login_usuario">Usuario:</label>
            <input type="text" id="login_usuario" name="login_usuario" required>
            <label for="login_password">Contraseña:</label>
            <input type="password" id="login_password" name="login_password" required>
            <input type="submit" name="login" value="Iniciar Sesión">
        </div>
        
        <!-- Formulario de registro -->
        <div id="register-form" style="display:none;">
            <label for="register_usuario">Usuario:</label>
            <input type="text" id="register_usuario" name="register_usuario" required>
            <label for="register_email">Email:</label>
            <input type="email" id="register_email" name="register_email" required>
            <label for="register_password">Contraseña:</label>
            <input type="password" id="register_password" name="register_password" required>
            <label for="register_folio">Folio:</label>
            <input type="text" id="register_folio" name="register_folio" required>
            <input type="submit" name="register" value="Registrarse">
        </div>
    </form>

    <script>
        // JavaScript para alternar entre los formularios de inicio de sesión y registro
        document.querySelectorAll('input[name="action"]').forEach((elem) => {
            elem.addEventListener("change", function(event) {
                let value = event.target.value;
                document.getElementById("login-form").style.display = (value === "login") ? "block" : "none";
                document.getElementById("register-form").style.display = (value === "register") ? "block" : "none";
            });
        });
    </script>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Conexión a la base de datos
        $conn = new mysqli('localhost', 'root', '', 'renta');
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        if (isset($_POST['login'])) {
            // Manejar inicio de sesión
            $usuario = $_POST['login_usuario'];
            $password = $_POST['login_password'];

            $sql = "SELECT * FROM administradores WHERE usuario='$usuario'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    session_start();
                    $_SESSION['admin_id'] = $row['id'];
                    $_SESSION['admin_usuario'] = $row['usuario'];
                    header("Location: catalogoadministrador.php");
                    exit();
                } else {
                    echo "<div id='error-message'>Contraseña incorrecta.</div>";
                }
            } else {
                echo "<div id='error-message'>Usuario no encontrado.</div>";
            }
        } elseif (isset($_POST['register'])) {
            // Manejar registro
            $usuario = $_POST['register_usuario'];
            $email = $_POST['register_email'];
            $password = password_hash($_POST['register_password'], PASSWORD_BCRYPT);
            $folio = $_POST['register_folio'];

            // Verificar si el correo ya está registrado
            $sql_check_email = "SELECT * FROM administradores WHERE email = '$email'";
            $result_check_email = $conn->query($sql_check_email);

            if ($result_check_email->num_rows > 0) {
                echo "<script>alert('El correo electrónico ya está registrado.');</script>";
            } else {
                // Insertar nuevo usuario en la base de datos
                $sql_insert_user = "INSERT INTO administradores (usuario, email, password, folio) VALUES ('$usuario', '$email', '$password', '$folio')";

                if ($conn->query($sql_insert_user) === TRUE) {
                    echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.');</script>";
                } else {
                    echo "Error: " . $sql_insert_user . "<br>" . $conn->error;
                }
            }
        }
        $conn->close();
    }
    ?>
</body>
</html>
