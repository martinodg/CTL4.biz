<?php
require_once("../conectar7.php");
require_once("../mysqli_result.php");

$codtrabajador=$_POST["codtrabajador"];
$nombre=$_POST["nombre"];
$nif=$_POST["nif"];
$codprovincia=$_POST["cboProvincias"];
$localidad=$_POST["localidad"];
$telefono=$_POST["telefono"];
$cadena_busqueda=$_POST["cadena_busqueda"];

$where="1=1";
if ($codtrabajador <> "") { $where.=" AND codtrabajador='$codtrabajador'"; }
if ($nombre <> "") { $where.=" AND nombre like '%".$nombre."%'"; }
if ($nif <> "") { $where.=" AND nif like '%".$nif."%'"; }

$where.=" ORDER BY nombre ASC";
$query_busqueda="SELECT count(*) as filas FROM trabajadores WHERE borrado=0 AND ".$where;
$rs_busqueda=mysqli_query($conexion,$query_busqueda);
$filas=mysqli_result($rs_busqueda,0,"filas");

?>
<html>
	<head>
		<title>Trabajadores</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">

		function ver_trabajador(codtrabajador) {
			parent.location.href="guardar_trabajador.php?codtrabajador=" + codtrabajador + "&accion=ver";
		}

		function modificar_trabajador(codtrabajador) {
			parent.location.href="modificar_trabajador.php?codtrabajador=" + codtrabajador + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}

		function eliminar_trabajador(codtrabajador) {
			parent.location.href="eliminar_trabajador.php?codtrabajador=" + codtrabajador + "&cadena_busqueda=<? echo $cadena_busqueda?>";
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
				texto=contador + "-" + parseInt(contador+9);
				if (indi==contador) {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
					parent.document.form_busqueda.paginas.options[indice].selected=true;
				} else {
					parent.document.form_busqueda.paginas.options[indice]=new Option (texto,contador);
				}
				indice++;
				contador=contador+10;
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
						<? $sel_resultado="SELECT * FROM trabajadores WHERE borrado=0 AND ".$where;
						   $sel_resultado=$sel_resultado."  limit ".$iniciopagina.",10";
						   $res_resultado=mysqli_query($conexion,$sel_resultado);
						   $contador=0;
						   while ($contador < mysqli_num_rows($res_resultado)) {
								 if ($contador % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }?>
						<tr class="<?php echo $fondolinea?>">
							<td class="aCentro" width="8%"><? echo $contador+1;?></td>
							<td width="6%"><div align="center"><? echo mysqli_result($res_resultado,$contador,"codtrabajador")?></div></td>
							<td width="38%"><div align="left"><? echo mysqli_result($res_resultado,$contador,"nombre")?></div></td>
							<td class="aDerecha" width="13%"><div align="center"><? echo mysqli_result($res_resultado,$contador,"nif")?></div></td>
							<td class="aDerecha" width="19%"><div align="center"><? echo mysqli_result($res_resultado,$contador,"telefono")?></div></td>
							<td width="5%"><div align="center"><a href="#"><img src="../img/modificar.svg" width="16" height="16" border="0" onClick="modificar_trabajador(<?php echo mysqli_result($res_resultado,$contador,"codtrabajador")?>)" title="Modificar"></a></div></td>
														<td width="5%"><div align="center"><a href="#"><img src="../img/ver.svg" width="16" height="16" border="0" onClick="ver_trabajador(<?php echo mysqli_result($res_resultado,$contador,"codtrabajador")?>)" title="Visualizar"></a></div></td>
							<td width="6%"><div align="center"><a href="#"><img src="../img/eliminar.svg" width="16" height="16" border="0" onClick="if (confirm('�Est� seguro de eliminar el trabajador? Podr�an quedar partes de trabajo hu�rfanos!')) { eliminar_trabajador(<?php echo mysqli_result($res_resultado,$contador,"codtrabajador")?>) }" title="Eliminar"></a></div></td>
						</tr>
						<? $contador++;
							}
						?>
					</table>
					<? } else { ?>
					<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="100%" class="mensaje"><?php echo "No hay ning&uacute;n trabajador que cumpla con los criterios de b&uacute;squeda";?></td>
					    </tr>
					</table>
					<? } ?>
				</div>
			</div>
		  </div>
		</div>
	</body>
</html>
