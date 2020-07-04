<?php
session_start();
//include("config.php");
$Servidor="database";
$BaseDeDatos= $_SESSION["BaseDeDatos"];
$Usuario= $_SESSION["Usuario_DB"];
$Password= $_SESSION["Password_DB"];
$conexion=mysqli_connect($Servidor,$Usuario,$Password,$BaseDeDatos) or die("Error: El servidor no puede conectar con la base de datos");
 /* $descriptor=mysqli_select_db($BaseDeDatos,$conexion);

function conn() {
    $conexion = new mysqli($Servidor, $Usuario, $Password, $BaseDeDatos);
    $conexion->set_charset('utf8');
    return $mysqli;
}*/
?>