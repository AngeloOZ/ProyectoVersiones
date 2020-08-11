<?php 
if(!isset($_SESSION["validarIngreso"])){
	header('location: login');
	return;
}else{
	if($_SESSION["validarIngreso"] != "ok"){
		header('location: login');
	}
}
require_once "reportesPDF/fpdf.php";
class PDF extends FPDF{
	function Header()
	{
		// Arial bold 15
		$this->SetFont('Arial','B',14);
		// Movernos a la derecha
		$this->Cell(60);
		// Título
		$this->Cell(70,10,'Reporte de Productos',0,0,'C');
		// Salto de línea
		$this->Ln(20);
		$this->Cell(30,10,utf8_decode("Código"), 1, 0, 'C', 0);
		$this->Cell(50,10,"Nombre", 1, 0, 'C', 0);
		$this->Cell(110,10,utf8_decode("Descripción"), 1, 1, 'C', 0);
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

$tabla = "productos";
$respuesta = ModeloFormularios::mdlSelectionAllRegister($tabla);
if(!empty($respuesta)){
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	foreach($respuesta as $valor){
		$pdf->Cell(30,10,utf8_decode($valor["codigoproducto"]), 1, 0, 'C', 0);
		$pdf->Cell(50,10,utf8_decode($valor["nombre"]), 1, 0, 'C', 0);
		$pdf->Cell(110,10,utf8_decode($valor["detalle"]), 1, 1, 'C', 0);
	}
	$pdf->Output();
}