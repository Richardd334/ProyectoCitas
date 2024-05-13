<?php
session_start();
if (!array_key_exists('Paso por login', $_SESSION) && !array_key_exists('admin', $_SESSION) ) {
   header('Location: login.php');
   die;
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>cich.mx</title>
</head>
<body>
    <header class="head">Clinica de Salud de Chiapas 
    <img src="favicon/clinica.png" id="clinica"></header>
    <nav>
  <ul>
    <li><a href="#">Citas</a></li>
    <li class="dropdown" id="admin">
      <a href="#" class="dropbtn">Administracion</a>
      <div class="dropdown-content">
        <a href="#">Ver citas</a>
        <a href="VerUsuarios.php">Ver usuarios</a>
        <a href="Colab.php">Ver colaboradores</a>
        <a href="VerReportes.php">Ver reportes</a>
      </div>
    </li>
    
    <li class="dropdown">
      <a href="#" class="dropbtn">Horarios de Atención</a>
      <div class="dropdown-content">
        <a href="#">Lunes a Viernes</a>
        <a href="#">Sábados</a>
        <a href="#">Domingos</a>
      </div>
        </li>
        <li><a href="cerrar_sesion.php">Salir</a></li>
    </ul>
    </nav>
    <section class="content">
      <div class="top">

      </div>
      <div class="flex">
        <div class="Izq">
          <h1>Noticias</h1>
          <p>
            El Gobierno de López Obrador alista su “megafarmacia”, un plan que genera dudas entre especialistas.</b> <br>
            El Gobierno de México se prepara para inaugurar una “megafarmacia” que, según el presidente Andrés Manuel 
            López Obrador, contará con todos los medicamentos existentes y podrá surtir en 24 horas a las instituciones 
            públicas de salud que lo requieran. Sin embargo, el plan genera dudas entre especialistas consultados por CNN, 
            que cuestionan que vaya a funcionar como el Ejecutivo promete. <br> <a href="https://cnnespanol.cnn.com/2023/12/27/gobiern-lopez-obrador-megafarmacia-plan-dudas-entre-especialistas-orix/">Leer más</a>
          </p>
        </div>
        <div class="med">
          <h1></h1>
        </div>
        <div class="der">
          <h1>Noticias2</h1>
        </div>
      </div>
     
    
    </section>
</body>
</html>