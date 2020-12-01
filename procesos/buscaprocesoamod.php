<?php
require_once("../conectar7.php"); 


    $proceso=$_GET["proceso"];
    
    $consulta="SELECT articulos.referencia, procesos.cantidad, procesos.fechai, procesos.horai, procesos.codstatus, metaprocesos.codarticulo, unidadesmedidas.nombre FROM metaprocesos, procesos, articulos, unidadesmedidas WHERE procesos.codunidadmedida=unidadesmedidas.codunidadmedida AND procesos.codproceso ='".$proceso."' AND procesos.codstatus!=2 AND procesos.borrado=0 AND articulos.codarticulo=metaprocesos.codarticulo AND metaprocesos.codproceso=procesos.codmproceso;";
   //echo ",<script>alert($consulta);</script>";
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_procesos= mysqli_num_rows($rs_tabla);
                 while ($nr_procesos > 0) {
                            $row = mysqli_fetch_row($rs_tabla);
                                    $data['codproceso']= $proceso;
                                    $data['articulo']= $row[0];
                                    $data['cantidad']= $row[1];
                                    $data['unidadmedida']= '  '.$row[6];
                                    $data['fechai']= $row[2];
                                    $data['horai']= $row[3];
                                    $data['status']= $row[4];
                                    $data['codarticulo']= $row[5];
                                    echo json_encode($data);
                              
                        $nr_procesos--;
                        }
	
?>
