<?
require_once("../conectar7.php"); 
require_once("../mysqli_result.php");

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$nombre=$_POST["Anombre"];

if ($accion=="alta") {
	$query_operacion="INSERT INTO estaciones (codestacion, nombre, borrado) 
					VALUES ('', '$nombre', '0')";					
	$rs_operacion=mysqli_query($conexion,$query_operacion);
	if ($rs_operacion) { $mensaje="La estacion ha sido dada de alta correctamente"; }
	$cabecera1="Inicio >> Estaciones de Trabajo &gt;&gt; Nuevo Tipo ";
	$cabecera2="INSERTAR Estaciones de Trabajo ";
	$sel_maximo="SELECT max(codestacion) as maximo FROM estaciones";
	$rs_maximo=mysqli_query($conexion,$sel_maximo);
	$codestacion=mysqli_result($rs_maximo,0,"maximo");
}

if ($accion=="modificar") {
	$codestacion=$_POST["Zid"];
	$query="UPDATE estaciones SET nombre='$nombre', borrado=0 WHERE codestacion='$codestacion'";
	$rs_query=mysqli_query($conexion,$query);
	if ($rs_query) { $mensaje="Los datos de la estacion han sido modificados correctamente"; }
	$cabecera1="Inicio >> estaciones &gt;&gt; Modificar estacion ";
	$cabecera2="MODIFICAR estacion ";
}

if ($accion=="baja") {
	$codestacion=$_GET["codestacion"];
	$query_comprobar="SELECT * FROM estaciones WHERE codestacion='$codestacion' AND borrado=0";
	$rs_comprobar=mysqli_query($conexion,$query_comprobar);
	if (mysqli_num_rows($rs_comprobar) > 0 ) {
		?><script>
			alert ("No se puede eliminar esta estacion porque tiene estaciones asociados.");
			location.href="eliminar_estacion.php?codestacion=<? echo $codestacion?>";
		</script>
		<?
	} else {
		$query="UPDATE estaciones SET borrado=1 WHERE codestacion='$codestacion'";
		$rs_query=mysqli_query($conexion,$query);
		if ($rs_query) { $mensaje="La estacion ha sido eliminada correctamente"; }
		$cabecera1="Inicio >> estaciones &gt;&gt; Eliminar estacion ";
		$cabecera2="ELIMINAR estacion ";
		$query_mostrar="SELECT * FROM estaciones WHERE codestacion='$codestacion'";
		$rs_mostrar=mysqli_query($conexion,$query_mostrar);
		$codestacion=mysqli_result($rs_mostrar,0,"codestacion");
		$nombre=mysqli_result($rs_mostrar,0,"nombre");
	}
}

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">
		
		function aceptar() {
			location.href="index.php";
		}
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header"><?php echo $cabecera2?></div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="15%"></td>
							<td width="85%" colspan="2" class="mensaje"><?php echo $mensaje;?></td>
					    </tr>
						<tr>
							<td width="15%">C&oacute;digo</td>
							<td width="85%" colspan="2"><?php echo $codestacion?></td>
					    </tr>
						<tr>
							<td width="15%">Nombre</td>
						    <td width="85%" colspan="2"><?php echo $nombre?></td>
					    </tr>						
					</table>
			  </div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="aceptar()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span>Aceptar</span> </button>
			  </div>
			 </div>
		  </div>
		</div>
	</body>
</html>
