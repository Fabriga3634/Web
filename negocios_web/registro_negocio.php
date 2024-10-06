<?php
// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'negocios_db');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombre_negocio = $_POST['nombre_negocio'];
    $descripcion = $_POST['descripcion'];
    $rubro = $_POST['rubro'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Manejo de la imagen
    $imagen = $_FILES['imagen']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($imagen);

    // Subir la imagen al servidor
    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
        // Insertar los datos en la base de datos
        $sql = "INSERT INTO negocios (nombre_negocio, descripcion, rubro, direccion, telefono, imagen)
                VALUES ('$nombre_negocio', '$descripcion', '$rubro', '$direccion', '$telefono', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            // Redirigir a la página de todos los negocios después del registro exitoso
            header("Location: todos_los_negocios.php");
            exit(); // Asegurarse de que el script se detenga después de la redirección
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error al subir la imagen.";
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Negocio</title>
</head>
<body>
    <h2>Registrar tu Negocio</h2>
    <form action="registro_negocio.php" method="POST" enctype="multipart/form-data">
        <label for="nombre_negocio">Nombre del Negocio:</label>
        <input type="text" id="nombre_negocio" name="nombre_negocio" required><br><br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea><br><br>

        <label for="rubro">Rubro:</label>
        <input type="text" id="rubro" name="rubro" required><br><br>

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" required><br><br>

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" required><br><br>

        <label for="imagen">Subir Imagen:</label>
        <input type="file" id="imagen" name="imagen" accept="image/*" required><br><br>

       <button type="submit">Registrar Negocio</button>
    </form>
</body>
</html>
