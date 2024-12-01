<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/style.css">

<?php
require_once('controllers/cbargan.php');
// Establecer el idioma a español para mostrar el mes en español
setlocale(LC_TIME, 'es_ES.UTF-8', 'spanish');

// Filtrar datos por usuario autenticado (ya filtrado en el controlador)
$datFiltered = $datAll;
?>

<div class="container mt-5 mb-5" id="ganancias">
    <div class="row">
        <!-- Ganancias del Día -->
        <div class="col mb-5 mt-5">
            <div class="rounded p-3 border border-warning" id="ganan">
                <h2 class="text-warning fw-bold text-center mb-4 fs-3">Ganancias del Día</h2>
                <div class="container d-md-flex justify-content-between align-items-center">
                    <div class="mb-4 mb-md-0">
                        <h3 class="text-danger fw-bold">Dinero de hot</h3>
                        <div class="border border-danger border-3 rounded mb-3"></div>
                        <?php
                        // Calcular ganancias del día
                        $gananciasDia = 0;
                        $fechaActual = date('Y-m-d');
                        foreach ($datFiltered as $factura) {
                            if (date('Y-m-d', strtotime($factura['fecha'])) == $fechaActual) {
                                $gananciasDia += $factura['total'];
                            }
                        }
                        echo '<h5>' . '$ ' . number_format($gananciasDia, 0, ',', '.') . '</h5>';
                        ?>
                    </div>
                    <div>
                        <h3 class="text-danger fw-bold">Fecha de hoy</h3>
                        <div class="border border-danger border-3 rounded mb-3"></div>
                        <h5><?php echo strftime('%d/%m/%Y', strtotime($fechaActual)); ?></h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ganancias del Mes -->
        <div class="col mb-5 mt-5">
            <div class="rounded p-3 border border-warning" id="ganan">
                <h2 class="text-warning fw-bold text-center mb-4 fs-3">Ganancias del Mes</h2>
                <div class="container d-md-flex justify-content-between align-items-center">
                    <div class="mb-4 mb-md-0">
                        <h3 class="text-danger fw-bold">Dinero del Mes</h3>
                        <div class="border border-danger border-3 rounded mb-3"></div>
                        <?php
                        // Calcular ganancias del mes
                        $gananciasMes = 0;
                        $mesActual = date('m');
                        $anioActual = date('Y');
                        foreach ($datFiltered as $factura) {
                            $fechaFactura = strtotime($factura['fecha']);
                            if (date('m', $fechaFactura) == $mesActual && date('Y', $fechaFactura) == $anioActual) {
                                $gananciasMes += $factura['total'];
                            }
                        }
                        echo '<h5>' . '$ ' . number_format($gananciasMes, 0, ',', '.') . '</h5>';
                        ?>
                    </div>
                    <div>
                        <h3 class="text-danger fw-bold">Mes Actual</h3>
                        <div class="border border-danger border-3 rounded mb-3"></div>
                        <h5><?php echo ucfirst(strftime('%B', strtotime(date('Y-m-d')))); ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
