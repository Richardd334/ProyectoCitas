<?php
    require_once "conecction.php";

    session_start();
    if (!array_key_exists('Paso por login', $_SESSION)) {
        header('Location: login.php');
        die;
    }
    $id_admin=$_SESSION['ID'];

    $Rep = mysqli_query($db,"SELECT * from reports Where id_admin=$id_admin")
?>

<html>
    <h1> Reportes pendinetes </h1>
    <h3> <div align="right"><a href="inicio_admin.php">Inicio </a></div></h3>
    <hr>
<table border = 2 >
    <tr>
        <th width="15%">CURP usuario</th>
        <th width="15%">Fecha de reporte</th>
        <th width="15%">Fecha solución</th>
        <th width="20%">Tipo</th>
        <th width="20%">Descripcion</th>
        <th width="15%">Estado</th>
        <th width="10%">Resolver</th>
    </tr>
<?php
$color = "#EFBEBE";
while ($R = mysqli_fetch_assoc($Rep)){
    if($R["id_admin"]=$id_admin) {
        if($R["Estado"]=='Asignado'){
    
?>

    <tr bgcolor="<?=$color?>">
        <td><?=$R["curp"];?></td>
        <td><?=$R["fecha_inicio"];?></td>
        <td><?=$R["fecha_solucion"];?></td>
        <td><?=$R["Tipo_problema"];?></td>
        <td><?=$R["Descripcion"];?></td>
        <td><?=$R["Estado"];?></td>
        <td><center><a href="editarRep.php?R=<?=$R["Id_reporte"];?>">Cambiar a resuelto</a></center></td>
    </tr>
<?php 
    if ($color == "#EFBEBE"){
        $color = "#BEC4EF";
    } else {
        $color="#EFBEBE";
    }
    }
    }
}
?>
</table>
</html>