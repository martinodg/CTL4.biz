<?
include ("../conectar.php");
include ("../funciones/fechas.php");

$accion=$_POST["accion"];
if (!isset($accion)) { $accion=$_GET["accion"]; }

$codpresupuestotmp=$_POST["codpresupuestotmp"];
$codcliente=$_POST["codcliente"];
$fecha=explota($_POST["fecha"]);
$iva=$_POST["iva"];
$minimo=0;

if ($accion=="alta") {
	$query_operacion="INSERT INTO presupuestos (codpresupuesto, codfactura, fecha, iva, codcliente, estado, borrado) VALUES ('', '0', '$fecha', '$iva', '$codcliente', '1', '0')";
	$rs_operacion=mysql_query($query_operacion);
	$codpresupuesto=mysql_insert_id();
	if ($rs_operacion) { $mensaje="El presupuesto ha sido dado de alta correctamente"; }
	$query_tmp="SELECT * FROM presulineatmp WHERE codpresupuesto='$codpresupuestotmp' ORDER BY numlinea ASC";
	$rs_tmp=mysql_query($query_tmp);
	$contador=0;
	$baseimponible=0;
	while ($contador < mysql_num_rows($rs_tmp)) {
		$codfamilia=mysql_result($rs_tmp,$contador,"codfamilia");
		$numlinea=mysql_result($rs_tmp,$contador,"numlinea");
		$codigo=mysql_result($rs_tmp,$contador,"codigo");
		$cantidad=mysql_result($rs_tmp,$contador,"cantidad");
		$precio=mysql_result($rs_tmp,$contador,"precio");
		$importe=mysql_result($rs_tmp,$contador,"importe");
		$baseimponible=$baseimponible+$importe;
		$dcto=mysql_result($rs_tmp,$contador,"dcto");
		$sel_insertar="INSERT INTO presulinea (codpresupuesto,numlinea,codfamilia,codigo,cantidad,precio,importe,dcto) VALUES
		('$codpresupuesto','$numlinea','$codfamilia','$codigo','$cantidad','$precio','$importe','$dcto')";
		$rs_insertar=mysql_query($sel_insertar);
// No se controla el stock en los presupuestos
//		$sel_articulos="UPDATE articulos SET stock=(stock-'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_articulos=mysql_query($sel_articulos);
		$sel_minimos = "SELECT stock,stock_minimo,descripcion FROM articulos where codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_minimos= mysql_query($sel_minimos);
		if ((mysql_result($rs_minimos,0,"stock") < mysql_result($rs_minimos,0,"stock_minimo")) or (mysql_result($rs_minimos,0,"stock") <= 0))
	   		{
		  		$mensaje_minimo=$mensaje_minimo . " " . mysql_result($rs_minimos,0,"descripcion")."<br>";
				$minimo=1;
   			};
		$contador++;
	}
	$baseimpuestos=$baseimponible*($iva/100);
	$preciototal=$baseimponible+$baseimpuestos;
	//$preciototal=number_format($preciototal,2);
	$sel_act="UPDATE presupuestos SET totalpresupuesto='$preciototal' WHERE codpresupuesto='$codpresupuesto'";
	$rs_act=mysql_query($sel_act);
	$baseimponible=0;
	$preciototal=0;
	$baseimpuestos=0;
	$cabecera1="Inicio >> Ventas &gt;&gt; Nuevo presupuesto ";
	$cabecera2="INSERTAR PRESUPUESTO ";
}

if ($accion=="modificar") {
	$codpresupuesto=$_POST["codpresupuesto"];
	$act_presupuesto="UPDATE presupuestos SET codcliente='$codcliente', fecha='$fecha', iva='$iva' WHERE codpresupuesto='$codpresupuesto'";
	$rs_presupuesto=mysql_query($act_presupuesto);
	$sel_lineas = "SELECT codigo,codfamilia,cantidad FROM presulinea WHERE codpresupuesto='$codpresupuesto' order by numlinea";
	$rs_lineas = mysql_query($sel_lineas);
	$contador=0;
	while ($contador < mysql_num_rows($rs_lineas)) {
		$codigo=mysql_result($rs_lineas,$contador,"codigo");
		$codfamilia=mysql_result($rs_lineas,$contador,"codfamilia");
		$cantidad=mysql_result($rs_lineas,$contador,"cantidad");
//		$sel_actualizar="UPDATE `articulos` SET stock=(stock+'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_actualizar = mysql_query($sel_actualizar);
		$contador++;
	}
	$sel_borrar = "DELETE FROM presulinea WHERE codpresupuesto='$codpresupuesto'";
	$rs_borrar = mysql_query($sel_borrar);
	$sel_lineastmp = "SELECT * FROM presulineatmp WHERE codpresupuesto='$codpresupuestotmp' ORDER BY numlinea";
	$rs_lineastmp = mysql_query($sel_lineastmp);
	$contador=0;
	$baseimponible=0;
	while ($contador < mysql_num_rows($rs_lineastmp)) {
		$numlinea=mysql_result($rs_lineastmp,$contador,"numlinea");
		$codigo=mysql_result($rs_lineastmp,$contador,"codigo");
		$codfamilia=mysql_result($rs_lineastmp,$contador,"codfamilia");
		$cantidad=mysql_result($rs_lineastmp,$contador,"cantidad");
		$precio=mysql_result($rs_lineastmp,$contador,"precio");
		$importe=mysql_result($rs_lineastmp,$contador,"importe");
		$baseimponible=$baseimponible+$importe;
		$dcto=mysql_result($rs_lineastmp,$contador,"dcto");

		$sel_insert = "INSERT INTO presulinea (codpresupuesto,numlinea,codigo,codfamilia,cantidad,precio,importe,dcto)
		VALUES ('$codpresupuesto','','$codigo','$codfamilia','$cantidad','$precio','$importe','$dcto')";
		$rs_insert = mysql_query($sel_insert);

//		$sel_actualiza="UPDATE articulos SET stock=(stock-'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_actualiza = mysql_query($sel_actualiza);
		$sel_bajominimo = "SELECT codarticulo,codfamilia,stock,stock_minimo,descripcion FROM articulos WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_bajominimo= mysql_query($sel_bajominimo);
		$stock=mysql_result($rs_bajominimo,0,"stock");
		$stock_minimo=mysql_result($rs_bajominimo,0,"stock_minimo");
		$descripcion=mysql_result($rs_bajominimo,0,"descripcion");

		if (($stock < $stock_minimo) or ($stock <= 0))
		   {
			  $mensaje_minimo=$mensaje_minimo . " " . $descripcion."<br>";
			  $minimo=1;
		   };
		$contador++;
	}
	$baseimpuestos=$baseimponible*($iva/100);
	$preciototal=$baseimponible+$baseimpuestos;
	//$preciototal=number_format($preciototal,2);
	$sel_act="UPDATE presupuestos SET totalpresupuesto='$preciototal' WHERE codpresupuesto='$codpresupuesto'";
	$rs_act=mysql_query($sel_act);
	$baseimponible=0;
	$preciototal=0;
	$baseimpuestos=0;
	if ($rs_query) { $mensaje="Los datos del presupuesto han sido modificados correctamente"; }
	$cabecera1="Inicio >> Ventas &gt;&gt; Modificar presupuesto ";
	$cabecera2="MODIFICAR PRESUPUESTO ";
}

if ($accion=="baja") {
	$codpresupuesto=$_GET["codpresupuesto"];
	$query="UPDATE presupuestos SET borrado=1 WHERE codpresupuesto='$codpresupuesto'";
	$rs_query=mysql_query($query);
	$query="SELECT * FROM presulinea WHERE codpresupuesto='$codpresupuesto' ORDER BY numlinea ASC";
	$rs_tmp=mysql_query($query);
	$contador=0;
	$baseimponible=0;
	while ($contador < mysql_num_rows($rs_tmp)) {
		$codfamilia=mysql_result($rs_tmp,$contador,"codfamilia");
		$codigo=mysql_result($rs_tmp,$contador,"codigo");
		$cantidad=mysql_result($rs_tmp,$contador,"cantidad");
//		$sel_articulos="UPDATE articulos SET stock=(stock+'$cantidad') WHERE codarticulo='$codigo' AND codfamilia='$codfamilia'";
		$rs_articulos=mysql_query($sel_articulos);
		$contador++;
	}
	if ($rs_query) { $mensaje="El presupuesto ha sido eliminado correctamente"; }
	$cabecera1="Inicio >> Ventas &gt;&gt; Eliminar presupuesto";
	$cabecera2="ELIMINAR PRESUPUESTO";
	$query_mostrar="SELECT * FROM presupuestos WHERE codpresupuesto='$codpresupuesto'";
	$rs_mostrar=mysql_query($query_mostrar);
	$codcliente=mysql_result($rs_mostrar,0,"codcliente");
	$fecha=mysql_result($rs_mostrar,0,"fecha");
	$iva=mysql_result($rs_mostrar,0,"iva");
}

if ($accion=="convertir") {
	$codpresupuesto=$_POST["codpresupuesto"];
	$fecha=$_POST["fecha"];
	$fecha=explota($fecha);
	$sel_presupuesto="SELECT * FROM presupuestos WHERE codpresupuesto='$codpresupuesto'";
	$rs_presupuesto=mysql_query($sel_presupuesto);
	$iva=mysql_result($rs_presupuesto,0,"iva");
	$codcliente=mysql_result($rs_presupuesto,0,"codcliente");
	$totalfactura=mysql_result($rs_presupuesto,0,"totalpresupuesto");
	$sel_factura="INSERT INTO albaranes (codalbaran,fecha,iva,codcliente,estado,totalalbaran,borrado) VALUES
		('','$fecha','$iva','$codcliente','1','$totalfactura','0')";
	$rs_factura=mysql_query($sel_factura);
	$codfactura=mysql_insert_id();
	$act_presupuesto="UPDATE presupuestos SET codfactura='$codfactura',estado='2' WHERE codpresupuesto='$codpresupuesto'";
	$rs_act=mysql_query($act_presupuesto);
	$sel_lineas="SELECT * FROM presulinea WHERE codpresupuesto='$codpresupuesto' ORDER BY numlinea ASC";
	$rs_lineas=mysql_query($sel_lineas);
	$contador=0;
	while ($contador < mysql_num_rows($rs_lineas)) {
		$codfamilia=mysql_result($rs_lineas,$contador,"codfamilia");
		$codigo=mysql_result($rs_lineas,$contador,"codigo");
		$cantidad=mysql_result($rs_lineas,$contador,"cantidad");
		$precio=mysql_result($rs_lineas,$contador,"precio");
		$importe=mysql_result($rs_lineas,$contador,"importe");
		$dcto=mysql_result($rs_lineas,$contador,"dcto");
		$sel_insert="INSERT INTO albalinea (codalbaran,numlinea,codfamilia,codigo,cantidad,precio,importe,dcto) VALUES
			('$codfactura','','$codfamilia','$codigo','$cantidad','$precio','$importe','$dcto')";
		$rs_insert=mysql_query($sel_insert);
		$contador++;
	}
	$mensaje="El presupuesto ha sido convertido correctamente";
	$cabecera1="Inicio >> Ventas &gt;&gt; Convertir presupuesto";
	$cabecera2="CONVERTIR PRESUPUESTO";
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

		function imprimir(codpresupuesto) {
			window.open("../fpdf/imprimir_presupuesto.php?codpresupuesto="+codpresupuesto);
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
						 $sel_cliente="SELECT * FROM clientes WHERE codcliente='$codcliente'";
						  $rs_cliente=mysql_query($sel_cliente); ?>
						<tr>
							<td width="15%">Cliente</td>
							<td width="85%" colspan="2"><?php echo mysql_result($rs_cliente,0,"nombre");?></td>
					    </tr>
						<tr>
							<td width="15%">NIF / CIF</td>
						    <td width="85%" colspan="2"><?php echo mysql_result($rs_cliente,0,"nif");?></td>
					    </tr>
						<tr>
						  <td>Direcci&oacute;n</td>
						  <td colspan="2"><?php echo mysql_result($rs_cliente,0,"direccion"); ?></td>
					  </tr>
					  <? if ($accion=="convertir") { ?>
						<tr>
						  <td>C&oacute;digo de factura</td>
						  <td colspan="2"><?php echo $codfactura?></td>
					  </tr>
					  <? } else { ?>
					  	<tr>
						  <td>C&oacute;digo de presupuesto</td>
						  <td colspan="2"><?php echo $codpresupuesto?></td>
					  </tr>
					  <? } ?>
					  <tr>
						  <td>Fecha</td>
						  <td colspan="2"><?php echo implota($fecha)?></td>
					  </tr>
					  <tr>
						  <td>IVA</td>
						  <td colspan="2"><?php echo $iva?> %</td>
					  </tr>
					  <tr>
						  <td></td>
						  <td colspan="2"></td>
					  </tr>
				  </table>
					 <table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="5%">ITEM</td>
							<td width="25%">REFERENCIA</td>
							<td width="30%">DESCRIPCION</td>
							<td width="10%">CANTIDAD</td>
							<td width="10%">PRECIO</td>
							<td width="10%">DCTO %</td>
							<td width="10%">IMPORTE</td>
						</tr>
					</table>
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
					  <? $sel_lineas="SELECT presulinea.*,articulos.*,familias.nombre as nombrefamilia FROM presulinea,articulos,familias WHERE presulinea.codpresupuesto='$codpresupuesto' AND presulinea.codigo=articulos.codarticulo AND presulinea.codfamilia=articulos.codfamilia AND articulos.codfamilia=familias.codfamilia ORDER BY presulinea.numlinea ASC";
$rs_lineas=mysql_query($sel_lineas);
						for ($i = 0; $i < mysql_num_rows($rs_lineas); $i++) {
							$numlinea=mysql_result($rs_lineas,$i,"numlinea");
							$codfamilia=mysql_result($rs_lineas,$i,"codfamilia");
							$nombrefamilia=mysql_result($rs_lineas,$i,"nombrefamilia");
							$codarticulo=mysql_result($rs_lineas,$i,"codarticulo");
							$referencia=mysql_result($rs_lineas,$i,"referencia");
							$descripcion=mysql_result($rs_lineas,$i,"descripcion");
							$cantidad=mysql_result($rs_lineas,$i,"cantidad");
							$precio=mysql_result($rs_lineas,$i,"precio");
							$importe=mysql_result($rs_lineas,$i,"importe");
							$baseimponible=$baseimponible+$importe;
							$descuento=mysql_result($rs_lineas,$i,"dcto");
							if ($i % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; } ?>
									<tr class="<? echo $fondolinea?>">
										<td width="5%" class="aCentro"><? echo $i+1?></td>
										<td width="20%"><? echo $referencia?></td>
										<td width="30%"><? echo $descripcion?></td>
										<td width="10%" class="aCentro"><? echo $cantidad?></td>
										<td width="10%" class="aCentro"><? echo $precio?></td>
										<td width="10%" class="aCentro"><? echo $descuento?></td>
										<td width="10%" class="aCentro"><? echo $importe?></td>
									</tr>
					<? } ?>
					</table>
			  </div>
				  <?
				  $baseimpuestos=$baseimponible*($iva/100);
			      $preciototal=$baseimponible+$baseimpuestos;
			      $preciototal=number_format($preciototal,2);
			  	  ?>
					<div id="frmBusqueda">
					<table width="25%" border=0 align="right" cellpadding=3 cellspacing=0 class="fuente8">
						<tr>
							<td width="15%">Base imponible</td>
							<td width="15%"><?php echo number_format($baseimponible,2);?> &#8364;</td>
						</tr>
						<tr>
							<td width="15%">IVA</td>
							<td width="15%"><?php echo number_format($baseimpuestos,2);?> &#8364;</td>
						</tr>
						<tr>
							<td width="15%">Total</td>
							<td width="15%"><?php echo $preciototal?> &#8364;</td>
						</tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<div align="center">
					 <img src="../img/botonaceptar.jpg" width="85" height="22" onClick="aceptar()" border="1" onMouseOver="style.cursor=cursor">
					  <? if ($accion=="convertir") { ?>
					   <img src="../img/botonimprimir.jpg" width="79" height="22" border="1" onClick="imprimirf(<? echo $codfactura?>)" onMouseOver="style.cursor=cursor">
					   <? } else { ?>
					   <img src="../img/botonimprimir.jpg" width="79" height="22" border="1" onClick="imprimir(<? echo $codpresupuesto?>)" onMouseOver="style.cursor=cursor">
					   <? } ?>
				        </div>
					</div>
			  </div>
		  </div>
		</div>
	</body>
</html>