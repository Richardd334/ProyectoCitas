<?php
    
    session_start();
    if (!array_key_exists('Paso por login', $_SESSION)) {
        header('Location: login.php');
        die;
    }
    require_once "conecction.php";
    $reports = mysqli_query($db,"SELECT * FROM reports");
    $admins=mysqli_query($db,"SELECT reports.id_admin, admin.nombre FROM reports inner join admin ON reports.id_admin=admin.id_admin");
    $ad=mysqli_fetch_assoc($admins);
    $ColumnaAdmin=mysqli_query($db,"SELECT reports.id_admin, admin.nombre FROM reports inner join admin ON reports.id_admin=admin.id_admin");
    $columna=mysqli_fetch_column(mysqli_query($db,"SELECT * FROM reports"));
    $ad2=mysqli_query($db,"SELECT nombre, id_admin FROM admin");
    
?>
<html>
    <h1> Descarga de Tickets </h1>
    <h3> <div align="right"><a href="inicio_admin.php">Inicio </a></div></h3>
    <hr>
<table border = 2 >
    <tr>
        <th width="15%">Curp</th>
        <th width="15%">Id de Admin</td>
        <th width="15%">Fecha de Inicio</th>
        <th width="15%">Fecha de Solución</th>
        <th width="15%">Tipo de Problema</th>
        <th width="20%">Descripción</th>
        <th width="15">Estado</th>
    </tr>
<?php
$color = "#EFBEBE";
while ($reporte = mysqli_fetch_assoc($reports)){
?>
    <tr bgcolor="<?=$color?>">
        <td><?=$reporte["curp"];?></td>
        <td><?=$reporte["id_admin"];?></td>
        <td><?=$reporte["fecha_inicio"];?></td>
        <td><?=$reporte["fecha_solucion"];?></td>
        <td><?=$reporte["Tipo_problema"];?></td>
        <td><?=$reporte["Descripcion"];?></td>
        <td><?=$reporte["Estado"];?></td>
    </tr>
<?php 
    if ($color == "#EFBEBE"){
        $color = "#BEC4EF";
    } else {
        $color="#EFBEBE";
    }
}
?>
</table>

<br>
<br>
<?php
    $TotalReports = mysqli_num_rows(mysqli_query($db, "SELECT * from reppendientes"));

    $mysql = mysqli_query($db, "SELECT count(*) as total from reppendientes WHERE Tipo_problema='Software';");
    $TotalSoft = mysqli_fetch_assoc($mysql);
 
    $mysql = mysqli_query($db, "SELECT count(*) as total from reppendientes WHERE Tipo_problema='Hardware';");
    $TotalHard = mysqli_fetch_assoc($mysql);
 
    $mysql = mysqli_query($db, "SELECT count(*) as total from reppendientes WHERE Tipo_problema='Other';");
    $TotalOther = mysqli_fetch_assoc($mysql);   
    ?>
<br>
<br>
<table border = 2 style="width: 60%;" >
    <tr>
        <th width="20%">Tipo de problema</th>
        <th width="20%">frecuencia</th>
        <th width="20%">frecuencia relativa</th>

    </tr>
    <tr>
        <td>Software</td>
        <td><?=$TotalSoft["total"];?></td>
        <td><?=$TotalSoft["total"]/$TotalReports;?></td>
        
        
    </tr>
    <tr>
        <td>Hardware</td>
        <td><?=$TotalHard["total"];?></td>
        <td><?=$TotalHard["total"]/$TotalReports;?></td>
        
    </tr>
    <tr>
        <td>Other</td>
        <td><?=$TotalOther["total"];?></td>
        <td><?=$TotalOther["total"]/$TotalReports;?></td>
    </tr>
</table>
<body>
    <div>
        Total de Errores: 
        <?php echo $TotalReports?>
        <br>
    </div>
</body>
</html>