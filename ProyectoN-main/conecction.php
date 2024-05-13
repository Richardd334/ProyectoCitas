<?php 
    //conexion
    $db=new mysqli("localhost", "root", "", "tickets_citas");
    //codificador de caracteres
    mysqli_query($db, "SET NAMES 'utf8'");

    