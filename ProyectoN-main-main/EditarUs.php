<?php
    session_start();
    if (!array_key_exists('Paso por login', $_SESSION)) {
        header('Location: login.php');
        die;
    }
    require_once "conecction.php";

    if (isset($_GET["usua"]) && !empty($_GET["usua"])) {
        $curp = $_GET["usua"];
        $usuarios = mysqli_query($db,"SELECT * FROM usuarios WHERE Curp =('$curp')");
        $usuario = mysqli_fetch_assoc($usuarios);
        if ($usuario) {
            $idus = $curp;
            $nomb = $usuario["Nombre"];
            $apelPat = $usuario["ApellidoPaterno"];
            $apelMat = $usuario["ApellidoMaterno"];
            $edad = $usuario["Edad"];
            $correo = $usuario["Correo"];
            $cell=$usuario["Celular"];
            $password = $usuario["Contraseña"];
            if( $usuario["rol"]==1){
                $rol ="usuario";
            }else{
                $rol = "admin";
            }
            
        } else {
            header("Location: index.php");
        }
    }

    if (isset($_POST) && !empty($_POST["submit"])){
        $sql = " UPDATE usuarios
            SET Nombre = '". $_POST["nombre"]."',
            Curp ='". $_POST["curp"] ."',
            ApellidoMaterno ='". $_POST["ApelPat"]."',
            ApellidoPaterno ='". $_POST["ApelMat"] ."',
            Edad ='". $_POST["edad"] . "',
            Correo ='". $_POST["correo"] ."',
            Celular ='". $_POST["cell"] ."',
            Contraseña='".base64_encode( $_POST["password"]). "',
            rol ='". $_POST["rol"] ."'
            WHERE Curp = '". $_POST["id"]."';";
        
        $actualiza_usuarios = mysqli_query($db,$sql); 

        if ($actualiza_usuarios){
            echo "a La tabla se le insertaron registros";
            header ("Location:VerUsuarios.php");
        }   
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
</head>
<body>
    <h1>Actualizar datos de un registro</h1>
    <hr>
    <form action=EditarUs.php method="post" >
        <input type="hidden" name="id" value="<?=$idus?>">
        <table border = "2" align="center">
            
            <tr>
                <td width="25%" align="right">CURP:</td>
                <td width="75%"><input type="text" name="curp" value="<?=$curp;?>"></td>
            </tr>
            <tr>
                <td width="25%" align="right">Nombre:</td>
                <td width="75%"><input type="text" name="nombre" value="<?=$nomb;?>"></td>
            </tr>
            <tr>
                <td  align="right">Apellido Paterno:</td>
                <td><input type="text" name="ApelPat" value="<?=$apelPat;?>"></td>
            </tr>
            <tr>
                <td  align="right">Apellido Materno:</td>
                <td><input type="text" name="ApelMat" value="<?=$apelMat;?>"></td>
            </tr>
            <tr>
                <td  align="right">Edad:</td>
                <td><input type="text" name="edad" value="<?=$edad;?>"></td>
            </tr>
            <tr>
                <td  align="right">Correo:</td>
                <td><input type="text" name="correo" value="<?=$correo;?>"></td>
            </tr>
            <tr>
                <td  align="right">celular:</td>
                <td><input type="text" name="cell" value="<?=$cell;?>"></td>
            </tr>

            <tr>
                <td  align="right">password:</td>
                <td><input type="text" name="password" value="<?=$password;?>"></td>
            </tr>
            <tr>
                <td  align="right">rol:</td>
                <td><input type="text" name="rol" value="<?=$rol;?>"></td>
            </tr>

            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Enviar"></td>
            </tr>
        </table>
    </form>
</body>
</html>