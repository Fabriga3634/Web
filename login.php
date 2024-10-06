<?php
session_start();

// Conexión a la base de datos
$conn = new mysqli('localhost', 'root', '', 'negocios_db');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si el usuario está intentando iniciar sesión como "Usuario Negocio"
    if (isset($_POST['login_negocio'])) {
        $correo = $_POST['correo_negocio'];
        $password = $_POST['password_negocio'];

        // Consulta a la tabla "usuarios"
        $sql = "SELECT * FROM usuarios WHERE correo='$correo'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($user['tipo'] == 'negocio') {
                $_SESSION['user_id'] = $user['id'];
                header("Location: todos_los_negocios.php");
                exit();
            }
            
            } else {
                echo "Contraseña incorrecta para usuario negocio.";
            }
        } else {
            echo "Usuario negocio no encontrado.";
        }
    }

    // Si el usuario está intentando iniciar sesión como "Invitado"
    if (isset($_POST['login_invitado'])) {
        $username_invitado = $_POST['username_invitado'];
        $password_invitado = $_POST['password_invitado'];

        // Consulta a la tabla "invitados"
        $sql = "SELECT * FROM invitados WHERE nombre='$username_invitado'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password_invitado, $user['password'])) {
                $_SESSION['user_invitado_id'] = $user['id'];
                header("Location: todos_los_negocios.php");  // Redirigir a la página de invitados
                exit();
            } else {
                echo "Contraseña incorrecta para usuario invitado.";
            }
        } else {
            echo "Usuario invitado no encontrado.";
        }
    }


$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Iniciar Sesión de Usuario Negocio</h2>
    <form action="login.php" method="POST">
        <input type="hidden" name="login_negocio" value="1">
        <label for="correo_negocio">Correo (Usuario Negocio):</label>
        <input type="email" id="correo_negocio" name="correo_negocio" required>
        <label for="password_negocio">Contraseña:</label>
        <input type="password" id="password_negocio" name="password_negocio" required>
        <button type="submit">Iniciar Sesión Negocio</button>
    </form>

    <h2>Iniciar Sesión de Invitado</h2>
    <form action="login.php" method="POST">
        <input type="hidden" name="login_invitado" value="1">
        <label for="username_invitado">Nombre de Usuario (Invitado):</label>
        <input type="text" id="username_invitado" name="username_invitado" required>
        <label for="password_invitado">Contraseña:</label>
        <input type="password" id="password_invitado" name="password_invitado" required>
        <button type="submit">Iniciar Sesión Invitado</button>
    </form>
</body>
</html>
