<?php
include 'db.php';

$id = $_POST['id'];
$nombre_negocio = $_POST['nombre_negocio'];
$descripcion = $_POST['descripcion'];
$direccion = $_POST['direccion'];

if (!empty($_FILES['imagen']['name'])) {
    $imagen = $_FILES['imagen']['name'];
    $target = "uploads/" . basename($imagen);
    move_uploaded_file($_FILES['imagen']['tmp_name'], $target);
    
    $sql = "UPDATE negocios SET nombre_negocio='$nombre_negocio', descripcion='$descripcion', direccion='$direccion', imagen='$imagen' WHERE id=$id";
} else {
    $sql = "UPDATE negocios SET nombre_negocio='$nombre_negocio', descripcion='$descripcion', direccion='$direccion' WHERE id=$id";
}

if ($conn->query($sql) === TRUE) {
    header("Location: gestionar_negocios.php");
} else {
    echo "Error al actualizar el negocio: " . $conn->error;
}
?>
