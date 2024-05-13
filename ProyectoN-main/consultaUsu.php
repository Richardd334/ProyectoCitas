<?php
session_start();
    if (!array_key_exists('Paso por login', $_SESSION)) {
        header('Location: login.php');
        die;
    }
    require_once "conecction.php";
    if (isset($_GET["usua"]) && !empty($_GET["usua"]) && is_numeric($_GET["usua"])) {
        $usua = $_GET["usua"];
        $usuarios = mysqli_query($db,"SELECT * FROM usuarios WHERE usuario_id=($usua)");
        $usuario = mysqli_fetch_assoc($usuarios);
         
    } else {
        echo "el id usuario es incorrecto";
        header("Location:elistar.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div align="right"><a href="javascript:history.back();">Regresar</a></div>

    <h1> Detalle de Usuario </h1>
    <hr>

    <table align="center" width="80%" >
        <tr>
            <td width="50%">&nbsp;</td>
            <td width="50%">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><br><br><b>Nombre:</b>&nbsp;<br><?=$usuario["nombre"];?>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><br><br><b>Apellidos:</b>&nbsp;<br><?=$usuario["apellidos"];?>
            </td>
        </tr>
        <tr>
            <td><b>correo electrónico:</b><br>&nbsp;<?=$usuario["email"];?></td>
            <td><br><br><b>Biografía:</b>&nbsp;<br><?=$usuario["biografia"];?>
            </td>
        </tr>
        <tr>
            <td><b>Role :</b><br> &nbsp;
            <?php
                if ($usuario["role"]== 0){ echo "Normal";}
                else if ($usuario["role"]== 1){ echo "Administrador";};
            ?>
            </td>
            <td><br><br><b></b>&nbsp;<br>
            </td>
        </tr>
        <tr>
            <td colspan="2"><a href="eactualizar.php?usua=<?=$usuario["usuario_id"];?>">Editar registro </a></td>
            <td><br><br><b></b>&nbsp;<br>
            </td>
        </tr>
    </table>
</body>
</html>