<?php
session_start();
$language="spanish";
$Busqueda="Busqueda de procesos";
/*SQL to reset autoincrement on sql -> ALTER TABLE procesos AUTO_INCREMENT = 0; */
if ($language<>"spanish"){$Busqueda="Search for processes";}
?>
<html>
    <head>
	
	<title>procesos</title>
	<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
    <link href="../calendario/calendar-blue.css" rel="stylesheet" type="text/css">
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/lang/calendar-sp.js"></script>
		<script type="text/JavaScript" language="javascript" src="../calendario/calendar-setup.js"></script>
        <script type="text/javascript" src="../funciones/paginar.js"></script>
        <script type="text/javascript" src="../../jquery/jquery331.js"></script>
		<script type="text/javascript" src="/racf/verify.js"></script>
        
        <script language="javascript">
        verify('2','6');

       
           //---------------------------------------------------------------------------------------------------           
          
          //this function setup pagination and reload 
          function paginar(){
            //alert(document.getElementById("paginas").value);
            document.getElementById("iniciopagina").value=document.getElementById("paginas").value;
            buscaproceso();
          }
          //---------------------------------------------------------------------------------------------------           
          //procs search function
          function buscaproceso(){
                                    $.get( "buscarproceso.php" , { criterio1 : 'codstatus',
                                                                    parametro1 : document.getElementById('param1').value,
                                                                    criterio2 : document.getElementById('crit2').value,
                                                                    parametro2 : document.getElementById('param2').value,
                                                                    criterio3 : document.getElementById('crit3').value,
                                                                    parametro3 : document.getElementById('param3').value,
                                                                    paginainicio : document.getElementById('iniciopagina').value
                                                              },function ( data ) { 
                                                                                        $('#div_datos').html( data );
                                                                                        calculaPaginacion();
                                                                                  }
                                         );
                              }
          //---------------------------------------------------------------------------------------------------         
          //modify proc function
          function modificar(codproc) {
                                        location.href="modificarproceso.html" + "#" +codproc;
                                  }
          //---------------------------------------------------------------------------------------------------             
          //set mouse cursor for different browsers
          var cursor;
		  if (document.all) {
		                        // Está utilizando EXPLORER
		                        cursor='hand';
		                     } else {
		                                // Está utilizando MOZILLA/NETSCAPE
		                                cursor='pointer';
		                             }
          //---------------------------------------------------------------------------------------------------   
          //Perform when DOM is full loaded
          $( document ).ready(function(){
            
                //Load procs data
                buscaproceso();
                //---------------------------------------------------------------------------------------------------   
                //Add or remove calendar for cirt1
                $('#crit2, #crit3').change(function(){
                    var seleccion=$(this).val();
                    var campo="param"+$(this).attr('name');
                    var agregar="#entrada"+$(this).attr('name');
                    var calend="calendario"+$(this).attr('name');
                    var calendid="#calendario"+$(this).attr('name');
                    if (seleccion == "fechai" || seleccion == "fechaf") {
                                                                         if ($(calendid).length == 0) {
                                                                                                            //Add it to the dom
                                                                                                            $(agregar).append("\
                                                                                                            <img src='../img/calendario.svg' name='"+calend+"' width='16' height='16' border='0' id='"+calend+"' onMouseOver='this.style.cursor=&apos;pointer&apos;'>");
                                                                                                            Calendar.setup(
					                                                                                                        {
					                                                                                                            inputField : campo,
					                                                                                                            ifFormat   : "%Y-%m-%d",
                                                                                                                                button     : calend,
                                                                                                                                onUpdate    : function() {
                                                                                                                                                         buscaproceso();
                                                                                                                                                        
                                                                                                                                                        }       
					                                                                                                        }
                                                                                                                           )
                                                                                                            ;
                                                                                                            }
                                                                        }else{
                                                                                $(calendid).detach();
                                                                                $('#'+campo).val('');
                                                                                buscaproceso();
                                                                        }
                                             }
                                            )
                ;
                //---------------------------------------------------------------------------------------------------
                //filter for procs search   
                $('#param1, #param2').on("change", buscaproceso);
                $('#param2, #param3').on("input", buscaproceso);
                
                //---------------------------------------------------------------------------------------------------
                //when we press clean button
                $('#btnlimpiar').click(function(){
                                                    document.getElementById("form_busqueda").reset();
                                                 }
                                      )
                ;
                //---------------------------------------------------------------------------------------------------
                //when we press new button
                $('#btnnuevo').click(function(){
                                                    location.href="nuevoproceso.html";
                                                }
                                    )
                ;
                //---------------------------------------------------------------------------------------------------
                //when we press print button
                $('#btnimprimir').click(function(){
                                                        document.getElementById("form_busqueda").reset();
                                                  }
                                        )
                ;
               
             
            });
            //-----------------------------END Perform when DOM is full loaded----------------------------------------------------------------------
            //---------------------------------------------------------------------------------------------------
          
	 </script>
    </head>
	<body>
    <?php
    if($_SESSION["id"]) {
    ?>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header"><?echo $Busqueda;?> </div>
				<div id="frmBusqueda">
				<form id="form_busqueda" name="form_busqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="20%">Estado </td>
						
                            <td id="entrada1" with="20%">
                          
                                  <select id='param1' name='param1' class='comboMedio'>
                                    <option value='' selected >Todos los estados</option>
                                    <option value='1'>Inicializado</option>
                                    <option value='2'>Finalizado</option>
                                    <option value='3'>Descartado</option>
                                </select>
                             
                            </td>
                            <td width="20%">&nbsp;</td>
							<td width="40%">&nbsp;</td>
							
						</tr>
<tr>
							<td width="20%">Criterio de busqueda #2 </td>
							<td width="20%"> 
                                <select id="crit2" name="2" class="comboMedio" >
                                    <option value="nombre">Nombre del Proceso</option>
                                    <option value="codproceso">Codigo de proceso</option>
                                    <option value="fechai">Fecha de inicio</option>
                                    <option value="horai">Hora de inicio</option>
                                    <option value="fechaf">Fecha de finalizacion</option>
                                    <option value="horaf">Hora de finalizacion</option>
                                    <option value="codestacion">Estacion de Trabajo</option>
                                    <option value="codtrabajador">Nombre del empleado</option>


                                </select>
                            </td>
                            <td id="entrada2" with="20%">
                           <input id="param2" name="param2" type="text" class="cajaMediana datepicker" maxlength="45" >
        
                            </td>
							<td width="40%">&nbsp;</td>
						</tr>
<tr>
							<td width="20%">Criterio de busqueda #3 </td>
							<td width="20%"> 
                                <select id="crit3" name="3" class="comboMedio" >
                                    <option value="codproceso">Codigo de proceso</option>
                                    <option value="codarticulo">Articulo del proceso</option>
                                    <option value="cantidad">Cantidad</option>
                                    <option value="fechai">Fecha de inicio</option>
                                    <option value="horai">Hora de inicio</option>
                                    <option value="fechaf">Fecha de finalizacion</option>
                                    <option value="horaf">Hora de finalizacion</option>
                                </select>
                            </td>
                            <td id="entrada3" with="20%">
                           <input id="param3" name="param3" type="text" class="cajaMediana" maxlength="45" ">
                            </td>
							<td width="40%">&nbsp;</td>
						</tr>
						
						
					</table>
			  </div>
		 	  <div id="botonBusqueda">
               <button type="button" id="btnlimpiar" onMouseOver="style.cursor=cursor"> <img src="../img/limpiar.svg" alt="limpiar" /> <span>Limpiar</span> </button>
               <button type="button" id="btnnuevo" onMouseOver="style.cursor=cursor"> <img src="../img/nuevo.svg" alt="nuevo" /> <span>Nuevo</span> </button>
               <button type="button" id="btnimprimir" onMouseOver="style.cursor=cursor"> <img src="../img/printer.svg" alt="Imprimir" /> <span>Imprimir</span> </button>

               </div>
			  <div id="lineaResultado">
			  <table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0>
			  	<tr>
				<td width="50%" class="paginar" align="left">N de procesos encontrados <input id="filas" type="text" class="cajaPequena" NAME="filas" maxlength="5" readonly></td>
				<td width="50%" class="paginar" align="right">Mostrados <select name="paginas" id="paginas" onChange="paginar()">
		          </select></td>
                </tr>
			  </table>
                               <div ID="div_datos" name="div_datos" > </div> 
				</div>
				
				<input type="hidden" id="iniciopagina" name="iniciopagina" value="0">
				<input type="hidden" id="cadena_busqueda" name="cadena_busqueda">
			</form>
                       	
			
			</div>
		  </div>
        </div>
        <?php
    }else{
       ?> <script>
                    parent.changeURL('../login/logout.php');
            </script>
    <?      
    } 
    ?>
	</body>

