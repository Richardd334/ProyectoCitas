<?php
    require_once "conecction.php";
    session_start();
    $curp=$_SESSION['Curp'];
?>

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
            $fecha = $_POST["fecha"];
            $hora = $_POST["hora"];

            $insertar="INSERT INTO citas VALUES(
                NULL, '".$curp."', '".$fecha."','".$hora."'
            );";
            mysqli_query($db,$insertar);

            $Consulta="SELECT * from usuarios where Curp=('$curp');";
            $usuarios = mysqli_query($db,"SELECT * FROM usuarios ");
            $usua = mysqli_fetch_assoc($usuarios);
            
            $Nombre=$usua["Nombre"];

            // Imprimir los datos de la cita
            echo "<p><strong>Hola </strong> $Nombre</p>";
            echo "<p><strong>Fecha de la cita:</strong> $fecha</p>";
            echo "<p><strong>Hora de la cita:</strong> $hora</p>";

        } else {
            // Si no se recibieron datos, mostrar un mensaje de error
            echo "<p>No se recibieron datos del formulario.</p>";
        }
        ?>
    </div>
    <a href="inicio_usuario.php" class="boton-volver">Volver al inicio</a>
</body>
</html>