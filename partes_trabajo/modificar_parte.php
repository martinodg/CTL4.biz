<?php
require_once("../conectar.php");
require_once("../funciones/fechas.php");

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

?>
<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
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

		var miPopup
		function abreVentana(){
			miPopup = window.open("ver_trabajadores.php","miwin","width=700,height=380,scrollbars=yes");
			miPopup.focus();
		}

		function inicio() {
//			document.getElementById("modif").value=1;
//			document.formulario_lineas.submit();
			document.getElementById("modif").value=0;
		}

		function ventanaArticulos(){
			miPopup = window.open("ver_articulos.php","miwin","width=700,height=500,scrollbars=yes");
			miPopup.focus();
		}

		function validarcliente(){
			var codigo=document.getElementById("codcliente").value;
			miPopup = window.open("comprobarcliente.php?codcliente="+codigo,"frame_datos","width=700,height=80,scrollbars=yes");
		}

		function cancelar() {
			location.href="index.php";
		}

		function limpiarcaja() {
			document.getElementById("nombre").value="";
			document.getElementById("nif").value="";
		}

		function actualizar_importe()
			{
				var precio=document.getElementById("precio").value;
				var cantidad=document.getElementById("cantidad").value;
				var descuento=document.getElementById("descuento").value;
				descuento=descuento/100;
				total=precio*cantidad;
				descuento=total*descuento;
				total=total-descuento;
				var original=parseFloat(total);
				var result=Math.round(original*100)/100 ;
				document.getElementById("importe").value=result;
			}

		function validar_cabecera()
			{
				var mensaje="";
				if (document.getElementById("nombre").value=="") mensaje+="  - Nombre\n";
				if (mensaje!="") {
					alert("Atencion, se han detectado las siguientes incorrecciones:\n\n"+mensaje);
				} else {
					document.getElementById("formulario").submit();
				}
			}

		function validar()
			{
				var mensaje="";
				var entero=0;
				var enteroo=0;

				if (document.getElementById("referencia").value=="") mensaje="  - Referencia\n";
				if (document.getElementById("descripcion").value=="") mensaje+="  - Descripcion\n";
				if (document.getElementById("precio").value=="") {
							mensaje+="  - Falta el precio\n";
						} else {
							if (isNaN(document.getElementById("precio").value)==true) {
								mensaje+="  - El precio debe ser numerico\n";
							}
						}
				if (document.getElementById("cantidad").value=="")
						{
						mensaje+="  - Falta la cantidad\n";
						} else {
							enteroo=parseInt(document.getElementById("cantidad").value);
							if (isNaN(enteroo)==true) {
								mensaje+="  - La cantidad debe ser numerica\n";
							} else {
									document.getElementById("cantidad").value=enteroo;
								}
						}
				if (document.getElementById("descuento").value=="")
						{
						document.getElementById("descuento").value=0
						} else {
							entero=parseInt(document.getElementById("descuento").value);
							if (isNaN(entero)==true) {
								mensaje+="  - El descuento debe ser numerico\n";
							} else {
								document.getElementById("descuento").value=entero;
							}
						}
				if (document.getElementById("importe").value=="") mensaje+="  - Falta el importe\n";

				if (mensaje!="") {
					alert("Atencion, se han detectado las siguientes incorrecciones:\n\n"+mensaje);
				} else {
					document.getElementById("baseimponible").value=parseFloat(document.getElementById("baseimponible").value) + parseFloat(document.getElementById("importe").value);
					cambio_iva();
					document.getElementById("formulario_lineas").submit();
					document.getElementById("referencia").value="";
					document.getElementById("descripcion").value="";
					document.getElementById("precio").value="";
					document.getElementById("cantidad").value=1;
					document.getElementById("importe").value="";
					document.getElementById("descuento").value=0;
				}
			}

		function cambio_iva() {
			var original=parseFloat(document.getElementById("baseimponible").value);
			var result=Math.round(original*100)/100 ;
			document.getElementById("baseimponible").value=result;

			document.getElementById("baseimpuestos").value=parseFloat(result * parseFloat(document.getElementById("iva").value / 100));
			var original1=parseFloat(document.getElementById("baseimpuestos").value);
			var result1=Math.round(original1*100)/100 ;
			document.getElementById("baseimpuestos").value=result1;
			var original2=parseFloat(result + result1);
			var result2=Math.round(original2*100)/100 ;
			document.getElementById("preciototal").value=result2;
		}
		</script>
	</head>
	<body onLoad="inicio()">
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">VER / MODIFICAR PARTE DE TRABAJO </div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_parte.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="15%">C&oacute;digo Trabajador </td>
					      <td colspan="3"><input NAME="codtrabajador" type="text" class="cajaPequena" id="codtrabajador" size="6" maxlength="5" onClick="limpiarcaja()" value="<?php echo $codtrabajador; ?>">
					        <img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" title="Buscar trabajador" onMouseOver="style.cursor=cursor"> <img src="../img/cliente.svg" width="16" height="16" onClick="validartrabajador()" title="Validar trabajador" onMouseOver="style.cursor=cursor"></td>
						</tr>
<tr>
<td>Trabajador</td>
<td width="27%"><input NAME="nombre" type="text" class="cajaGrande" id="nombre" value="<?php echo $nombre; ?>" size="45" readonly></td>
<td width="3%">NIF</td>
<td width="64%"><input NAME="nif" type="text" class="cajaMedia" id="nif" value="<?php echo $nif; ?>" size="20" maxlength="15" readonly></td>
</tr>
<tr>
<td>C&oacute;digo Presupuesto</td>
<td><input NAME="codpresupuesto" type="text" class="cajaGrande" id="codpresupuesto" value="<?php echo $codpresupuesto; ?>" size="45" maxlength="45"></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Titulo Trabajo</td>
<td><input NAME="titulo" type="text" class="cajaGrande" id="titulo" value="<?php echo $titulo; ?>" size="45" maxlength="250"></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Descripci&oacute;n</td>
<td><textarea name="descripcion" cols="45" rows="5" class="cajaGrandeML" id="descripcion"><?php echo $descripcion; ?></textarea></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Horas previstas</td>
<td><input NAME="horasprevistas" type="text" class="cajaPequena" id="horasprevistas" value="<?php echo $horasprevistas; ?>" size="45" maxlength="45"></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Horas invertidas</td>
<td><input NAME="horasinvertidas" type="text" class="cajaPequena" id="horasinvertidas" value="<?php echo $horasinvertidas; ?>" size="45" maxlength="45"></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Precio / Hora</td>
<td><input NAME="preciohora" type="text" class="cajaPequena" id="preciohora" value="<?php echo $preciohora; ?>" size="45" maxlength="45">
(Separador decimal con . -punto-)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Fecha Comienzo</td>
<td><input NAME="fechacomienzo" type="text" class="cajaPequena" id="fechacomienzo" size="10" maxlength="10" value="<? echo implota($fechacomienzo); ?>" readonly>
<img src="../img/calendario.svg" alt="" name="ifechacomienzo" width="16" height="16" border="0" id="ifechacomienzo" onMouseOver="this.style.cursor='pointer'">
<script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechacomienzo",
					ifFormat   : "%d/%m/%Y",
					button     : "ifechacomienzo"
					  }
					);
		</script></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Fecha Lectura</td>
<td><input NAME="fechalectura" type="text" class="cajaPequena" id="fechalectura" size="10" maxlength="10" value="<? echo implota($fechalectura); ?>">
<img src="../img/calendario.svg" alt="" name="ifechalectura" width="16" height="16" border="0" id="ifechalectura" onMouseOver="this.style.cursor='pointer'">
<script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechalectura",
					ifFormat   : "%d/%m/%Y",
					button     : "ifechalectura"
					  }
					);
		</script></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Fecha Finalizaci&oacute;n</td>
<td><input NAME="fechafinalizacion" type="text" class="cajaPequena" id="fechafinalizacion" size="10" maxlength="10" value="<? echo implota($fechafinalizacion); ?>">
<img src="../img/calendario.svg" alt="" name="ifechafinalizacion" width="16" height="16" border="0" id="ifechafinalizacion" onMouseOver="this.style.cursor='pointer'">
<script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fechafinalizacion",
					ifFormat   : "%d/%m/%Y",
					button     : "ifechafinalizacion"
					  }
					);
		</script></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Estado</td>
<td><label>
<select name="estado" id="estado">
<?php

foreach ($estados_partestrabajo as $k => $v) {

?>
<option value="<?php echo $k; ?>" <?php if ( $estado == $k ) { echo "selected"; } ?>><?php echo $v; ?></option>
<?php } ?>
</select>
</label></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
						<? $hoy=date("d/m/Y"); ?>
						<tr>
						  <td>&nbsp;</td>
						  <td colspan="2">&nbsp;</td>
					  </tr>
					</table>
			  </div>
<input id="codtrabajo" name="codtrabajo" value="<? echo $codtrabajo?>" type="hidden">
			  <input id="accion" name="accion" value="modificar" type="hidden">
			  <br>
				<input name="codarticulo" value="<? echo $codarticulo?>" type="hidden" id="codarticulo">
				<br>
  <div align="center">
				   <button type="button" id="btnaceptar" onClick="validar_cabecera()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span>Aceptar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span>Cancelar</span> </button>
				    <input id="codfamilia" name="codfamilia" value="<? echo $codfamilia?>" type="hidden">
				    <input id="codalbarantmp" name="codalbarantmp" value="<? echo $codalbarantmp?>" type="hidden">
					<input id="modif" name="modif" value="0" type="hidden">
</div>
			  </form>
			 </div>
		  </div>
		</div>
	</body>
</html>
