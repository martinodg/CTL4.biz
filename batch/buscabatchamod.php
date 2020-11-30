<?php
require_once("../conectar7.php"); 



    $batch=$_GET["batch"];
    
    $consulta="SELECT batch.codbatch, articulos.referencia, batch.cantidad, batch.fechai, batch.horai, batch.codstatus, batch.codarticulo FROM batch, articulos WHERE batch.codbatch =".$batch." AND batch.codarticulo=articulos.codarticulo AND batch.codstatus!=1 AND batch.borrado=0;";
        
  $rs_tabla = mysqli_query($conexion,$consulta);

	$nr_batchs= mysqli_num_rows($rs_tabla);
                 while ($nr_batchs > 0) {
                            $row = mysqli_fetch_row($rs_tabla);
                                    $data['codbatch']= $row[0];
                                    $data['articulo']= $row[1];
                                    $data['cantidad']= $row[2];
                                    $data['fechai']= $row[3];
                                    $data['horai']= $row[4];
                                    $data['status']= $row[5];
                                    $data['codarticulo']= $row[6];
                                    echo json_encode($data);
                              
                        $nr_batchs--;
                        }
	
?>
