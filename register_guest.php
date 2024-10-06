<?php
include 'db.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Verificar si el usuario ya está registrado
    $sql_check = "SELECT * FROM invitados WHERE nombre = '$username'";
    $result = $conn->query($sql_check);

    if ($result->num_rows > 0) {
        // Si el usuario ya existe
        echo "<p>El nombre de usuario ya está registrado. Por favor elige otro.</p>";
    } else {
        // Registrar nuevo invitado
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Encriptar contraseña
        $sql_insert = "INSERT INTO invitados (nombre, password) VALUES ('$username', '$hashed_password')";

        if ($conn->query($sql_insert) === TRUE) {
            // Redirigir a la página de negocios/PYMES
            header("Location: todos_los_negocios.php");
            exit();
        } else {
            echo "Error al registrar: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro Invitado</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>
    <h1>Registro de Invitado</h1>
    <form action="register_guest.php" method="POST">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>
