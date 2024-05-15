<?php 
    require_once "conecction.php";
    session_start();
    if (!array_key_exists('Paso por login', $_SESSION)) {
        header('Location: login.php');
        die;
    }

    if (isset($_GET["R"]) && !empty($_GET["R"])) {
        $idR= $_GET["R"];
        $Tabla = mysqli_query($db,"SELECT * FROM reports WHERE Id_reporte=($idR)");
        $Reportes = mysqli_fetch_assoc($Tabla);
        if ($Reportes) {
            $fecha=date("Y-m-d H:i:s"); 
            $est=$Reportes["Estado"];
            $command="UPDATE reports  SET Estado='Resuelto', fecha_solucion='$fecha' WHERE Id_reporte=($idR);";
            $p=mysqli_query($db,$command);
if($p){
    echo "cambiado";
}
            //header("Location: Inicio_admin.php");
           
        } else {
            header("Location: Inicio_admin.php");
        }
    }
?>