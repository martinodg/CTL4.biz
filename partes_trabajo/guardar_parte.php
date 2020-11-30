<?
require_once("../conectar.php");
require_once("../funciones/fechas.php");

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$codpresupuesto=$_POST["codpresupuesto"];
$codtrabajador=$_POST["codtrabajador"];
$nombre=$_POST["nombre"];
$titulo=$_POST["titulo"];
$descripcion=$_POST["descripcion"];
$estado="1";
$horasprevistas=$_POST["horasprevistas"];
$preciohora=$_POST["preciohora"];
$fechacreacion=explota($_POST["fecha"]);
$fechacomienzo=explota($_POST["fecha"]);
$minimo=0;

if ($accion=="alta") {
	$query_operacion  = "INSERT INTO partestrabajo ( codpresupuesto, codtrabajador, nombre, titulo, descripcion, estado, horasprevistas, preciohora, fechacreacion, fechacomienzo) ";
	$query_operacion .= "VALUES ('$codpresupuesto', '$codtrabajador', '$nombre', '$titulo', '$descripcion', '$estado', '$horasprevistas', '$preciohora', '$fechacreacion', '$fechacomienzo' )";
	$rs_operacion=mysqli_query($conexion,$query_operacion);
	$codparte=mysqli_insert_id($conexion);
	$cabecera1="Inicio >> Partes de Trabajo &gt;&gt; Nuevo Parte ";
	$cabecera2="PARTE DE TRABAJO CREADO ";
}

if ($accion=="modificar") {
	$codtrabajo=$_POST["codtrabajo"];

$estado=$_POST["estado"];
$horasinvertidas=$_POST["horasinvertidas"];

if ( $_POST["fechacomienzo"] <> "" ) { $fechacomienzo=explota($_POST["fechacomienzo"]); }
if ( $_POST["fechalectura"] <> "" ) { $fechalectura=explota($_POST["fechalectura"]); }
if ( $_POST["fechafinalizacion"] <> "" ) { $fechafinalizacion=explota($_POST["fechafinalizacion"]); }


$act_albaran =  "UPDATE partestrabajo SET codpresupuesto='$codpresupuesto', codtrabajador='$codtrabajador', nombre='$nombre', titulo='$titulo', descripcion='$descripcion', estado='$estado', preciohora='$preciohora', horasprevistas='$horasprevistas', horasinvertidas='$horasinvertidas', fechalectura='$fechalectura', fechacomienzo='$fechacomienzo', fechafinalizacion='$fechafinalizacion' ";
$act_albaran .= "WHERE codtrabajo='$codtrabajo'";
	$rs_albaran=mysqli_query($conexion,$act_albaran);
#echo "SQL: $act_albaran <br>";
	$mensaje="Los datos del parte de trabajo han sido modificados correctamente";
	$cabecera1="Inicio >> Ventas &gt;&gt; Modificar Albar&aacute;n ";
	$cabecera2="MODIFICAR ALBAR&Aacute;N ";
}

if ($accion=="baja") {
	$codtrabajo=$_GET["codtrabajo"];
	$query="DELETE FROM partestrabajo WHERE codtrabajo='$codtrabajo'";
	$rs_query=mysqli_query($conexion,$query);
	$mensaje="El parte de trabajo ha sido eliminado correctamente";
	$cabecera1="Inicio >> Partes de Trabajo &gt;&gt; Eliminar Parte de Trabajo";
	$cabecera2="PARTE DE TRABAJO ELIMINADO";
header("Location: rejilla.php");
exit;
}

if ($_GET['accion'] =="ver") {
$accion = "modificar";
$codtrabajo=$_GET["codtrabajo"];
$sel_parte="SELECT * FROM partestrabajo WHERE codtrabajo='$codtrabajo'";
$rs_parte=mysqli_query($conexion,$sel_parte);
$codpresupuesto=mysqli_result($rs_parte,0,"codpresupuesto");
$codtrabajador=mysqli_result($rs_parte,0,"codtrabajador");
$fechacomienzo=mysqli_result($rs_parte,0,"fechacomienzo");
$fechalectura=mysqli_result($rs_parte,0,"fechalectura");
$fechafinalizacion=mysqli_result($rs_parte,0,"fechafinalizacion");
$titulo=mysqli_result($rs_parte,0,"titulo");
$descripcion=mysqli_result($rs_parte,0,"descripcion");
$horasprevistas=mysqli_result($rs_parte,0,"horasprevistas");
$horasinvertidas=mysqli_result($rs_parte,0,"horasinvertidas");
$preciohora=mysqli_result($rs_parte,0,"preciohora");
$estado=mysqli_result($rs_parte,0,"estado");

$sel_trabajador="SELECT * FROM trabajadores WHERE codtrabajador='$codtrabajador'";
$rs_trabajador=mysqli_query($conexion,$sel_trabajador);
$nombre=mysqli_result($rs_trabajador,0,"nombre");
$nif=mysqli_result($rs_trabajador,0,"nif");


	$cabecera1="Inicio >> Partes de Trabajo &gt;&gt; Ver Parte";
	$cabecera2="VER PARTE DE TRABAJO";
}

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}

		function aceptar() {
			location.href="index.php";
		}

		function imprimir(codparte) {
			window.open("../fpdf/imprimir_parte.php?codparte="+codparte);
		}

		function imprimirf(codfactura) {
			window.open("../fpdf/imprimir_factura.php?codfactura="+codfactura);
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
						<? if ($minimo==1) { ?>
						<tr>
							<td width="15%"></td>
							<td width="85%" colspan="2" class="mensajeminimo">Los siguientes art&iacute;culos est&aacute;n bajo m&iacute;nimo:<br><?php echo $mensaje_minimo;?></td>
					    </tr>
						<? }
						 $sel_trabajador="SELECT * FROM trabajadores WHERE codtrabajador='$codtrabajador'";
						  $rs_trabajador=mysqli_query($conexion,$sel_trabajador); ?>
						<tr>
							<td width="15%">Trabajador</td>
							<td width="85%" colspan="2"><?php echo mysqli_result($rs_trabajador,0,"nombre"); ?></td>
					    </tr>
						<tr>
							<td width="15%">C&oacute;digo Presupuesto</td>
						    <td width="85%" colspan="2"><?php echo $codpresupuesto; ?></td>
					    </tr>
						<tr>
						  <td>T&iacute;tulo Trabajo</td>
						  <td colspan="2"><?php echo $titulo; ?></td>
					  </tr>
						<tr>
						  <td>Descripci&oacute;n</td>
						  <td colspan="2"><?php echo nl2br($descripcion); ?></td>
					  </tr>
					  	<tr>
						  <td>Horas previstas</td>
						  <td colspan="2"><?php echo $horasprevistas; ?></td>
					  </tr>
					  <tr>
						  <td>Precio / Hora</td>
						  <td colspan="2"><?php echo $preciohora; ?></td>
					  </tr>
<tr>
<td>Total previsto</td>
<td colspan="2"><?php echo $preciohora*$horasprevistas; ?></td>
</tr>
<tr>
<td>Fecha Comienzo</td>
<td colspan="2"><?php echo implota($fechacomienzo)?></td>
</tr>
<?php if ( $accion == "modificar" ) { ?>
<tr>
<td>Fecha Lectura</td>
<td colspan="2"><?php echo implota($fechalectura)?></td>
</tr>
<tr>
<td>Fecha Finalizaci&oacute;n</td>
<td colspan="2"><?php echo implota($fechafinalizacion)?></td>
</tr>
<tr>
<td>Horas invertidas</td>
<td colspan="2"><?php echo $horasinvertidas; ?></td>
</tr>
<tr>
<td>Total invertido</td>
<td colspan="2"><?php echo $preciohora * $horasinvertidas; ?></td>
</tr>
<tr>
<td>Estado</td>
<td colspan="2"><?php echo $estados_partestrabajo[$estado]; ?></td>
</tr>

<?php } ?>

					  <tr>
						  <td></td>
						  <td colspan="2"></td>
					  </tr>
				  </table>
</div>
<div id="botonBusqueda">
<div align="center">
					 <button type="button" id="btnaceptar" onClick="aceptar()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span>Aceptar</span> </button>
<button type="button" id="btnimprimir"  onClick="window.print();" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span>Imprimir</span> </button>
				        </div>
					</div>
			  </div>
		  </div>
		</div>
	</body>
</html>
