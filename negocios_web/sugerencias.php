<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conn = new mysqli('localhost', 'root', '', 'negocios_db');

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $sugerencia = $_POST['sugerencia'];

    // Insertar sugerencia en la base de datos
    $sql = "INSERT INTO sugerencias (nombre, correo, sugerencia) VALUES ('$nombre', '$correo', '$sugerencia')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2>¡Gracias por tu sugerencia!</h2>";
        echo "<p>Serás redirigido a la página principal en 5 segundos...</p>";
        
        // Redirección automática a index.php después de 5 segundos
        echo "<script>
            setTimeout(function(){
                window.location.href = 'index.php';
            }, 5000);
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
?>
