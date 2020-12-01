<?php
require_once("../conectar7.php");
require_once("../mysqli_result.php");
require_once("../funciones/fechas.php");

$codcliente=$_POST["codcliente"];
$nombre=$_POST["nombre"];
$numpresupuesto=$_POST["numpresupuesto"];
$estado=$_POST["cboEstados"];
$fechainicio=$_POST["fechainicio"];
if ($fechainicio<>"") { $fechainicio=explota($fechainicio); }
$fechafin=$_POST["fechafin"];
if ($fechafin<>"") { $fechafin=explota($fechafin); }

$cadena_busqueda=$_POST["cadena_busqueda"];

$where="1=1";
if ($codcliente <> "") { $where.=" AND presupuestos.codcliente='$codcliente'"; }
if ($nombre <> "") { $where.=" AND clientes.nombre like '%".$nombre."%'"; }
if ($numpresupuesto <> "") { $where.=" AND codpresupuesto='$numpresupuesto'"; }
if ($estado > "0") { $where.=" AND estado='$estado'"; }
if (($fechainicio<>"") and ($fechafin<>"")) {
	$where.=" AND fecha between '".$fechainicio."' AND '".$fechafin."'";
} else {
	if ($fechainicio<>"") {
		$where.=" and fecha>='".$fechainicio."'";
	} else {
		if ($fechafin<>"") {
			$where.=" and fecha<='".$fechafin."'";
		}
	}
}

$where.=" ORDER BY codpresupuesto DESC";
$query_busqueda="SELECT count(*) as filas FROM presupuestos,clientes WHERE presupuestos.borrado=0 AND presupuestos.codcliente=clientes.codcliente AND ".$where;

$rs_busqueda=mysqli_query($conexion,$query_busqueda);
$filas=mysqli_result($rs_busqueda,0,"filas");

?>
<html>
	<head>
		<title>Clientes</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">

		function ver_presupuesto(codpresupuesto) {
			parent.location.href="ver_presupuesto.php?codpresupuesto=" + codpresupuesto + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}


		function imprimir_etiquetas(codpresupuesto) {
				window.open("../fpdf/codigocontinuo.php?codpresupuesto="+codpresupuesto);
		}

		function imprimir(codpresuspuesto) {
			window.open("../fpdf/imprimir_presupuesto.php?codpresupuesto="+codpresuspuesto);
		}

		function modificar_presupuesto(codpresupuesto,marcaestado) {
			if (marcaestado==1) {
				parent.location.href="modificar_presupuesto.php?codpresupuesto=" + codpresupuesto + "&cadena_busqueda=<? echo $cadena_busqueda?>";
			} else {
				alert ("No puede modificar un presupuesto albaranado");
			}
		}

		function convertir_presupuesto(codpresupuesto,marcaestado) {
			if (marcaestado==1) {
				parent.location.href="convertir_presupuesto.php?codpresupuesto=" + codpresupuesto + "&cadena_busqueda=<? echo $cadena_busqueda?>";
			} else {
				alert ("No se puede convertir en albar�n un presupuesto ya albaranado");
			}
		}

		function eliminar_presupuesto(codpresupuesto) {
			parent.location.href="eliminar_presupuesto.php?codpresupuesto=" + codpresupuesto + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}

		function inicio() {
			var numfilas=document.getElementById("numfilas").value;
			var indi=parent.document.getElementById("iniciopagina").value;
			var contador=1;
			var indice=0;
			if (indi>numfilas) {
				indi=1;
			}
			parent.document.form_busqueda.filas.value=numfilas;
			parent.document.form_busqueda.paginas.innerHTML="";
			while (contador<=numfilas) {
				texto=contador + "-" + parseInt(contador+49);
				if (indi==contador) {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
					parent.document.form_busqueda.paginas.options[indice].selected=true;
				} else {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
				}
				indice++;
				contador=contador+50;
			}
		}
		</script>
	</head>

	<body onload=inicio()>
		<div id="pagina">
			<div id="zonaContenido">
			<div align="center">
			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
			<input type="hidden" name="numfilas" id="numfilas" value="<? echo $filas?>">
				<? $iniciopagina=$_POST["iniciopagina"];
				if (empty($iniciopagina)) { $iniciopagina=$_GET["iniciopagina"]; } else { $iniciopagina=$iniciopagina-1;}
				if (empty($iniciopagina)) { $iniciopagina=0; }
				if ($iniciopagina>$filas) { $iniciopagina=0; }
					if ($filas > 0) { ?>
						<? $sel_resultado="SELECT codpresupuesto,clientes.nombre as nombre,presupuestos.fecha as fecha,totalpresupuesto,estado FROM presupuestos,clientes WHERE presupuestos.borrado=0 AND presupuestos.codcliente=clientes.codcliente AND ".$where;
						   $sel_resultado=$sel_resultado."  limit ".$iniciopagina.",50";
						   $res_resultado=mysqli_query($conexion,$sel_resultado);
						   $contador=0;
						   $marcaestado=0;
						   while ($contador < mysqli_num_rows($res_resultado)) {
						   		$marcaestado=mysqli_result($res_resultado,$contador,"estado");
								if (mysqli_result($res_resultado,$contador,"estado")==1) { $estado="Pendiente"; } else { $estado="Aceptado"; }
								if ($contador % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
							<td class="aCentro" width="8%"><? echo $contador+1;?></td>
							<td width="8%"><div align="center"><? echo mysqli_result($res_resultado,$contador,"codpresupuesto")?></div></td>
							<td width="29%"><div align="left"><? echo mysqli_result($res_resultado,$contador,"nombre")?></div></td>
							<td width="10%"><div align="center"><? echo number_format(mysqli_result($res_resultado,$contador,"totalpresupuesto"),2,",",".")?></div></td>
							<td class="aDerecha" width="10%"><div align="center"><? echo implota(mysqli_result($res_resultado,$contador,"fecha"))?></div></td>
							<td width="10%"><div align="center"><? echo $estado?></div></td>
							<td width="5%"><div align="center"><a href="#"><img src="../img/modificar.svg" width="16" height="16" border="0" onClick="modificar_presupuesto(<?php echo mysqli_result($res_resultado,$contador,"codpresupuesto")?>,<? echo $marcaestado?>)" title="Modificar"></a></div></td>
							<td width="5%"><div align="center"><a href="#"><img src="../img/ver.svg" width="16" height="16" border="0" onClick="ver_presupuesto(<?php echo mysqli_result($res_resultado,$contador,"codpresupuesto")?>)" title="Visualizar"></a></div></td>
							<td width="5%"><div align="center"><a href="#"><img src="../img/eliminar.svg" width="16" height="16" border="0" onClick="eliminar_presupuesto(<?php echo mysqli_result($res_resultado,$contador,"codpresupuesto")?>,<? echo $marcaestado?>)" title="Eliminar"></a></div></td>
							<td width="5%"><div align="center"><a href="#"><img src="../img/convertir.svg" width="16px" height="16px" width="16" height="16" border="0" onClick="convertir_presupuesto(<?php echo mysqli_result($res_resultado,$contador,"codpresupuesto")?>,<? echo $marcaestado?>)" title="Albaranar"></a></div></td>
							<td width="5%"><div align="center"><a href="#"><img src="../img/printer.svg" width="16" height="16" border="0" onClick="imprimir(<?php echo mysqli_result($res_resultado,$contador,"codpresupuesto")?>)" title="Imprimir"></a></div></td>
						</tr>
						<? $contador++;
							}
						?>
					</table>
					<? } else { ?>
					<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="100%" class="mensaje"><?php echo "No hay ning&uacute;n presupuesto que cumpla con los criterios de b&uacute;squeda";?></td>
					    </tr>
					</table>
					<? } ?>
				</div>
			</div>
		  </div>
		</div>
	</body>
</html>
