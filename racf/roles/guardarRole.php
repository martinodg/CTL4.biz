<?
include ("../../conectar7.php");

$accion=$_GET["accion"];
$codrole=$_GET["codigo"];
$nombre=$_GET["nombre"];
$estado=$_GET["estado"];


if ($accion=="alta") {
	$query_operacion="INSERT INTO internalUsersTable (intUserName, intUserMail, intUserPass, codstatus, borrado) VALUES ('$nombre','$mail', '$password', '4', '0')";
	$rs_operacion=mysqli_query($conexion,$query_operacion);
	if ($rs_operacion) { $mensaje="El Usuario ha sido dado de alta correctamente"; }
	
	
}

if ($accion=="modificar") {
	$query="UPDATE rolesTable SET roleName='$nombre', codstatus='$estado' WHERE id_role='$codrole'";
	$rs_query=mysqli_query($conexion,$query);
	if ($rs_query) { $mensaje="Los datos del usuario han sido modificados correctamente"; }
	$cabecera1="Settings >> Modificar Usuarios &gt;&gt; Modificar Usuarios ";
	$cabecera2="MODIFICAR Usuarios ";
}

echo "<script>console.log($msenaje);</script>";
?>

