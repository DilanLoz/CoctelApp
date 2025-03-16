<?php
require_once '../../models/mfacturapdf.php';
require_once '../tcpdf/tcpdf.php';
session_start();

if (!isset($_SESSION['idusu'])) {
    die('Error: No hay usuario en sesión.');
}

date_default_timezone_set('America/Bogota');

// FORZAR EL USO DEL ESPAÑOL
setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain', 'es_ES', 'esp');

// FECHA DE IMPRESIÓN Y NOMBRE DEL MES EN ESPAÑOL
$fecha_generacion = strftime('%d de %B de %Y, %H:%M:%S');
$fecha_generacion = utf8_encode($fecha_generacion); // Asegurar caracteres especiales
$fecha_archivo = date('Y-m-d_H-i-s');
$nombre_mes = strftime('%B %Y');
$nombre_mes = utf8_encode($nombre_mes); // Convertir caracteres especiales

$idusu = $_SESSION['idusu'];
$nombreUsu = $_SESSION['nomusu'];
$numdocuUsu = $_SESSION['numdocu'];

$facturaModel = new Factura();
$facturas = $facturaModel->getFacturasActivasPagadasMesActualBar($idusu);

if (!$facturas) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetY(150);
    $pdf->SetFont('dejavusans', 'B', 14);
    $pdf->Cell(190, -240, "No hay facturas para este mes.", 0, 1, 'C');
    $pdf->Output();
    exit;
}

$nombreArchivo = "facturas_{$idusu}_{$fecha_archivo}.pdf";

class PDF extends TCPDF {
    public $fecha_impresion; // Variable para almacenar la fecha

    public function Header() {
        $this->SetY(15);
        $this->SetFont('dejavusans', 'B', 14);
        $this->Cell(190, 10, 'CoctelApp - Facturación', 0, 1, 'C');
        $this->Ln(5);
    }
    
    public function Footer() {
        $this->SetY(-20);
        $this->SetFont('dejavusans', 'I', 10);
        $this->Cell(0, 10, 'Factura Generada Por CoctelApp', 0, 1, 'C');
        $this->Cell(0, 10, 'Fecha de impresión: ' . $this->fecha_impresion, 0, 0, 'C'); // Agregando la fecha
    }
}

$pdf = new PDF();
$pdf->fecha_impresion = $fecha_generacion; // Pasar la fecha a la clase PDF
$pdf->SetAutoPageBreak(TRUE, 20);
$pdf->SetMargins(10, 30, 10);
$pdf->AddPage();

// Título con el mes y año en español
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->Cell(190, 10, "Facturas de $nombre_mes", 0, 1, 'C');
$pdf->Ln(5);

// Tabla con información del usuario
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(95, 10, "Usuario", 1, 0, 'C', true);
$pdf->Cell(95, 10, "Documento", 1, 1, 'C', true);

$pdf->SetFont('dejavusans', '', 12);
$pdf->SetFillColor(240, 240, 240);
$pdf->Cell(95, 10, $nombreUsu, 1, 0, 'C', true);
$pdf->Cell(95, 10, $numdocuUsu, 1, 1, 'C', true);
$pdf->Ln(10);

// Tabla de facturas
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->SetFillColor(80, 80, 80);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(40, 10, 'ID Factura', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Fecha', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Método Pago', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Total', 1, 1, 'C', true);

$pdf->SetFont('dejavusans', '', 12);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFillColor(240, 240, 240);
$totalGeneral = 0;

foreach ($facturas as $factura) {
    $pdf->Cell(40, 10, $factura['idfact'], 1, 0, 'C');
    $pdf->Cell(50, 10, $factura['fecha'], 1, 0, 'C');
    $pdf->Cell(50, 10, $factura['metodo_pago'], 1, 0, 'C');
    $pdf->Cell(50, 10, "$".number_format($factura['total'], 2, ',', '.'), 1, 1, 'C');
    $totalGeneral += $factura['total'];
}

// Total general
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->SetFillColor(80, 80, 80);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(140, 10, 'Total General', 1, 0, 'R', true);
$pdf->Cell(50, 10, "$".number_format($totalGeneral, 2, ',', '.'), 1, 1, 'C', true);

$pdf->Output($nombreArchivo, 'I'); 
exit;
?>
