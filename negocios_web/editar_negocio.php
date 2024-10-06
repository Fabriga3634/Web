<?php
include 'db.php';
$id = $_GET['id'];

// Obtener los datos del negocio actual
$sql = "SELECT * FROM negocios WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Negocio</title>
</head>
<body>
    <h1>Editar Negocio</h1>
    <form action="actualizar_negocio.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="nombre_negocio">Nombre del Negocio:</label>
        <input type="text" name="nombre_negocio" value="<?php echo $row['nombre_negocio']; ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" required><?php echo $row['descripcion']; ?></textarea>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" value="<?php echo $row['direccion']; ?>" required>

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen">
        <img src="uploads/<?php echo $row['imagen']; ?>" alt="Imagen actual" width="100">

        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
