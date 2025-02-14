<?php
require_once 'models/marplabar.php';

date_default_timezone_set('America/Bogota');

// Verificar si el usuario está autenticado
$idusu = isset($_SESSION['idusu']) ? $_SESSION['idusu'] : NULL;
if (!$idusu) {
    die('El usuario no está autenticado.');
}

// Instanciar la clase
$marplabar = new Marplabar();

// Obtener información del usuario
$datusu = $marplabar->getInfousu();

// Obtener facturas del usuario
$datAll = $marplabar->getByIdBar($idusu);

// Calcular ganancias del mes actual
$gananciasMes = $marplabar->sumarTotalByIdBar($idusu);

// Verificar si hay facturas
if (!$datAll) {
    $datAll = []; // Evitar errores en caso de que no haya facturas
}

// Generar HTML
$html = "";
$html .= '<!DOCTYPE html>';
$html .= '<html lang="es">';
$html .= '<head>';
$html .= '<meta charset="UTF-8">';
$html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
$html .= '<title>REPORTE DE GANANCIAS</title>';
$html .= '<style>';
$html .= 'table { width: 100%; margin: auto; border-collapse: collapse; }';
$html .= 'th, td { border: 1px solid; padding: 8px; text-align: left; }';
$html .= 'img { height: 50px; width: 50px; }';
$html .= '</style>';
$html .= '</head>';
$html .= '<body>';

// Logo
$html .= '<table>';
$html .= '<tr><td><img src="img/coctelapp/logo.png" alt="logo"></td></tr>';
$html .= '</table>';

// Título
$html .= '<table>';
$html .= '<tr><td><b>REPORTE DE GANANCIAS</b></td></tr>';
$html .= '</table>';

// Datos del usuario
$html .= '<table>';
$html .= '<tr>';
$html .= '<th colspan="3">NOMBRE</th>';
$html .= '<th colspan="3">' . ($_SESSION['nomusu'] ?? '') . '</th>';
$html .= '<th colspan="3">NIT</th>';
$html .= '<th colspan="3">' . ($_SESSION['numdocu'] ?? '') . '</th>';
$html .= '<th colspan="3">Fecha del Informe</th>';
$html .= '<th colspan="3">' . date('d/m/Y') . '</th>';
$html .= '</tr>';
$html .= '</table>';

// Tabla de facturas
$html .= '<table>';
$html .= '<thead>';
$html .= '<tr>';
$html .= '<th>ID Factura</th>';
$html .= '<th>Fecha</th>';
$html .= '<th>Total</th>';
$html .= '</tr>';
$html .= '</thead>';
$html .= '<tbody>';

// Mostrar facturas
foreach ($datAll as $factura) {
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($factura['idfact']) . '</td>';
    $html .= '<td>' . htmlspecialchars($factura['fecha']) . '</td>';
    $html .= '<td>$ ' . number_format($factura['total'], 0, ',', '.') . '</td>';
    $html .= '</tr>';
}

// Total del mes
$html .= '<tr>';
$html .= '<th colspan="2">Total del Mes</th>';
$html .= '<th>$ ' . number_format($gananciasMes, 0, ',', '.') . '</th>';
$html .= '</tr>';

$html .= '</tbody>';
$html .= '</table>';

$html .= '</body>';
$html .= '</html>';

echo $html;
?>
