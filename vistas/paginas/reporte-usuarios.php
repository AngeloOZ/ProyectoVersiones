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
		$this->Cell(70,10,'Reporte de Usuarios',0,0,'C');
		// Salto de línea
		$this->Ln(20);
		$this->Cell(50,10,utf8_decode("Código"), 1, 0, 'C', 0);
		$this->Cell(50,10,"Username", 1, 0, 'C', 0);
		$this->Cell(90,10,utf8_decode("Nombre"), 1, 1, 'C', 0);
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
$tabla = "usuario";
$respuesta = ModeloFormularios::mdlSelectionAllRegister($tabla);
if(!empty($respuesta)){
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	foreach($respuesta as $valor){
		$pdf->Cell(50,10,$valor["codigousuario"], 1, 0, 'C', 0);
		$pdf->Cell(50,10,$valor["nombre"], 1, 0, 'C', 0);
		$pdf->Cell(90,10,$valor["nombrereal"], 1, 1, 'C', 0);
	}
	$pdf->Output();
}