<?php
require_once("../conectar7.php"); 


    $mproceso=$_GET["mproceso"];
    
    $consulta="SELECT metaprocesos.codproceso, metaprocesos.nombre, metaprocesos.esbatch, metaprocesos.codstatus, articulos.referencia, metaprocesos.cantidad, metaprocesos.codunidadmedida FROM metaprocesos, articulos WHERE metaprocesos.codarticulo = articulos.codarticulo AND metaprocesos.codproceso =".$mproceso.";";
    /*echo $consulta;*/
        
	$rs_tabla = mysqli_query($conexion,$consulta);
	$nr_procesos= mysqli_num_rows($rs_tabla);
                 while ($nr_procesos > 0) {
                            $row = mysqli_fetch_row($rs_tabla);
                                    $data['codproceso']= $row[0];
                                    $data['nombre']= $row[1];
                                    $data['esbatch']= $row[2];
                                    $data['codstatus']= $row[3];
                                    $data['nombrearticulo']= $row[4];
                                    $data['cantidadestimada']= $row[5];
                                    $data['codunidadmedida']= $row[6];
                                    echo json_encode($data);
                              
                        $nr_procesos--;
                        }
	
?>
