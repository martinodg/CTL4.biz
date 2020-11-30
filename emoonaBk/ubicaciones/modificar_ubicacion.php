<?php require_once("../conectar7.php"); 
require_once("../mysqli_result.php");

$codubicacion=$_GET["codubicacion"];

$query="SELECT * FROM ubicaciones WHERE codubicacion='$codubicacion'";
$rs_query=mysqli_query($conexion,$query);

?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../funciones/validar.js"></script>
		<script language="javascript">
		
		function cancelar() {
			location.href="index.php?cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function limpiar() {
			document.getElementById("nombre").value="";
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
				<div id="tituloForm" class="header">MODIFICAR UBICACI&Oacute;N </div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_ubicacion.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td>C&oacute;digo</td>
							<td><?php echo $codubicacion?></td>
						    <td width="42%" rowspan="2" align="left" valign="top"><ul id="lista-errores"></ul></td>
						</tr>
						<tr>
							<td width="15%">Nombre</td>
						    <td width="43%"><input NAME="Anombre" type="text" class="cajaGrande" id="nombre" size="45" maxlength="45" value="<?php echo mysqli_result($rs_query,0,"nombre")?>"></td>
				        </tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<button type="button" id="btnaceptar" onClick="validar(formulario,true)"  onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span>Aceptar</span> </button>

					<button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span>Limpiar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span>Cancelar</span> </button>
					<input id="accion" name="accion" value="modificar" type="hidden">
					<input id="id" name="Zid" value="<?php echo $codubicacion?>" type="hidden">
			  </div>
			  </form>
			 </div>
		  </div>
		</div>
	</body>
</html>
