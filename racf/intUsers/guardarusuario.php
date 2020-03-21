<?
include ("../../conectar7.php");

$accion=$_GET["accion"];
$codusuario=$GET["codusuario"];
$nombre=$_GET["name"];
$mail=$_GET["email"];
$password=$_GET["password"];
$estado=$_GET["estado"];
echo $codusuario;

if ($accion=="alta") {
	$query_operacion="INSERT INTO internalUsersTable (intUserName, intUserMail, intUserPass, codstatus, borrado) VALUES ('$nombre','$mail', '$password', '4', '0')";
	$rs_operacion=mysqli_query($conexion,$query_operacion);
	if ($rs_operacion) { $mensaje="El Usuario ha sido dado de alta correctamente"; }
	
	
}

if ($accion=="modificar") {
	$query="UPDATE internalUsersTable SET intUserMail='$mail', intUserPass='$password', codstatus='$estado' WHERE intUserName='$nombre'";
	$rs_query=mysqli_query($conexion,$query);
	if ($rs_query) { $mensaje="Los datos del usuario han sido modificados correctamente"; }
	$cabecera1="Settings >> Modificar Usuarios &gt;&gt; Modificar Usuarios ";
	$cabecera2="MODIFICAR Usuarios ";
}

if ($_GET['accion']=="ver") {
	$codtrabajador=$_GET["codtrabajador"];

$codtrabajador=$_GET["codtrabajador"];

$query="SELECT * FROM trabajadores WHERE codtrabajador='$codtrabajador'";
$rs_query=mysqli_query($conexion,$query);

$nombre = mysqli_result($rs_query,0,"nombre");
$nif = mysqli_result($rs_query,0,"nif");
$password = mysqli_result($rs_query,0,"password");
$telefono = mysqli_result($rs_query,0,"telefono");
$movil = mysqli_result($rs_query,0,"movil");
$movilavisos = mysqli_result($rs_query,0,"movilavisos");
$email = mysqli_result($rs_query,0,"email");
$emailavisos = mysqli_result($rs_query,0,"emailavisos");

$cabecera1="Inicio >> Trabajadores &gt;&gt; Ver Trabajador ";
	$cabecera2="VER TRABAJADOR ";
}


echo $mensaje;
?>

