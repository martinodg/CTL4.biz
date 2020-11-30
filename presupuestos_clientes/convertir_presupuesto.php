<?php
require_once("../conectar7.php");
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");

$codpresupuesto=$_GET["codpresupuesto"];
$sel_presupuesto="SELECT fecha FROM presupuestos WHERE codpresupuesto='$codpresupuesto'";
$rs_presupuesto=mysqli_query($conexion,$sel_presupuesto);
$fecha=mysqli_result($rs_presupuesto,0,"fecha");
$fecha=implota($fecha);
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
				<div id="tituloForm" class="header">CONVERTIR ALBARAN </div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_presupuesto.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="14%">C&oacute;digo de presupuesto</td>
						    <td width="36%"><? echo $codpresupuesto?></td>
				            <td width="50%"><ul id="lista-errores"></ul></td>
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
					<input id="codpresupuesto" name="codpresupuesto" value="<? echo $codpresupuesto?>" type="hidden">
			  </div>
			  </form>
			 </div>
		  </div>
		</div>
	</body>
</html>
