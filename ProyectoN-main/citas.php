<?php
require_once "conecction.php";
/*session_start();
    if (!array_key_exists('Paso por login', $_SESSION)) {
        header('Location: login.php');
        die;
    }*/
    $sql="CREATE TABLE IF NOT EXISTS citas(
    id_cita INT (10) NOT NULL AUTO_INCREMENT ,
    Curp VARCHAR(20) NOT NULL, 
    Fecha DATETIME NOT NULL, 
    PRIMARY KEY (id_cita));";
    
    $create_usuarios_table=mysqli_query($db, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <link rel="stylesheet" href="estilosC.css">
</head>
<body>
    <h1>Agendar Cita</h1>
    <form action="Inter.php" method="POST">
        <label for="fecha">Fecha de la cita:</label>
        <input type="date" id="fecha" name="fecha" required>

        <input type="submit" value="Agendar Cita" name="submit">
    </form>
</body>
</html>
<?php
// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario

    if(isset($_POST)&& (!empty($_POST["submit"]))){
        $sql="INSERT INTO citas
        VALUES ('".$nombre."','".$fecha."');";

        $insert_usuarios=mysqli_query($db, $sql);
            // Por ahora, simplemente imprimimos los datos para demostrar que se han recibido correctamente
            echo "<h2>¡Cita Agendada!</h2>";
            echo "<p>Fecha de la cita: $fecha</p>";
            echo "<p>Tu nombre: $nombre</p>";
            echo "<p>Correo electrónico: $email</p>";
            }


    //if (isset($_POST) && !empty($_POST["submit"])){

       // echo "Cita realizada con exito";
        //header ("Location: Inter.php");  
   // }
}
?>

