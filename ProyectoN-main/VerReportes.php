<?php
    require_once "conecction.php";
    /*session_start();
    if (!array_key_exists('Paso por login', $_SESSION)) {
        header('Location: login.php');
        die;
    }*/
    $Rpend = mysqli_query($db,"SELECT * FROM reppendientes");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
</head>
<body>
    <h1> Usuarios Registrados </h1>
    <h3> <div align="right"><a href="inicio_admin.php">Inicio </a></div></h3>

    <table border = 2 style="width: 60%;" >
        <tr>
            <th width="2%">id</th>
            <th width="2%">fecha reporte</th>
            <th width="5%">Problema</th>
            <th width="2%">Ver completo/Canalizar</th>
        </tr>
        <?php
        $color = "#EFBEBE";
        while ($usua = mysqli_fetch_assoc($Rpend)){
            if($usua["Estado"]=="Sin resolver"){

            ?>
            
            <tr bgcolor="<?=$color?>">
                <td><?=$usua["Id_Pend"];?></td>
                <td><?=$usua["fecha_inicio"];?></td>
                <td><?=$usua["Tipo_problema"];?></td>
                <td><center><a href="CanalizarRep.php?usua=<?=$usua["Id_Pend"];?>">IR</a></center></td>
            </tr>
            <?php 
            if ($color == "#EFBEBE"){
                $color = "#BEC4EF";
            } else {
                $color="#EFBEBE";
            }
        }
    }?>
    </table>


<footer>
        <div class="prob">
            <h2 onclick="toggleContent()">Calculadora de Probabilidad Poisson</h2>
            <form id="form" action="" method="post">
                <label for="numProblemas">Cantidad de problemas:</label>
                <input type="number" id="numProblemas" name="numProblemas" min="0" placeholder="Ingrese la cantidad de problemas">
                <input type="submit" name="calcular" value="Calcular Probabilidad">
            </form>
            <?php
                if(isset($_POST['calcular'])) {
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
            ?>
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
    </script>
</body>
</html>