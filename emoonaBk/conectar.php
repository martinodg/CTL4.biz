<?php

  require_once("config.php"); 
  $conexion=mysqli_connect($Servidor,$Usuario,$Password) or die("Error: El servidor no puede conectar con la base de datos");
  $descriptor=mysqli_select_db($BaseDeDatos,$conexion);

?>
