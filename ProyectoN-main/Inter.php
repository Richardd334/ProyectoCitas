<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de la Cita</title>
    <link rel="stylesheet" href="estilosC.css">
</head>
<body>
    <h1>Datos de la Cita</h1>
    <div class="datos-cita">
        <?php
        // Verificar si se recibieron datos del formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recuperar los datos del formulario
            $fecha = $_POST["fecha"];
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];

            // Imprimir los datos de la cita
            echo "<p><strong>Fecha de la cita:</strong> $fecha</p>";
            echo "<p><strong>Tu nombre:</strong> $nombre</p>";
            echo "<p><strong>Correo electrónico:</strong> $email</p>";
        } else {
            // Si no se recibieron datos, mostrar un mensaje de error
            echo "<p>No se recibieron datos del formulario.</p>";
        }
        ?>
    </div>
    <a href="index.php" class="boton-volver">Volver al inicio</a>
</body>
</html>