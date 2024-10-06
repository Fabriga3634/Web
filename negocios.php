<?php
// Conectar a la base de datos
$conn = new mysqli('localhost', 'root', '', 'negocios_db');
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Filtrar por rubro si está seleccionado
$rubro = isset($_GET['rubro']) ? $_GET['rubro'] : '';

$sql = "SELECT * FROM negocios";
if ($rubro) {
    $sql .= " WHERE rubro='$rubro'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos los Negocios Promocionados</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Negocios Promocionados</h2>

    <form method="GET" action="todos_los_negocios.php">
        <label for="rubro">Filtrar por rubro:</label>
        <select id="rubro" name="rubro">
            <option value="">Todos</option>
            <option value="Tecnología" <?php if ($rubro == 'Tecnología') echo 'selected'; ?>>Tecnología</option>
            <option value="Restaurante" <?php if ($rubro == 'Restaurante') echo 'selected'; ?>>Restaurante</option>
            <option value="Ropa" <?php if ($rubro == 'Ropa') echo 'selected'; ?>>Ropa</option>
            <option value="Salud" <?php if ($rubro == 'Salud') echo 'selected'; ?>>Salud</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <ul>
        <?php
        if ($result->num_rows > 0) {
            while ($negocio = $result->fetch_assoc()) {
                echo "<li>";
                echo "<h3>" . $negocio['nombre_negocio'] . "</h3>";
                echo "<p>Dirección: " . $negocio['direccion'] . "</p>";
                echo "<p>Teléfono: " . $negocio['telefono'] . "</p>";
                echo "<p>Correo: " . $negocio['correo_contacto'] . "</p>";
                echo "<p>Rubro: " . $negocio['rubro'] . "</p>";
                echo "<p>Descripción: " . $negocio['descripcion'] . "</p>";
                echo "</li>";
            }
        } else {
            echo "<p>No hay negocios disponibles.</p>";
        }
        ?>
    </ul>
</body>
</html>

<?php $conn->close(); ?>
 