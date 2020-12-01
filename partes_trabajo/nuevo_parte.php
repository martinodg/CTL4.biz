<?php
require_once("../conectar.php");

$fechahoy=date("Y-m-d");
#$sel_albaran="INSERT INTO albaranestmp (codalbaran,fecha) VALUE ('','$fechahoy')";
#$rs_albaran=mysqli_query($conexion,$sel_albaran);
#$codalbarantmp=mysqli_insert_id($conexion);
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

		function ventanaArticulos(){
			var codigo=document.getElementById("codcliente").value;
			if (codigo=="") {
				alert ("Debe introducir el codigo del cliente");
			} else {
				miPopup = window.open("ver_articulos.php","miwin","width=700,height=500,scrollbars=yes");
				miPopup.focus();
			}
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
				if (document.getElementById("fecha").value=="") mensaje+="  - Fecha\n";
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

				if (document.getElementById("codarticulo").value=="") mensaje="  - Referencia\n";
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
				<div id="tituloForm" class="header">CREAR PARTE DE TRABAJO</div>
				<div id="frmBusqueda">
				<form id="formulario" name="formulario" method="post" action="guardar_parte.php">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="15%">C&oacute;digo Trabajador </td>
					      <td colspan="3"><input NAME="codtrabajador" type="text" class="cajaPequena" id="codtrabajador" size="6" maxlength="5" onClick="limpiarcaja()">
					        <img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" title="Buscar trabajador" onMouseOver="style.cursor=cursor"> <img src="../img/cliente.svg" width="16" height="16" onClick="validarcliente()" title="Validar cliente" onMouseOver="style.cursor=cursor"></td>
						</tr>
						<tr>
							<td width="15%">Nombre</td>
						    <td width="27%"><input NAME="nombre" type="text" class="cajaGrande" id="nombre" size="45" readonly></td>
				            <td width="3%">NIF</td>
				            <td width="64%"><input NAME="nif" type="text" class="cajaMedia" id="nif" size="20" maxlength="15" readonly></td>
						</tr>
						<? $hoy=date("d/m/Y"); ?>
						<tr>
							<td width="15%">C&oacute;digo Presupuesto</td>
						    <td width="27%"><input NAME="codpresupuesto" type="text" class="cajaGrande" id="codpresupuesto" size="45" maxlength="45"></td>
				            <td width="3%">&nbsp;</td>
				            <td width="64%">&nbsp;</td>
						</tr>
<tr>
<td>Titulo Trabajo</td>
<td><input NAME="titulo" type="text" class="cajaGrande" id="titulo" size="45" maxlength="250"></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Descripci&oacute;n</td>
<td><textarea name="descripcion" cols="45" rows="5" class="cajaGrandeML" id="descripcion"></textarea></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Horas previstas</td>
<td><input NAME="horasprevistas" type="text" class="cajaPequena" id="horasprevistas" size="45" maxlength="45"></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Precio / Hora</td>
<td><input NAME="preciohora" type="text" class="cajaPequena" id="preciohora" size="45" maxlength="45">
(Separador decimal con . -punto-)</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Fecha Comienzo</td>
<td><input NAME="fecha" type="text" class="cajaPequena" id="fecha" size="10" maxlength="10" value="<? echo $hoy?>" readonly>
<img src="../img/calendario.svg" alt="" name="Image1" width="16" height="16" border="0" id="Image1" onMouseOver="this.style.cursor='pointer'">
<script type="text/javascript">
					Calendar.setup(
					  {
					inputField : "fecha",
					ifFormat   : "%d/%m/%Y",
					button     : "Image1"
					  }
					);
		</script></td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
					</table>
			  </div>
			  <input id="codalbarantmp" name="codalbarantmp" value="<? echo $codalbarantmp?>" type="hidden">
			  <input id="baseimpuestos2" name="baseimpuestos" value="<? echo $baseimpuestos?>" type="hidden">
			  <input id="baseimponible2" name="baseimponible" value="<? echo $baseimponible?>" type="hidden">
			  <input id="preciototal2" name="preciototal" value="<? echo $preciototal?>" type="hidden">
			  <input id="accion" name="accion" value="alta" type="hidden">
			  </form>
			  <br>

				<form id="formulario_lineas" name="formulario_lineas" method="post" action="frame_lineas.php" target="frame_lineas">

				<input name="codarticulo" value="<? echo $codarticulo?>" type="hidden" id="codarticulo">
  <div align="center">
				    <button type="button" id="btnaceptar" onClick="validar_cabecera()" onMouseOver="style.cursor=cursor"> <img src="../img/ok.svg" alt="aceptar" /> <span>Aceptar</span> </button>
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span>Cancelar</span> </button>
				    <input id="codfamilia" name="codfamilia" value="<? echo $codfamilia?>" type="hidden">
				    <input id="codalbarantmp" name="codalbarantmp" value="<? echo $codalbarantmp?>" type="hidden">
</div>
			  </form>
			 </div>
		  </div>
		</div>
	</body>
</html>
