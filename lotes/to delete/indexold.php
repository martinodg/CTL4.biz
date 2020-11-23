<?php
include ("../conectar7.php");

$cadena_busqueda=$_GET["cadena_busqueda"];

if (!isset($cadena_busqueda)) { $cadena_busqueda=""; } else { $cadena_busqueda=str_replace("",",",$cadena_busqueda); }

if ($cadena_busqueda<>"") {
	$array_cadena_busqueda=split("~",$cadena_busqueda);
	$codtrabajador=$array_cadena_busqueda[1];
	$nombre=$array_cadena_busqueda[2];
	$nif=$array_cadena_busqueda[3];
} else {
	$codtrabajador="";
	$nombre="";
	$nif="";
	$provincia="";
	$localidad="";
	$telefono="";
}

?>
<html>
	<head>
		<title>Lotes</title>
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

		function inicio() {
			document.getElementById("form_busqueda").submit();
		}

		function nuevo_trabajador() {
			location.href="nuevo_trabajador.php";
		}

		function imprimir() {
			var codtrabajador=document.getElementById("codtrabajador").value;
			var nombre=document.getElementById("nombre").value;
			var nif=document.getElementById("nif").value;
			var provincia=document.getElementById("cboProvincias").value;
			var localidad=document.getElementById("localidad").value;
			var telefono=document.getElementById("telefono").value;
			window.open("../fpdf/trabajadores.php?codtrabajador="+codtrabajador+"&nombre="+nombre+"&nif="+nif+"&provincia="+provincia+"&localidad="+localidad+"&telefono="+telefono);
		}

		function buscar() {
			var cadena;
			cadena=hacer_cadena_busqueda();
			document.getElementById("cadena_busqueda").value=cadena;
			if (document.getElementById("iniciopagina").value=="") {
				document.getElementById("iniciopagina").value=1;
			} else {
				document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			}
			document.getElementById("form_busqueda").submit();
		}

		function paginar() {
			document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
			document.getElementById("form_busqueda").submit();
		}

		function hacer_cadena_busqueda() {
			var codtrabajador=document.getElementById("codtrabajador").value;
			var nombre=document.getElementById("nombre").value;
			var nif=document.getElementById("nif").value;
			var cadena="";
			cadena="~"+codtrabajador+"~"+nombre+"~"+nif+"~";
			return cadena;
			}

		function limpiar() {
			document.getElementById("form_busqueda").reset();
		}

		function abreVentana(){
			miPopup = window.open("ventanalote.php","miwin","width=700,height=380,scrollbars=yes");
			miPopup.focus();
		}

		function validar1(){
			var criterio1=document.getElementById("criterio1").value;
            var parametro1=document.getElementById("parametro1").value;
            var criterio2=document.getElementById("criterio2").value;
            var parametro2=document.getElementById("parametro2").value;
            var criterio3=document.getElementById("criterio3").value;
            var parametro3=document.getElementById("parametro3").value;
            miPopup = window.open("comprobarlote.php?criterio1="+criterio1+"&parametro1="+parametro1+"&criterio2="+criterio2+"&parametro2="+parametro2+"&criterio3="+criterio3+"&parametro3="+parametro3,"frame_datos","width=700,height=80,scrollbars=yes");
		}

		</script>
	</head>
	<body onLoad="inicio()">
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">Buscar Lote </div>
				<div id="frmBusqueda">
				<form id="form_busqueda" name="form_busqueda" method="post" action="rejilla.php" target="frame_rejilla">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="25%">Criterio de busqueda #1 </td>
							<td> 
                                <select id="criterio1" name="criterio1" class="comboMedio" >
                                    <option value="codlote">Codigo de Lote</option>
                                    <option value="codarticulo">Articulo del lote</option>
                                    <option value="cantidad">Cantidad</option>
                                    <option value="fechai">Fecha de inicio</option>
                                    <option value="horai">Hora de inicio</option>
                                    <option value="fechaf">Fecha de finalizacion</option>
                                    <option value="horaf">Hora de finalizacion</option>
                                </select>
                           <input id="parametro1" name="parametro1" type="text" class="cajaMediana" maxlength="45" value="<? echo $parametro1?>">
                                <img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" title="Buscar" onMouseOver="style.cursor=cursor"> <img src="../img/validacion.svg" width="20" height="20" onClick="validar1()" title="Validar" onMouseOver="style.cursor=cursor">
                            </td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
<tr>
							<td width="25%">Criterio de busqueda #2 </td>
							<td> 
                                <select id="criterio2" name="criterio2" class="comboMedio" >
                                    <option value="codarticulo">Articulo del lote</option>
                                    <option value="codlote">Codigo de lote</option>
                                    <option value="cantidad">Cantidad</option>
                                    <option value="fechai">Fecha de inicio</option>
                                    <option value="horai">Hora de inicio</option>
                                    <option value="fechaf">Fecha de finalizacion</option>
                                    <option value="horaf">Hora de finalizacion</option>
                                </select>
                           <input id="parametro2" name="parametro2" type="text" class="cajaMediana" maxlength="45" value="<? echo $parametro2?>">
                                <img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" title="Buscar" onMouseOver="style.cursor=cursor"> <img src="../img/validacion.svg" width="20" height="20" onClick="validar1()" title="Validar" onMouseOver="style.cursor=cursor">
                            </td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
<tr>
							<td width="25%">Criterio de busqueda #3 </td>
							<td> 
                                <select id="criterio3" name="criterio3" class="comboMedio" >
                                    <option value="cantidad">Cantidad</option>
                                    <option value="codarticulo">Articulo del lote</option>
                                    <option value="codlote">Codigo de lote</option>
                                    <option value="fechai">Fecha de inicio</option>
                                    <option value="horai">Hora de inicio</option>
                                    <option value="fechaf">Fecha de finalizacion</option>
                                    <option value="horaf">Hora de finalizacion</option>
                                </select>
                           <input id="parametro3" name="parametro3" type="text" class="cajaMediana" maxlength="45" value="<? echo $parametro3?>">
                                <img src="../img/ver.svg" width="16" height="16" onClick="abreVentana()" title="Buscar" onMouseOver="style.cursor=cursor"> <img src="../img/validacion.svg" width="20" height="20" onClick="validar1()" title="Validar" onMouseOver="style.cursor=cursor">
                            </td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%" align="right"></td>
						</tr>
						
						
					</table>
			  </div>
		 	  <div id="botonBusqueda">                    <button type="button" id="btnbuscar" onClick="buscar()"  onMouseOver="style.cursor=cursor"> <img src="../img/ver.svg" alt="buscar" /> <span>Buscar</span> </button>

			 	  <button type="button" id="btnlimpiar"  onClick="limpiar()" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span>Limpiar</span> </button>


					 <button type="button" id="btnnuevo" onClick="nuevo_trabajador()" onMouseOver="style.cursor=cursor"> <img src="../img/nuevo.svg" alt="nuevo" /> <span>Nuevo</span> </button>
					<button type="button" id="btnimprimir"  onClick="imprimir()" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span>Imprimir</span> </button>


</div>
			  <div id="lineaResultado">
			  <table class="fuente8" width="80%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" class="paginar" align="left">N de trabajadores encontrados <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" class="paginar" align="right">Mostrados <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
				</div>
				<div id="cabeceraResultado" class="header">
					relacion de TRABAJADORES </div>
				<div id="frmResultado">
				<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">
						<tr class="cabeceraTabla">
							<td width="8%">ITEM</td>
							<td width="6%">CODIGO</td>
							<td width="38%">NOMBRE </td>
							<td width="13%">NIF/CIF</td>
							<td width="19%">TELEFONO</td>
							<td width="5%">&nbsp;</td>
							<td width="5%">&nbsp;</td>
							<td width="6%">&nbsp;</td>
						</tr>
				</table>
				</div>
				<input type="hidden" id="iniciopagina" name="iniciopagina">
				<input type="hidden" id="cadena_busqueda" name="cadena_busqueda">
			</form>
				<div id="lineaResultado">
					<iframe width="100%" height="250" id="frame_rejilla" name="frame_rejilla" frameborder="0">
						<ilayer width="100%" height="300" id="frame_rejilla" name="frame_rejilla"></ilayer>
					</iframe>
					<iframe id="frame_datos" name="frame_datos" width="0" height="0" frameborder="0">
					<ilayer width="0" height="0" id="frame_datos" name="frame_datos"></ilayer>
					</iframe>
				</div>
			</div>
		  </div>
		</div>
	</body>
</html>
