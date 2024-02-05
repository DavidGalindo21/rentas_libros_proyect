<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo ubicación de la imagen, izquierda(x), arriba(y) y tamaño
    $this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha, margen donde inicia el título
    $this->Cell(40);
    // Título
    $this->Cell(90,10,'REPORTE PDF',0,1,'C');
    $this->Cell(40);
    $this->Cell(90,10,'REPORTE DE RENTAS GENERADAS',0,0,'C');
    // Fecha
    $this->Cell(25);
    $this->SetFont('Arial','',10);
    $this->Cell(25,10,'Fecha: '.date("d/m/Y"),0,1,'C');

    // Salto de línea
    $this->Ln(30);
    $this->SetFont('Arial','B',12);
    //ancho, largo, contenido, borde, salto de línea, alineación, relleno
    $this->Cell(9,6,'No.',1,0,'c',0);
    $this->Cell(22,6,'Fecha',1,0,'c',0);
    $this->Cell(17,6,'Monto',1,0,'c',0);
    $this->Cell(19,6,'Anticipo',1,0,'c',0);
    $this->Cell(18,6,'Pago',1,0,'c',0);
    $this->Cell(18,6,'Saldo',1,0,'c',0);
    $this->Cell(18,6,'Estado',1,0,'c',0);
    //utf8_decode para los acentos
    $this->Cell(42,6,utf8_decode('Título del libro   '),1,1,'c',0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(60,10,'Sistema de reservas ',0,0,'C',0);
    $this->Cell(55,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

include('../Conexion.php');
$db = new Database();
$query = $db->connect()->prepare('select * FROM rentas order by ID asc');
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute();

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
//por default los margins son de 10
$pdf->SetMargins(20,20,20);
$pdf->AddPage();
//para generar el salto a la siguiente página
$pdf->SetAutoPageBreak(true,20);
$pdf->SetFont('Times','',12);
$pdf->SetFillColor(233,229,235);
$pdf->SetDrawColor(61,61,61);
while ($row = $query->fetch()){
  $pdf->Cell(9,6,$row['ID'],1,0,'c',1);
  $pdf->Cell(22,6,$row['FECHA_RENTA'],1,0,'c',0);
  $pdf->Cell(17,6,$row['MONTO'],1,0,'c',0);
  $pdf->Cell(19,6,$row['ANTICIPO'],1,0,'c',0);
  $pdf->Cell(18,6,$row['PAGO'],1,0,'c',0);
  $pdf->Cell(18,6,$row['SALDO_PENDIENTE'],1,0,'c',0);
  $pdf->Cell(18,6,$row['ESTADO_RENTA'],1,0,'c',0);
  $pdf->Cell(42,6,$row['TITULO_LIBRO'],1,1,'c',0);
}
$pdf->Output();

?>