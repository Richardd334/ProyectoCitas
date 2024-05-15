<?php
    /*session_start();
    if (!array_key_exists('Paso por login', $_SESSION)) {
        header('Location: login.php');
        die;
    }*/
    require_once "conecction.php";
    
    //$admin=mysqli_fetch_assoc($tab);

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
        echo var_dump($_POST["Descripcion"]);
        echo var_dump($_POST["id"]);
        $sql = " UPDATE reppendientes
            SET Id_Pend = ". $_POST["id"].",
            curp ='".$_POST["curp"]."',
            fecha_inicio ='". $_POST["fecha"]."',
            Tipo_problema ='". $_POST["Tipo"] ."',
            Descripcion ='". $_POST["Descripcion"]. "',
            Estado ='Asignado' 
            WHERE Id_Pend  = '". $_POST["id"]."';";
        
        $actualiza_usuarios = mysqli_query($db,$sql); 

        

        if ($actualiza_usuarios){
            $sql="INSERT INTO reports
            VALUES ('".$_POST["id"]."','".$_POST["curp"]."','".$_POST["idadmin"]."','".$_POST["fecha"]."',
            '.0000-00-00 00:00:0.', '".$_POST["Tipo"]."', '".$_POST["Descripcion"]."', 'Asignado');";

            $insert=mysqli_query($db, $sql);
            if($insert){
                echo "Datos guardados a la bd";
                header ("Location:VerReportes.php");
            }  else{
                echo "error insertar";
            } 
        } else{
            echo "Error actualizar";
            
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
    <form action=CanalizarRep.php method="post" >
        <input type="hidden" name="idr" value="<?=$idus?>">
        <table border = "2" align="center">
            
            <tr>
                <td width="25%" align="right">id reporte:</td>
                <td width="75%"><input type="text" name="id" value="<?=$id;?>" ></td>
            </tr>
            <tr>
                <td width="25%" align="right">curp usuario:</td>
                <td width="75%"><input type="text" name="curp" value="<?=$curp;?>" ></td>
            </tr>
            <tr>
                <td  align="right">fecha:</td>
                <td><input type="text" name="fecha" value="<?=$fecha;?>" ></td>
            </tr>
            <tr>
                <td  align="right">Tipo:</td>
                <td><input type="text" name="Tipo" value="<?=$Tipo;?>" ></td>
            </tr>
            <tr>
                <td  align="right">Descripcion:</td>
                <td><input type="text" name="Descripcion" value="<?=$Desc;?>"></td>
            </tr>
            <tr>
                <td  align="right">Est:</td>
                <td><input type="text" name="Est" value="<?=$Est;?>" ></td>
            </tr>
            
            <tr>
                <td  align="right">Enviar a:</td>
                <td>
                    <select name="idadmin" style="padding: 10px">
                    <?php
                        $tab= mysqli_query($db,"SELECT * FROM admin");

                        while($admin=mysqli_fetch_assoc($tab)){
                            $nombre=$admin["nombre"];
                            $idA=$admin["id_admin"];
                            echo "<option value=$idA>$nombre</option>";
                        }
                    ?>
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