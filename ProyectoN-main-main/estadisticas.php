<?php
require_once "conecction.php";
session_start();
if (!array_key_exists('Paso por login', $_SESSION)) {
    header('Location: login.php');
    die;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Estadísticas de Reportes</title>
    <!-- Incluimos la librería de Google Charts para las gráficas -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <h1>Estadísticas de Reportes</h1>
    <?php
    // obtener los datos de la BD

    $TotalReports = mysqli_num_rows(mysqli_query($db, "SELECT * from reports where Estado='Resuelto'"));

    $mysql = mysqli_query($db, "SELECT count(*) as total from reppendientes WHERE Tipo_problema='Software';");
    $TotalSoft = mysqli_fetch_assoc($mysql);

    $mysql = mysqli_query($db, "SELECT count(*) as total from reppendientes WHERE Tipo_problema='Hardware';");
    $TotalHard = mysqli_fetch_assoc($mysql);

    $mysql = mysqli_query($db, "SELECT count(*) as total from reppendientes WHERE Tipo_problema='Other';");
    $TotalOther = mysqli_fetch_assoc($mysql);

    $reportes = array(
        "Software" => intval($TotalSoft["total"]),
        "Hardware" => intval($TotalHard["total"]),
        "Otros" => intval($TotalOther["total"])
    );

    // Convertimos los datos en un formato que pueda ser utilizado por Google Charts
    $data = [['Razón', 'Cantidad']];
    foreach ($reportes as $razon => $cantidad) {
        $data[] = [$razon, $cantidad];
    }
    ?>

    <!-- Creamos un contenedor para la gráfica -->
    <div id="chart_div" style="width: 800px; height: 400px;"></div>

    <?php

    //Calular el tiempo de solución
    // $command=mysqli_query($db, "SELECT fecha_inicio, fecha_solucion from reports where Estado='Resuelto'");
    $command = mysqli_query($db, "SELECT TIMESTAMPDIFF( SECOND, fecha_inicio, fecha_solucion) AS tiempo FROM reports where Estado='Resuelto'");
    $timeSol = 0;

    while ($fechas = mysqli_fetch_assoc($command)) {

        $timeSol += floatval($fechas["tiempo"]);
    }
    $timeSol = $timeSol / 3600;
    $tempoProm = round($timeSol / $TotalReports, 3);

    echo "Tiempo promedio para resolver un problema: $tempoProm horas";
    ?>


    <div id="Promedios">
        <div id="TituloP">
            <h2>Promedio de horas para la solucion de un problema</h2>
            <h3></h3>
        </div>
    </div>

    <!--script para la grafica de pastel-->
    <script>
        // Cargamos la librería de Google Charts
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Llamamos a la función para dibujar la gráfica cuando la librería esté lista
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Creamos un objeto de datos de Google Charts
            var data = google.visualization.arrayToDataTable(<?php echo json_encode($data); ?>);

            // Configuramos las opciones de la gráfica
            var options = {
                title: 'Motivos de Reporte',
                is3D: true,
            };

            // Creamos la instancia de la gráfica y la dibujamos en el contenedor
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
    <a href="inicio_admin.php" class="boton-volver">Volver al inicio</a>
</body>

</html>