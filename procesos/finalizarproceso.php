<?php
require_once("../conectar7.php"); 
require_once("../mysqli_result.php"); 

$codproceso=$_GET["codproceso"];
$codmproceso=$_GET["codmproceso"];
$cantproceso=$_GET["cantproceso"];
$umcantfinal=$_GET["umcantfinal"];

//echo '<script>alert("'.$umcantfinal.'");</script>';

//verify if process validation match with metaprocesline
//verify lines numbers on proclinea
$query_verificanlineas_proclinea="SELECT proclinea.codarticulo, proclinea.cantidad, metaprocesos.codarticulo as articulo_mproc FROM proclinea, metaprocesos WHERE proclinea.codproceso = '$codproceso' AND metaprocesos.codproceso='$codmproceso' ;";
//echo $query_verificanlineas_proclinea;
$rs_verificanlineas_proclinea=mysqli_query($conexion,$query_verificanlineas_proclinea);
$nlineas_proclinea= mysqli_num_rows($rs_verificanlineas_proclinea);

//echo $nlineas_proclinea;

//verify lines numbers on metaprocess
$query_verificanlineas_metaprocesoslinea="SELECT COUNT(1) as totalm FROM metaprocesoslinea WHERE codproceso = '$codmproceso';";
$rs_verificanlineas_metaprocesoslinea=mysqli_query($conexion,$query_verificanlineas_metaprocesoslinea);
$lineasmeta=mysqli_fetch_assoc($rs_verificanlineas_metaprocesoslinea);
$nlineas_metaprocesoslinea=$lineasmeta['totalm'];   
//echo $nlineas_metaprocesoslinea;

//compare line numbers between procline and metaprocessline and decide if end could be accomplish or not
if ($nlineas_metaprocesoslinea==$nlineas_proclinea && $cantproceso>'0'){
    //if the number of lines match
    $fechafin= date('Y/m/d');
    $horafin= date('H:i:s');
    $query_finalizar="UPDATE procesos SET cantidad='$cantproceso', codunidadmedida='$umcantfinal', horaf='$horafin', fechaf='$fechafin', codstatus='2' WHERE codproceso='$codproceso'";
    $rs_finalizar=mysqli_query($conexion,$query_finalizar);

    echo '<div class="mensaje"><span>El proceso ha sido finalizado con data:'.$fechafin.' y hora:'.$horafin.'. Por una cantidad de:'.$cantproceso.'.</span></div> ';
    while ($nlineas_proclinea > 0) {
        $row = mysqli_fetch_row($rs_verificanlineas_proclinea);
        $query_restarinsumosstock="UPDATE articulos SET stock=(stock - '$row[1]') WHERE codarticulo='$row[0]';";
        $rs_restarinsumosstock=mysqli_query($conexion,$query_restarinsumosstock);
        $nlineas_proclinea--;
    }
    //add item just produced as the result of the current process to the stock
    $query_sumarresultadostock="UPDATE articulos SET stock=(stock + '$cantproceso') WHERE codarticulo='$row[2]';";
    $rs_sumarresultadostock=mysqli_query($conexion,$query_sumarresultadostock);

    mysqli_close($conexion);   
        
 

}else{
    //if the number of lines don't mach
    echo '<div class="mensaje"><span>La finalizacion no ha podido ser realizada!!!!</span><br></div>';
    echo '<div class="mensaje"><span>Todos los articulos deben ser validados antes de finalizar el proceso.</span><br></div>';
    echo '<div class="mensaje"><span>Y la cantidad total del resultado del proceso debe ser ingresada.</span><br></div>';
    
}
?> 
