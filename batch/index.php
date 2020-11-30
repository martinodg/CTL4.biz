<?
$id_resource='2';
$id_sresource='7';
require_once("../racf/purePhpVerify.php");
?>
<html>

<head>

    <title>Lotes</title>
    <link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="../funciones/paginar.js"></script>
    <script type="text/javascript" src="../../jquery/jquery331.js"></script>
	 
        
    <script language="javascript">
         
        //---------------------------------------------------------------------------------------------------           

        //this function setup pagination and reload 
        function paginar() {
            //alert(document.getElementById("paginas").value);
            document.getElementById("iniciopagina").value = document.getElementById("paginas").value;
            buscabatch();
        }
        //---------------------------------------------------------------------------------------------------         
        //modify proc function
        //---------------------------------------------------------------------------------------------------           
        //procs search fucnction
        function buscabatch() {
            $.get("buscarbatch.php", {
                    criterio1 : 'codstatus',
                    parametro1: document.getElementById('param1').value,
                    criterio2: document.getElementById('crit2').value,
                    parametro2: document.getElementById('param2').value,
                    criterio3: document.getElementById('crit3').value,
                    parametro3: document.getElementById('param3').value,
                    paginainicio: document.getElementById('iniciopagina').value
                },
                function(data) {
                    $('#div_datos').html(data);
                    calculaPaginacion();

                });
        }
        $(document).ready(function() {

            buscabatch();
            //filter for search   
            $('#param1, #param2').on("change", buscabatch);
                $('#param2, #param3').on("input", buscabatch);

            
            //when we press clean button
            $('#btnlimpiar').click(function() {
                document.getElementById("form_busqueda").reset();

            });
            //when we press new button
            $('#btnnuevo').click(function() {
                location.href = "nuevobatch.html";

            });
            //when we press print button
            $('#btnimprimir').click(function() {
                document.getElementById("form_busqueda").reset();

            });


        });

        function modificar(codlt) {
            /*  alert("el boton fuciona!y paso el parametro: " + codlt ); 
               location.href="modificarlote.php?codlote=&apos;"+codlt+"&apos;";*/

            location.href = "modificarbatch.html" + "#" + codlt;
        }




        var cursor;
        if (document.all) {
            // Está utilizando EXPLORER
            cursor = 'hand';
        } else {
            // Está utilizando MOZILLA/NETSCAPE
            cursor = 'pointer';
        }
    </script>
</head>

<body>
    <div id="pagina">
        <div id="zonaContenido">
            <div align="center">
                <div id="tituloForm" class="header">Busqueda de Batch </div>
                <div id="frmBusqueda">
                    <form id="form_busqueda" name="form_busqueda">
                        <table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
                            <tr>
                            <td width="25%">Estado </td>
						
                        <td id="entrada1" with="20%">
                      
                              <select id='param1' name='param1' class='comboMedio'>
                                <option value='' selected >Todos los estados</option>
                                <option value='0'>Inicializado</option>
                                <option value='1'>Finalizado</option>
                                <option value='2'>Descartado</option>
                            </select>
                         
                        </td>
                        <td width="5%">&nbsp;</td>
                        <td width="6%">&nbsp;</td>
                        
                            </tr>
                            <tr>
                                <td width="25%">Criterio de busqueda #2 </td>
                                <td>
                                    <select id="crit2" name="crit2" class="comboMedio">
                                    <option value="codarticulo">Articulo del lote</option>
                                    <option value="codlote">Codigo de lote</option>
                                    <option value="cantidad">Cantidad</option>
                                    <option value="fechai">Fecha de inicio</option>
                                    <option value="horai">Hora de inicio</option>
                                    <option value="fechaf">Fecha de finalizacion</option>
                                    <option value="horaf">Hora de finalizacion</option>
                                </select>
                                    <input id="param2" name="param2" type="text" class="cajaMediana" maxlength="45">
                                </td>
                                <td width="5%">&nbsp;</td>
                                <td width="5%">&nbsp;</td>
                                <td width="6%" align="right"></td>
                            </tr>
                            <tr>
                                <td width="25%">Criterio de busqueda #3 </td>
                                <td>
                                    <select id="crit3" name="crit3" class="comboMedio">
                                    <option value="cantidad">Cantidad</option>
                                    <option value="codarticulo">Articulo del lote</option>
                                    <option value="codlote">Codigo de lote</option>
                                    <option value="fechai">Fecha de inicio</option>
                                    <option value="horai">Hora de inicio</option>
                                    <option value="fechaf">Fecha de finalizacion</option>
                                    <option value="horaf">Hora de finalizacion</option>
                                </select>
                                    <input id="param3" name="param3" type="text" class="cajaMediana" maxlength="45" ">
                            </td>
							<td width="5% ">&nbsp;</td>
							<td width="5% ">&nbsp;</td>
							<td width="6% " align="right "></td>
						</tr>
						
						
					</table>
			  </div>
		 	  <div id="botonBusqueda">
                    <button type="button" id="btnlimpiar" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span>Limpiar</span> </button>
               		<button type="button" id="btnnuevo" onMouseOver="style.cursor=cursor"> <img src="../img/nuevo.svg" alt="nuevo" /> <span>Nuevo</span> </button>
               		<button type="button" id="btnimprimir" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span>Imprimir</span> </button>
              </div>
			  <div id="lineaResultado ">
			  <table class="fuente8 " width="100% " cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" align="left" class="paginar">N de lotes encontrados <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" align="right" class="paginar">Mostrados <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
			  </table>
                               <div ID="div_datos" name="div_datos" > </div> 
				</div>
				
				<input type="hidden" id="iniciopagina" name="iniciopagina" value="0 ">
				<input type="hidden" id="cadena_busqueda" name="cadena_busqueda">
			</form>
                       	
			
			</div>
		  </div>
		</div>
	</body>