<?php 
require_once "reportesPDF/fpdf.php";
class PDF extends FPDF{
	function Header()
	{
		// Arial bold 15
		$this->SetFont('Arial','B',14);
		// Movernos a la derecha
		$this->Cell(60);
		// Título
		$this->Cell(70,10,'Reporte de Versiones',0,0,'C');
		// Salto de línea
		$this->Ln(20);
		$this->Cell(20,10,"ID", 1, 0, 'C', 0);
		$this->Cell(40,10,"Fecha", 1, 0, 'C', 0);
		$this->Cell(25,10,utf8_decode("Versión"), 1, 0, 'C', 0);
		$this->Cell(108,10,"Detlle", 1, 1, 'C', 0);
	}
	function Footer()
	{
		// Posición: a 1,5 cm del final
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Número de página
		$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
	}
}
$tabla = "versiones";
$respuesta = ModeloFormularios::mdlSelectionAllRegister($tabla);
if(!empty($respuesta)){
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	foreach($respuesta as $valor){
		$pdf->Cell(20,10,$valor["id"], 1, 0, 'C', 0);
		$pdf->Cell(40,10,$valor["fecha"], 1, 0, 'C', 0);
		$pdf->Cell(25,10,$valor["version"], 1, 0, 'C', 0);
		$pdf->Cell(108,10,$valor["detalle"], 1, 1, 'C', 0);
	}
	$pdf->Output();
}