<?php
    require_once "conecction.php";

    $sql="CREATE TABLE IF NOT EXISTS admin(
        id_admin  INT(10) auto_increment not null,
        nombre varchar(55) NOT NULL,
        apellido_paterno varchar(55) NOT NULL,
        apellido_materno varchar(55) NOT NULL,
        telefono varchar(15) NOT NULL,
        edad INT(2) NOT NULL,
        rol varchar(55) NOT NULL,
        Correo varchar(15) NOT NULL,
        Contraseña varchar(55) NOT NULL,
        CONSTRAINT  pk_user PRIMARY KEY(id_admin)
    );";
    mysqli_query($db, $sql);

    if(isset($_POST)&& (!empty($_POST["Registrar"]))){
        //Validar si el correo está registrado
        $Corr=$_POST["correo"];
        $resultado=mysqli_query($db,"SELECT * FROM admin where Correo=('$Corr') UNION SELECT * FROM usuarios where Correo=('$Corr');");
        $filas=mysqli_fetch_assoc($resultado);
        if($filas==0){
            $sql="INSERT INTO admin
            VALUES (NULL ,'".$_POST["username"]."','".$_POST["ApePat"]."','"
            .$_POST["ApeMat"]."','".$_POST["cell"]."','".$_POST["edad"]."','2','".$_POST["correo"]."','".base64_encode($_POST["password"])."');";
            
            $insert_usuarios=mysqli_query($db, $sql);
            if($insert_usuarios){
                echo "Datos guardados a la bd";
                header("Location: inicio_admin.php");
            }
        }else{
            echo '<script>alert("Error, Correo registrada.");</script>';
        }
    }
    ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" type="text/css" href="estilosR.css">
</head>
<body>
    <div align="right"><a href="index.php">Inicio</a></div>
    <div class="container">
        <h1>Registro de Usuario</h1>
        <form action="RegistrarColab.php" method="POST">

            <label for="name">Nombre(s):</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="ApePat">Apellido Paterno</label><br>
            <input type="text" id="ApePat" name="ApePat" required><br><br>

            <label for="ApeMat">Apellido Materno</label><br>
            <input type="text" id="ApeMat" name="ApeMat" required><br><br>

            <label for="cell">Celular:</label><br>
            <input type="text" id="cell" name="cell" required><br><br>

            <label for="edad">Edad:</label><br>
            <input type="text" id="edad" name="edad" required><br><br>

            <label for="correo">Correo:</label><br>
            <input type="text" id="correo" name="correo" required><br><br>

            <label for="password">Contraseña:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" name="Registrar" value="Registrar">
        </form>
    </div>
</body>
</html>