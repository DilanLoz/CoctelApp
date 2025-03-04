<?php
require_once '../../models/mfacturapdf.php';
require_once '../fpdf/fpdf.php';

if (!isset($_GET['idfact'])) {
    die('ID de factura no proporcionado.');
}

// 🔹 Configurar la zona horaria correcta
date_default_timezone_set('America/Bogota');

// Obtener la fecha de generación del PDF
$fecha_generacion = date('Y-m-d H:i:s');
$fecha_archivo = date('Y-m-d_H-i-s');

$idfact = $_GET['idfact'];
$facturaModel = new Factura();
$datos = $facturaModel->getFacturaDetalle($idfact);

if (!$datos) {
    // Crear PDF vacío con la imagen de error
    $pdf = new FPDF();
    $pdf->AddPage();

    // Añadir imagen de error en el centro de la página
    $pdf->Image('../../img/coctelapp/svg/Money stress-cuate.png', 40, 50, 130); // Ajusta la posición y tamaño según sea necesario

    // Agregar un mensaje opcional debajo de la imagen
    $pdf->SetY(150);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(190, -240, mb_convert_encoding("No se encontró la factura.", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->SetY(150);
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(190, -220, mb_convert_encoding("Comuniquese con el Administrador: coctelapp@gmail.com", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    

    // Mostrar el PDF sin factura
    $pdf->Output();
    exit;
}

// Definir nombre del archivo PDF con fecha de generación
$nombreArchivo = "fact_{$idfact}_{$fecha_archivo}_ca.pdf";

// 🔹 Limpiar salida previa
ob_end_clean();
header("Content-Type: application/pdf");
header("Content-Disposition: inline; filename={$nombreArchivo}");

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(190, 10, mb_convert_encoding('CoctelApp - Facturación', 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        $this->Ln(5);
    }
    
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 10, mb_convert_encoding('Factura Generada Por CoctelApp', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();

// 🔹 Número de factura en rojo
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(190, 10, mb_convert_encoding('Factura #'.$datos[0]['idfact'], 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
$pdf->Ln(5);

// 🔹 Mostrar fecha de generación del PDF
$pdf->SetFont('Arial', 'I', 12);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(190, 10, mb_convert_encoding("Generado el: ".$fecha_generacion, 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
$pdf->Ln(5);

// 🔹 Datos Generales (optimizado)
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(0);

$labelWidth = 40;  // Ancho de la etiqueta
$valueWidth = 55;  // Ancho del valor
$lineHeight = 8;   // Altura de la celda

// Primera fila
$pdf->Cell($labelWidth, $lineHeight, mb_convert_encoding("Cliente: ", 'ISO-8859-1', 'UTF-8'), 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell($valueWidth, $lineHeight, mb_convert_encoding($datos[0]['usuario'], 'ISO-8859-1', 'UTF-8'), 0, 0);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell($labelWidth, $lineHeight, mb_convert_encoding("Fecha Factura: ", 'ISO-8859-1', 'UTF-8'), 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell($valueWidth, $lineHeight, mb_convert_encoding($datos[0]['fecha'], 'ISO-8859-1', 'UTF-8'), 0, 1);

// Segunda fila
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell($labelWidth, $lineHeight, mb_convert_encoding("Empleado: ", 'ISO-8859-1', 'UTF-8'), 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell($valueWidth, $lineHeight, mb_convert_encoding($datos[0]['empleado'], 'ISO-8859-1', 'UTF-8'), 0, 0);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell($labelWidth, $lineHeight, mb_convert_encoding("Método de Pago: ", 'ISO-8859-1', 'UTF-8'), 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell($valueWidth, $lineHeight, mb_convert_encoding($datos[0]['metodo_pago'], 'ISO-8859-1', 'UTF-8'), 0, 1);

// Tercera fila
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell($labelWidth, $lineHeight, mb_convert_encoding("Bar: ", 'ISO-8859-1', 'UTF-8'), 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell($valueWidth, $lineHeight, mb_convert_encoding($datos[0]['bar'], 'ISO-8859-1', 'UTF-8'), 0, 0);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell($labelWidth, $lineHeight, mb_convert_encoding("Estado de Pago: ", 'ISO-8859-1', 'UTF-8'), 0, 0);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell($valueWidth, $lineHeight, mb_convert_encoding($datos[0]['estado_pago'], 'ISO-8859-1', 'UTF-8'), 0, 1);

$pdf->Ln(5);


// 🔹 Tabla de Detalle
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(200, 200, 200);
$pdf->SetTextColor(0);
$pdf->Cell(70, 10, mb_convert_encoding('Producto', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Cantidad', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Precio', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Total', 1, 1, 'C', true);

$pdf->SetFont('Arial', '', 12);
$pdf->SetFillColor(240, 240, 240);
$fill = false;
$totalGeneral = 0;

foreach ($datos as $item) {
    $pdf->Cell(70, 10, mb_convert_encoding($item['nomprod'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', $fill);
    $pdf->Cell(30, 10, $item['cantidad'], 1, 0, 'C', $fill);
    $pdf->Cell(40, 10, "$".number_format($item['precio_unitario'], 2, ',', '.'), 1, 0, 'C', $fill);
    $pdf->Cell(40, 10, "$".number_format($item['total_detalle'], 2, ',', '.'), 1, 1, 'C', $fill);
    $totalGeneral += $item['total_detalle'];
    $fill = !$fill;
}

// 🔹 Total General
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(140, 10, mb_convert_encoding('TOTAL GENERAL', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
$pdf->Cell(40, 10, "$".number_format($totalGeneral, 2, ',', '.'), 1, 1, 'C', true);

// 🔹 Comisión del 2%
$comision = $totalGeneral * 0.02;
$pdf->Cell(140, 10, mb_convert_encoding('Comisión (2%)', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
$pdf->Cell(40, 10, "$".number_format($comision, 2, ',', '.'), 1, 1, 'C', true);

// 🔹 Generar PDF con nombre dinámico
$pdf->Output('I', $nombreArchivo);
exit;
?>
