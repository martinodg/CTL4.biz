<?php
<?php
ob_start();
define('FPDF_FONTPATH','font/');
require ('mysqli_table.php');
require_once("../conectar7.php");  require_once("../mysqli_result.php"); require_once("comunes.php");
$pdf=new PDF();
$pdf->AddPage();
$pdf->AddPage();

//Nombre del Listado
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('Arial','B',16);
$pdf->SetY(40);
$pdf->SetX(0);
$pdf->MultiCell(290,6,"Listado de Entidades Bancarias",0,'C',0);

$pdf->Ln();    
	
//Restauracin de colores y fuentes

    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('Arial','B',7);


//Buscamos y listamos las familias

$nombreentidad=$_POST["nombreentidad"];
$codentidad=$_POST["codentidad"];

$where="1=1";
if ($codentidad <> "") { $where.=" AND codentidad='$codentidad'"; }
if ($nombreentidad <> "") { $where.=" AND nombreentidad like '%".$nombreentidad."%'"; }


//Ttulos de las columnas
$header=array('Cod. Entidad','Nombre');

//Colores, ancho de lnea y fuente en negrita
$pdf->SetFillColor(200,200,200);
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0,0,0);
$pdf->SetLineWidth(.2);
$pdf->SetFont('Arial','B',8);
	
//Cabecera
$pdf->SetX(60);
$w=array(20,60);
for($i=0;$i<count($header);$i++)
	$pdf->Cell($w[$i],7,$header[$i],1,0,'C',1);
$pdf->Ln();
$pdf->SetFont('Arial','',8);
$sel_resultado="SELECT * FROM entidades WHERE borrado=0 AND ".$where;
$res_resultado=mysqli_query($conexion,$sel_resultado);
$contador=0;
while ($contador < mysqli_num_rows($res_resultado)) {
	$pdf->SetX(60);
	$pdf->Cell($w[0],5,mysqli_result($res_resultado,$contador,"codentidad"),'LRTB',0,'C');
	$pdf->Cell($w[1],5,mysqli_result($res_resultado,$contador,"nombreentidad"),'LRTB',0,'C');
	$pdf->Ln();
	$contador++;
};
			
$pdf->Output();
ob_end_flush(); 
?> 
