<?php
    require_once "conecction.php";
    session_start();
    if (!array_key_exists('Paso por login', $_SESSION)) {
        header('Location: login.php');
        die;
    }

    date_default_timezone_set('America/Mexico_City');

  $sql="CREATE TABLE IF NOT EXISTS reports(
    Id_reporte int(10) auto_increment not null,
    curp varchar(20) NOT NULL,
    id_admin int(10) not NULL,
    fecha_inicio datetime,
    fecha_solucion datetime,
    Tipo_problema varchar(255),
    Descripcion varchar(255),
    Estado varchar(20),
    CONSTRAINT  pk_user PRIMARY KEY(Id_reporte),
    FOREIGN KEY (id_admin) REFERENCES admin(id_admin) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (curp) REFERENCES usuarios(Curp) ON DELETE CASCADE ON UPDATE CASCADE);";
    mysqli_query($db, $sql);

    $sql="CREATE TABLE IF NOT EXISTS RepPendientes(
        Id_Pend int(10) auto_increment not null,
        curp varchar(20) NOT NULL,
        fecha_inicio datetime,
        Tipo_problema varchar(255),
        Descripcion varchar(255),
        CONSTRAINT  pk_user PRIMARY KEY(Id_Pend),
        FOREIGN KEY (curp) REFERENCES usuarios(Curp) ON DELETE CASCADE ON UPDATE CASCADE);";
    mysqli_query($db, $sql);

 
    if (isset($_GET["usua"]) && !empty($_GET["usua"])) {
        $curp = $_GET["usua"];
        echo "$curp";
        $fecha=date("Y-m-d H:i:s"); 
    }   
        if(isset($_POST)&& (!empty($_POST["enviar"]))){
            $c=$_POST["id"];
            $usuarios = mysqli_query($db,"SELECT * FROM usuarios WHERE Curp =('$c')");
            $usuario = mysqli_fetch_assoc($usuarios);
            if ($usuario!=0) {
                $idus = $c;
            }
            $sql="INSERT INTO reppendientes
            VALUES (NULL, '".$_POST["id"]."','".$_POST["fecha"]."','".$_POST["tipo_roblema"]."', '".$_POST["descripcion"]."'
                    '".$_POST["estado"]."');";
        
            mysqli_query($db, $sql);

            header ("Location:Inicio_usuario.php");
        }
    /**$sql="INSERT INTO reports
    VALUES ('".$curp."','".$id_admim."','"."','"
    ."','".$_POST["tipo_problema"]."','".$_POST["descripcion"]."';"; 
    $insert_usuarios=mysqli_query($db, $sql);
        if($insert_usuarios){
            echo "Datos guardados a la bd";
            header("Location: index.php");
        }**/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Problemas</title>
    <link rel="stylesheet" href="estilosRepo.css">
</head>
<body>
    <div class="container">
        <h1>Reporte de Problemas</h1>

        <form class="Reporte" action="Reports.php" method="POST">
        <input type="hidden" name="id" value="<?=$curp?>">
        <input type="hidden" name="fecha" value="<?=$fecha?>">
        <input type="hidden" name="estado" value="Sin resolver">
            <div class="form-group">
                <label for="tipo_problema">Tipo de Problema:</label>
                <select id="tipo_problema" name="tipo_roblema" required>
                    <option value="Software">Problemas de Software</option>
                    <option value="Hardware">Problemas de Hardware</option>
                    <option value="Other">Otros Problemas</option>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción del problema:</label>
                <input type="text" id="descripcion" name="descripcion" required>
            </div>
            <input type="submit" name="enviar" value="Enviar Reporte">
        </form>
    </div>
    <!--<footer>
        <div class="prob">
            <h2 onclick="toggleContent()">Calculadora de Probabilidad Poisson</h2>
            <form id="form" action="" method="post">
                <label for="numProblemas">Cantidad de problemas:</label>
                <input type="number" id="numProblemas" name="numProblemas" min="0" placeholder="Ingrese la cantidad de problemas">
                <input type="submit" name="calcular" value="Calcular Probabilidad">
            </form>
            <?php
                /**if(isset($_POST['calcular'])) {
                    $numProblemas = intval($_POST['numProblemas']);
                    $promedio = 5;
                    $probabilidad = pow($promedio, $numProblemas) * exp(-$promedio) / factorial($numProblemas);
                    echo "<p id='resultado'>Su problema tiene una probabilidad de " . number_format($probabilidad, 4) . " de ser resuelto.</p>";
                }

                function factorial($n) {
                    if ($n === 0 || $n === 1)
                        return 1;
                    for ($i = $n - 1; $i >= 1; $i--) {
                        $n *= $i;
                    }
                    return $n;
                }
            */?>
        </div>
        <p id="nota">Probabilidad calculada utilizando la distribución de Poisson.</p>
    </footer>

    <script>
        function toggleContent() {
            var form = document.getElementById("form");
            var resultado = document.getElementById("resultado");
            var nota = document.getElementById("nota");
            if (form.style.display === "none") {
                form.style.display = "block";
                resultado.style.display = "block";
                nota.style.display = "none";
            } else {
                form.style.display = "none";
                resultado.style.display = "none";
                nota.style.display = "block";
            }
        }
    </script>-->
</body>
</html>
