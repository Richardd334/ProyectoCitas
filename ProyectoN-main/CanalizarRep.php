<?php
    /*session_start();
    if (!array_key_exists('Paso por login', $_SESSION)) {
        header('Location: login.php');
        die;
    }*/
    require_once "conecction.php";

    if (isset($_GET["usua"]) && !empty($_GET["usua"])) {
        $idR= $_GET["usua"];
        $Tabla = mysqli_query($db,"SELECT * FROM reppendientes WHERE Id_Pend=($idR)");
        $Reportes = mysqli_fetch_assoc($Tabla);
        if ($Reportes) {
            $id = $idR;
            $curp  = $Reportes["curp"];
            $fecha = $Reportes["fecha_inicio"];
            $Tipo = $Reportes["Tipo_problema"];
            $Desc = $Reportes["Descripcion"];
            $Est = $Reportes["Estado"];

            
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
    <h1>Detalles del Reporte</h1>
    <hr>
    <form action=EditarUs.php method="post" >
        <input type="hidden" name="id" value="<?=$idus?>">
        <table border = "2" align="center">
            
            <tr>
                <td width="25%" align="right">id reporte:</td>
                <td width="75%"><input type="text" name="id" value="<?=$id;?>" disabled></td>
            </tr>
            <tr>
                <td width="25%" align="right">curp usuario:</td>
                <td width="75%"><input type="text" name="curp" value="<?=$curp;?>" disabled></td>
            </tr>
            <tr>
                <td  align="right">fecha:</td>
                <td><input type="text" name="fecha" value="<?=$fecha;?>" disabled></td>
            </tr>
            <tr>
                <td  align="right">Tipo:</td>
                <td><input type="text" name="Tipo" value="<?=$Tipo;?>" disabled></td>
            </tr>
            <tr>
                <td  align="right">Est:</td>
                <td><input type="text" name="Est" value="<?=$Est;?>" disabled></td>
            </tr>
            
            <tr>
                <td  align="right">Enviar a:</td>
                <td>
                    <select name="role" style="padding: 10px">
                        <option value="1">Usuario</option>
                        <option value="2">Administrador</option>
                    </select><br><br> 
                </td>

            </tr>

            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="submit" value="Enviar"></td>
            </tr>
        </table>
    </form>
</body>
</html>