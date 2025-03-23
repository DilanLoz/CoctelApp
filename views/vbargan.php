<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="css/style.css">

<?php
require_once('controllers/cbargan.php');
setlocale(LC_TIME, 'es_ES.UTF-8', 'spanish', 'es_CO.UTF-8', 'es_CO');
date_default_timezone_set("America/Bogota");
bind_textdomain_codeset("messages", "UTF-8");

$datFiltered = $datAll;
?>

<div class="container mt-5 mb-5" id="ganancias">
    <div class="row">
    <div class="d-flex justify-content-end mt-4">
        <button class="btn btn-dark btn-md" onclick="window.location.href='home.php?pg=3030'"><i class="fa-solid fa-headset"></i>
        </button>
    </div>
        <!-- Ganancias del Día -->
        <div class="col-md-6 mb-5 mt-5">
            <div class="rounded p-3 shadow-lg">
                <h2 class="text-warning fw-bold text-center mb-4 fs-3">Ganancias del Día</h2>
                <div class="container d-md-flex justify-content-between align-items-center">
                    <div class="mb-4 mb-md-0">
                        <h3 class="text-danger fw-bold">Dinero de hoy</h3>
                        <h5><?php echo '$ ' . number_format($gananciasDia, 0, ',', '.'); ?></h5>
                    </div>
                    <div>
                        <h3 class="text-danger fw-bold">Fecha de hoy</h3>
                        <h5><?php echo strftime('%d/%m/%Y', strtotime($fechaActual)); ?></h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ganancias del Mes -->
        <div class="col-md-6 mb-5 mt-5">
            <div class="rounded p-3 shadow-lg">
                <h2 class="text-warning fw-bold text-center mb-4 fs-3">Ganancias del Mes</h2>
                <div class="container d-md-flex justify-content-between align-items-center">
                    <div class="mb-4 mb-md-0">
                        <h3 class="text-danger fw-bold">Dinero del Mes</h3>
                        <h5><?php echo '$ ' . number_format($gananciasMes, 0, ',', '.'); ?></h5>
                    </div>
                    <div>
                        <h3 class="text-danger fw-bold">Mes Actual</h3>
                        <h5><?php echo ucfirst(strftime('%B', strtotime(date('Y-m-d')))); ?></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tabla de Ganancias de la Semana -->
    <div class="row">
        <div class="col-md-12">
            <div class="rounded p-3 shadow-lg">
                <h2 class="text-warning fw-bold text-center mb-4 fs-3">Ganancias de la Última Semana</h2>
                <table class="table table-bordered">
                    <thead class="table-warning">
                        <tr>
                            <th class="text-center">Día</th>
                            <th class="text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($gananciasSemana)) {
                            foreach ($gananciasSemana as $dia => $total) {
                                echo "<tr>
                                            <td class='text-center'>$dia</td>
                                            <td class='text-center'>$ " . number_format($total, 0, ',', '.') . "</td>
                                          </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2' class='text-center'>No hay ventas en los últimos 7 días</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tabla de Ganancias del Año -->
    <div class="col mb-5 mt-5">
        <div class="rounded p-3 shadow-lg">
            <h2 class="text-warning fw-bold text-center mb-4 fs-3">Ganancias del Año</h2>
            <table class="table table-bordered text-center">
                <thead>
                    <tr class="table-danger">
                        <th>Mes</th>
                        <th>Ganancia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($gananciasAnio as $mes => $ganancia) {
                        echo "<tr>
                                <td>" . ucfirst($mes) . " $anioActual</td>
                                <td>$ " . number_format($ganancia, 0, ',', '.') . "</td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Botón de Generar Reporte -->
    <div class="text-end">
        <a href="PDF/Bar/GananciasBar.php" target="_blank" class="btn btn-outline-danger mt-2">
            <i class="fa-regular fa-file-pdf"></i> Generar Reporte
        </a>
    </div>
</div>
</div>