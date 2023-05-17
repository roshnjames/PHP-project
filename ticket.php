<?php
session_start();
require('fpdf.php');
ini_set('display_errors', 'Off');

class PDF extends FPDF {

	function Header() {
		$this->Image('logo11.jpg',10,8,33);
		$this->SetFont('Arial','B',30);
		$this->Cell(40);
		$this->Cell(100,20,'TICKET',1,0,'C');
		$this->Ln(20);
	}

	function Footer() {
		$this->SetY(-15);
		$this->SetFont('Arial','B',10);
		$this->Cell(0,10,'Page ' .
			$this->PageNo() . '/{nb}',0,0,'C');
	}
}

$pdf = new PDF();
$bid=$_SESSION["bid"];
$email=$_SESSION["email"];
$pnrno=$_SESSION["pnr"];
$total=$_SESSION["amount"];
$package=$_SESSION["package"];
$count=$_SESSION["count"];
$jstart=$_SESSION["jstart"];
$jend=$_SESSION["jend"];
$tname=$_SESSION["tname"];

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',14);
$pdf->Ln(15);
$pdf->SetTextColor(1);

$width=$pdf->GetPageWidth(); 
$height=$pdf->GetPageHeight(); 
$gap=4; // Gap between line and border , change this value

$pdf->Line($gap, $gap,$width-$gap,$gap); 
$pdf->Line($gap, $height-$gap,$width-$gap,$height-$gap); 
$pdf->Line($gap, $gap,$gap,$height-$gap); 
$pdf->Line($width-$gap, $gap,$width-$gap,$height-$gap);

//$pdf->Cell(175, 10,0, 1,'C',true);
$pdf->Cell(175, 10, 'Booking Id : '.$bid,0, 1,'C');
$pdf->Cell(175, 10, 'Email-Id   : '.$email, 0, 1,'C');
$pdf->Cell(175, 10, 'PNR number : '.$pnrno, 0, 1,'C');
$pdf->Cell(175, 10, 'Train      : '.$tname, 0, 1,'C');
$pdf->Cell(175, 10, 'Departure  : '.$jstart, 0, 1,'C');
$pdf->Cell(175, 10, 'Destination: '.$jend, 0, 1,'C');
$pdf->Cell(175, 10, 'No. of passengers: '.$count, 0, 1,'C');
$pdf->Cell(175, 10, 'Package    : '.$package, 0, 1,'C');
$pdf->Cell(175, 10, 'Total amount: Rs.'.$total.'/-', 0, 1,'C');

$pdf->Image('logo12.jpg',30,180,150);
$pdf->Output();

?>
