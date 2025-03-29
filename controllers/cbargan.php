<?php
setlocale(LC_TIME, "es_ES.UTF-8", "es_ES", "Spanish_Spain", "es_CO.UTF-8", "es_CO", "Spanish_Colombia"); 
date_default_timezone_set("America/Bogota");

require_once('models/mbargan.php');

if (!isset($_SESSION['idusu'])) {
    die('El usuario no está autenticado.');
}

$idusu = $_SESSION['idusu'];
$mbargan = new Mbargan();
$datAll = $mbargan->getBySessionId($idusu); // Obtener todas las facturas del usuario

// Inicializar variables
$gananciasDia = 0;
$gananciasMes = 0;
$gananciasSemana = [];
$gananciasAnio = [];
$fechaActual = date('Y-m-d');
$mesActual = date('m');
$anioActual = date('Y');
$hoy = strtotime($fechaActual);
$limiteSemana = strtotime('-6 days', $hoy); // Últimos 7 días

// Recorrer facturas para calcular ganancias
foreach ($datAll as $factura) {
    $fechaFactura = strtotime($factura['fecha']);
    $anioFactura = date('Y', $fechaFactura);
    $mesFactura = date('m', $fechaFactura);
    $diaFactura = date('Y-m-d', $fechaFactura); // Formato para agrupar días correctamente
    $nombreDia = ucfirst(strftime('%A %d/%m', $fechaFactura)); // Ejemplo: "Domingo 03/03"
    $totalFactura = $factura['total']; // Total sin aplicar descuento

    // Solo considerar facturas del año vigente
    if ($anioFactura == $anioActual) {
        // Si es del día actual
        if ($diaFactura == $fechaActual) {
            $gananciasDia += $totalFactura;
        }

        // Si es del mes actual
        if ($mesFactura == $mesActual) {
            $gananciasMes += $totalFactura;
        }

        // Si está en la última semana
        if ($fechaFactura >= $limiteSemana && $fechaFactura <= $hoy) {
            if (!isset($gananciasSemana[$nombreDia])) {
                $gananciasSemana[$nombreDia] = 0;
            }
            $gananciasSemana[$nombreDia] += $totalFactura;
        }

        // Corregir para que el día actual siempre coincida con "Ganancias del Día"
        if ($diaFactura == $fechaActual) {
            $gananciasSemana[$nombreDia] = $gananciasDia;
        }

        // Acumular en ganancias del año por mes
        $nombreMes = ucfirst(strftime('%B', $fechaFactura));
        if (!isset($gananciasAnio[$nombreMes])) {
            $gananciasAnio[$nombreMes] = 0;
        }
        $gananciasAnio[$nombreMes] += $totalFactura;
    }
}
?>
