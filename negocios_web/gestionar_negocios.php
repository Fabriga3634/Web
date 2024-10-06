<?php
session_start();
include 'db.php'; // Conexión a la base de datos

$user_id = $_SESSION['user_id']; // ID del usuario logueado

// Obtener los negocios del usuario
$user_id = $_SESSION['user_id']; // Asegúrate de que $_SESSION['user_id'] esté configurado correctamente
$sql = "SELECT * FROM negocios WHERE id_usuario = '$user_id'";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>" . $row['nombre_negocio'] . "</h2>";
        echo "<p>" . $row['descripcion'] . "</p>";
        echo "<p>Dirección: " . $row['direccion'] . "</p>";
        echo "<a href='editar_negocio.php?id=" . $row['id'] . "'>Modificar</a> | ";
        echo "<a href='eliminar_negocio.php?id=" . $row['id'] . "' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este negocio?\");'>Eliminar</a>";
        echo "</div>";
    }
} else {
    echo "<p>No tienes negocios registrados.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Negocios</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Gestión de Mis Negocios</h1>

    <table>
        <tr>
            <th>Nombre del Negocio</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Rubro</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['nombre_negocio']; ?></td>
            <td><?php echo $row['direccion']; ?></td>
            <td><?php echo $row['telefono']; ?></td>
            <td><?php echo $row['rubro']; ?></td>
            <td>
                <a href="editar_negocio.php?id=<?php echo $row['id']; ?>">Editar</a>
                <a href="eliminar_negocio.php?id=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar este negocio?')">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <a href="agregar_negocio.php">Agregar Nuevo Negocio</a>
</body>
</html>

<?php
$conn->close();
?>
