<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli('localhost', 'root', '', 'negocios_db');
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, correo, password) VALUES ('$nombre', '$correo', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso!";
        header("Location: registro_negocio.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form action="registro.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <label for="correo">Correo:</label>
        <input type="email" id="correo" name="correo" required>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>