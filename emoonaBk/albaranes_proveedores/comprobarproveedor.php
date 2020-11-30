<?php
header('Cache-Control: no-cache');
header('Pragma: no-cache'); 
?>
<html>
<head>
<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
</head>
<script language="javascript">

function pon_prefijo(nombre,nif) {
	parent.document.formulario.nombre.value=nombre;
	parent.document.formulario.nif.value=nif;
}

function limpiar() {
	parent.document.formulario.nombre.value="";
	parent.document.formulario.nif.value="";
	parent.document.formulario.codproveedor.value="";
}

</script>
<? require_once("../conectar7.php"); ?>
require_once("../mysqli_result.php");
<body>
<?
	$codproveedor=$_GET["codproveedor"];
	$consulta="SELECT * FROM proveedores WHERE codproveedor='$codproveedor' AND borrado=0";
	$rs_tabla = mysqli_query($conexion,$consulta);
	if (mysqli_num_rows($rs_tabla)>0) {
		?>
		<script languaje="javascript">
		pon_prefijo("<? echo mysqli_result($rs_tabla,0,nombre) ?>","<? echo mysqli_result($rs_tabla,0,nif) ?>");
		</script>
		<? 
	} else { ?>
	<script>
	alert ("No existe ningun proveedor con ese codigo");
	limpiar();
	</script>
	<? }
?>
</div>
</body>
</html>
