<?php
// Aquí se procesa el formulario de sugerencias
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $sugerencia = $_POST['sugerencia'];

    // Validar los campos
    if (!empty($nombre) && !empty($correo) && !empty($sugerencia)) {
        // Crear la carpeta 'sugerencias' si no existe
        if (!file_exists('sugerencias')) {
            mkdir('sugerencias', 0777, true);
        }

        // Formato de la sugerencia
        $sugerencia_texto = "Nombre: $nombre\nCorreo: $correo\nSugerencia: $sugerencia\n\n";

        // Guardar la sugerencia en un archivo
        $file_path = 'sugerencias/sugerencias.txt';
        file_put_contents($file_path, $sugerencia_texto, FILE_APPEND | LOCK_EX);

        // Mensaje de agradecimiento (puedes redirigir a otra página si deseas)
        echo "<p>Gracias por tu sugerencia, $nombre. ¡La hemos recibido!</p>";
    } else {
        echo "<p>Por favor completa todos los campos.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - Promoción de PYMES</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .titulo {
            margin: 0;
            font-size: 2.5em;
        }

        .subtitulo {
            font-size: 1.2em;
        }

        main {
            padding: 20px;
        }

        #intro {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .boton-container {
            margin-top: 20px;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin: 10px;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        footer {
            background: #333;
            color: #b2ff59; /* Cambiado a verde claro */
            padding: 20px;
            margin-top: 20px;
            text-align: center;
        }

        footer h2 {
            margin-top: 0;
            font-size: 2em; /* Aumentado tamaño de fuente */
        }

        footer p {
            font-size: 1.1em; /* Aumentado tamaño de fuente */
            color: white; /* Cambiado a blanco */
        }

        footer form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        footer input, footer textarea {
            width: 80%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        footer button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        footer button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1 class="titulo">Promoción de PYMES</h1>
        <p class="subtitulo">Impulsando pequeños negocios hacia un gran futuro</p>
    </header>

    <main>
        <section id="intro">
            <h2>¿Qué Ofrecemos?</h2>
            <p>Somos una plataforma dedicada a ayudar a los pequeños negocios, locales y PYMES a tener mayor visibilidad en el mercado. Nuestro objetivo es ofrecer un lugar donde cada emprendedor pueda compartir su negocio, conectarse con nuevos clientes y crecer de manera sostenible.</p>
            <div class="boton-container">
                <a href="registro.php" class="btn">Registra tu Negocio</a>
                <a href="login.php" class="btn">Iniciar Sesión</a>
                <a href="register_guest.php" class="btn">Registrar Invitado</a>
            </div>
        </section>
    </main>

    <footer>
        <section id="sobre-nosotros">
            <h2>Sobre Nosotros</h2>
            <p>Promoción de PYMES es una plataforma dedicada a impulsar los negocios locales. Creemos en el poder de las pequeñas empresas y su capacidad para transformar comunidades.</p>
            <p>Nos comprometemos a brindar un espacio accesible y eficiente para todos los emprendedores que deseen aumentar su presencia online.</p>
        </section>

        <section id="sugerencias">
            <h2>Sugerencias</h2>
            <p>¿Tienes alguna sugerencia para mejorar nuestra página o nuestros servicios? Nos encantaría escuchar tus comentarios.</p>
            <form action="" method="POST">
                 <label for="nombre">Tu nombre:</label>
                 <input type="text" id="nombre" name="nombre" required>

                 <label for="correo">Tu correo:</label>
                 <input type="email" id="correo" name="correo" required>

                 <label for="sugerencia">Sugerencia:</label>
                 <textarea id="sugerencia" name="sugerencia" rows="4" required></textarea>

                <button type="submit" class="btn">Enviar Sugerencia</button>
                </form>
        </section>
    </footer>
</body>
</html>
