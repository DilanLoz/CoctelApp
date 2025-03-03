<?php
require_once '../models/mfacturapdf.php';
require_once '../fpdf/fpdf.php';

if (!isset($_GET['idfact'])) {
    die('ID de factura no proporcionado.');
}

$idfact = $_GET['idfact'];
$facturaModel = new Factura();
$datos = $facturaModel->getFacturaDetalle($idfact);

if (!$datos) {
    die('No se encontró la factura.');
}

// 🔹 Limpiar salida previa
ob_end_clean();
header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename=factura.pdf");

class PDF extends FPDF {
    function Header() {
        
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(255, 87, 51); // Naranja
$pdf->Cell(190, 10, mb_convert_encoding('Factura #'.$datos[0]['idfact'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
$pdf->Ln(5);

// 🔹 Datos Generales
$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0);
$pdf->Cell(95, 10, mb_convert_encoding("Cliente: ".$datos[0]['usuario'], 'ISO-8859-1', 'UTF-8'), 0, 0);
$pdf->Cell(95, 10, mb_convert_encoding("Empleado: ".$datos[0]['empleado'], 'ISO-8859-1', 'UTF-8'), 0, 1);
$pdf->Cell(95, 10, mb_convert_encoding("Bar: ".$datos[0]['bar'], 'ISO-8859-1', 'UTF-8'), 0, 1);
$pdf->Cell(95, 10, mb_convert_encoding("Fecha: ".$datos[0]['fecha'], 'ISO-8859-1', 'UTF-8'), 0, 0);
$pdf->Cell(95, 10, mb_convert_encoding("Método de Pago: ".$datos[0]['metodo_pago'], 'ISO-8859-1', 'UTF-8'), 0, 1);
$pdf->Ln(5);

// 🔹 Tabla de Detalle
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(255, 87, 51);
$pdf->SetTextColor(255);
$pdf->Cell(70, 10, mb_convert_encoding('Producto', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Precio', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Total', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 12);
$pdf->SetTextColor(0);
$pdf->SetFillColor(240, 240, 240);
$fill = false;

foreach ($datos as $item) {
    $pdf->Cell(70, 10, mb_convert_encoding($item['nomprod'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', $fill);
    $pdf->Cell(30, 10, $item['cantidad'], 1, 0, 'C', $fill);
    $pdf->Cell(40, 10, "$".number_format($item['precio_unitario'], 2, ',', '.'), 1, 0, 'C', $fill);
    $pdf->Cell(40, 10, "$".number_format($item['total_detalle'], 2, ',', '.'), 1, 1, 'C', $fill);
    $fill = !$fill;
}

// 🔹 Total General
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(255, 87, 51);
$pdf->SetTextColor(255);
$pdf->Cell(140, 10, 'Total General:', 1, 0, 'R', true);
$pdf->SetTextColor(0);
$pdf->Cell(40, 10, "$".number_format($datos[0]['total'], 2, ',', '.'), 1, 1, 'C', true);

// 🔹 Generar PDF
$pdf->Output();
exit;
?>
