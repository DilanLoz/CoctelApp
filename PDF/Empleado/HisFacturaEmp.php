<?php
require_once '../../models/mfacturapdf.php';
require_once '../tcpdf/tcpdf.php';

if (!isset($_GET['idfact'])) {
    die('ID de factura no proporcionado.');
}

// FECHA DE IMPRESIÓN Y NOMBRE DEL MES EN ESPAÑOL
date_default_timezone_set('America/Bogota');
setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain', 'Spanish'); // Configurar el locale en español
$fecha_generacion = strftime('%d de %B de %Y, %H:%M:%S');
$fecha_generacion = utf8_encode($fecha_generacion); // Asegurar caracteres especiales
$fecha_archivo = date('Y-m-d_H-i-s');
$nombre_mes = strftime('%B %Y');
$nombre_mes = utf8_encode($nombre_mes); // Convertir caracteres especiales

$idfact = $_GET['idfact'];
$facturaModel = new Factura();
$datos = $facturaModel->getFacturaDetalle($idfact);
if (!$datos) {
    $pdf = new TCPDF();
    $pdf->AddPage();
    $pdf->SetY(150);
    $pdf->SetFont('dejavusans', 'B', 14);
    $pdf->Cell(190, -240, "No se encontró la factura.", 0, 1, 'C');
    $pdf->Cell(190, -220, "Comuníquese con el Administrador: coctelapp.admin@gmail.com", 0, 1, 'C');
    $pdf->Output();
    exit;
}

$nombreArchivo = "fact_{$idfact}_{$fecha_archivo}_ca.pdf";

class MYPDF extends TCPDF{
    public $fecha_impresion;
    public function Header() {
        $this->SetY(15); // Ajusta la posición Y del encabezado
        $this->SetFont('dejavusans', 'B', 14);
        $this->Cell(190, 10, 'CoctelApp - Facturación', 0, 1, 'C');
        $this->Ln(10); // Agrega espacio extra después del título
    }

    public function Footer() {
        $this->SetY(-20);
        $this->SetFont('dejavusans', 'I', 10);
        $this->Cell(0, 10, 'Factura Generada Por CoctelApp', 0, 1, 'C');
        $this->Cell(0, 10, 'Fecha de impresión: ' . $this->fecha_impresion, 0, 0, 'C'); // Agregando la fecha
    }
}

$pdf = new MYPDF();
$pdf->SetAutoPageBreak(TRUE, 20);
$pdf->SetMargins(10, 30, 10);
$pdf->AddPage();
$pdf->SetFont('dejavusans', 'B', 16);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(190, 10, 'Factura #'.$datos[0]['idfact'], 0, 1, 'C');
$pdf->Ln(5);


// Información General
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->SetFillColor(80, 80, 80); // Gris oscuro
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(190, 10, 'Información General', 1, 1, 'C', true);

$info = [
    ['Cliente', $datos[0]['usuario'], 'Fecha Factura', $datos[0]['fecha']],
    ['Empleado', $datos[0]['empleado'], 'Método de Pago', $datos[0]['metodo_pago']],
    ['Bar', $datos[0]['bar'], 'Estado de Pago', $datos[0]['estado_pago']]
];

$pdf->SetFont('dejavusans', '', 12);
foreach ($info as $row) {
    $pdf->SetFillColor(80, 80, 80);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(45, 8, $row[0] . ':', 1, 0, 'L', true);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(50, 8, $row[1], 1, 0, 'L');
    $pdf->SetFillColor(80, 80, 80);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->Cell(45, 8, $row[2] . ':', 1, 0, 'L', true);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(50, 8, $row[3], 1, 1, 'L');
}

$pdf->Ln(5);

// Tabla de productos
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->SetFillColor(80, 80, 80);
$pdf->SetTextColor(255, 255, 255);

$pdf->Cell(80, 10, 'Producto', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Precio', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Total', 1, 1, 'C', true);

// Restaurar color del texto a negro para el resto de la tabla
$pdf->SetTextColor(0, 0, 0);

$pdf->SetFont('helvetica', '', 12);
$totalGeneral = 0;
foreach ($datos as $item) {
    $nombreProducto = mb_strimwidth($item['nomprod'], 0, 30, "...");
    $pdf->Cell(80, 10, $nombreProducto, 1);
    $pdf->Cell(30, 10, $item['cantidad'], 1, 0, 'C');
    $pdf->Cell(40, 10, "$" . number_format($item['precio_unitario'], 2), 1, 0, 'C');
    $pdf->Cell(40, 10, "$" . number_format($item['total_detalle'], 2), 1, 1, 'C');
    $totalGeneral += $item['total_detalle'];
}

// Total General
$pdf->SetFont('dejavusans', 'B', 12);
$pdf->SetFillColor(80, 80, 80);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(150, 10, 'TOTAL GENERAL', 1, 0, 'C', true);
$pdf->Cell(40, 10, "$" . number_format($totalGeneral, 2), 1, 1, 'C', true);

// Comisión del 2%
$comision = $totalGeneral * 0.02;
$pdf->Cell(150, 10, 'Comisión (2%)', 1, 0, 'C', true);
$pdf->Cell(40, 10, "$" . number_format($comision, 2), 1, 1, 'C', true);

// Generar PDF
$pdf->fecha_impresion = $fecha_generacion; // Asigna la fecha de impresión
$pdf->Output($nombreArchivo, 'I');
?>
