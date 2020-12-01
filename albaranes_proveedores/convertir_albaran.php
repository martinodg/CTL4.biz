<?php 
require_once("../conectar7.php");
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");
 
$codalbaran=$_GET["codalbaran"];
$codproveedor=$_GET["codproveedor"];
$sel_albaran="SELECT fecha FROM albaranesp WHERE codalbaran='$codalbaran' AND codproveedor='$codproveedor'";
$rs_albaran=mysqli_query($conexion,$sel_albaran);
$fecha=mysqli_result($rs_albaran,0,"fecha");
$fecha=implota($fecha);
$sel_proveedor="SELECT nombre FROM proveedores WHERE codproveedor='$codproveedor'";
$rs_proveedor=mysqli_query($conexion,$sel_proveedor);
$nombre_proveedor=mysqli_result($rs_proveedor,0,"nombre");
?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script type="text/javascript" src="../funciones/validar.js"></script>
		<link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
		<script language="javascript">
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function cancelar() {
			location.href="index.php";
		}
		
		function limpiar() {
			document.getElementById("formulario").reset();
		}
			
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">CONVERTIR ALBAR&Aacute;N </div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_albaran.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="14%">C&oacute;digo de albar&aacute;n</td>
						    <td width="36%"><? echo $codalbaran?></td>
				            <td width="50%"><ul id="lista-errores"></ul></td>
						</tr>
						<tr>
							<td width="14%">Proveedor</td>
						    <td width="36%"><? echo $nombre_proveedor?></td>
				            <td width="50%"></td>
						</tr>
						<tr>
							<td width="14%">N. Factura</td>
						    <td width="36%"><input type="text" name="Acodfactura" id="codfactura" class="cajaMedia" maxlength="20"></td>
				            <td width="50%"></td>
						</tr>
						<tr>
							<td width="14%">Fecha</td>
						    <td width="36%"><input NAME="fecha" type="text" class="cajaPequena" id="fecha" size="10" maxlength="10" value="<? echo $fecha?>" readonly> <img src="../img/calendario.svg" name="Image1" id="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
        <script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fecha",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
					  }
					);
		</script></td>
				            <td width="50%"></td>
						</tr>							
					</table>
			  </div>
				<div id="botonBusqueda">
					<input type="hidden" name="id" id="id" value="">
					<button type="button" id="btnaceptar" onClick="validar(formulario,true)"  onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span>Aceptar</span> </button>

					<button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span>Limpiar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span>Cancelar</span> </button>
					<input id="accion" name="accion" value="convertir" type="hidden">
					<input id="codalbaran" name="codalbaran" value="<? echo $codalbaran?>" type="hidden">
					<input id="codproveedor" name="codproveedor" value="<? echo $codproveedor?>" type="hidden">
			  </div>
			  </form>
			 </div>
		  </div>
		</div>
	</body>
</html>
