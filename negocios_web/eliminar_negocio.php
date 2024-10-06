<?php
session_start();
include 'db.php'; // Conexión a la base de datos

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$negocio_id = $_GET['id'];

// Verificar que el negocio pertenece al usuario logueado
$sql = "SELECT * FROM negocios WHERE id = '$negocio_id' AND usuario_id = '$usuario_id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "No tienes permiso para eliminar este negocio.";
    exit();
}

// Eliminar el negocio
$sql_delete = "DELETE FROM negocios WHERE id = '$negocio_id' AND usuario_id = '$usuario_id'";
if ($conn->query($sql_delete) === TRUE) {
    header("Location: gestionar_negocios.php");
    exit();
} else {
    echo "Error al eliminar: " . $conn->error;
}

$conn->close();
?>
