<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/style.css">

<?php
    require_once('controllers/cbargan.php');
    // Establecer el idioma a español para mostrar el mes en español
    setlocale(LC_TIME, 'es_ES.UTF-8', 'spanish');
?>

<div class="container mt-5 mb-5" id="ganancias">
    <div class="row">
        <!-- Ganancias del Día -->
        <div class="col">
            <div class="rounded p-3 border" id="ganan">
                <h2 class="text-warning fw-bold text-center mb-4">Ganancias del Día</h2>
                <div class="container d-md-flex justify-content-between align-items-center text-light">
                    <div class="mb-4 mb-md-0">
                        <h3 class="text-danger">Dinero del Día</h3>
                        <?php
                            if ($datAll) foreach ($datAll as $dt){
                                  echo '<h5>' . '$ ' . number_format($dt['total'], 0, ',', '.') . '</h5>';
                            }
                        ?>
                    </div>
                    <div>
                        <h3 class="text-danger">Fecha del Día</h3>
                        <?php
                            if (!empty($datAll)) {
                                foreach ($datAll as $factura) {
                                    $fecha = date('d/m/Y', strtotime($factura['fecha']));
                                    echo '<h5>' . $fecha . '</h5>';
                                    
                                }
                            } else {
                                echo '<h5>No hay datos disponibles</h5>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ganancias del Mes -->
        <div class="col">
            <div class="rounded p-3 border" id="ganan">
                <h2 class="text-warning fw-bold text-center mb-4">Ganancias del Mes</h2>
                <div class="container d-md-flex justify-content-between align-items-center text-light">
                    <div class="mb-4 mb-md-0">
                        <h3 class="text-danger">Dinero del Mes</h3>
                        <?php
                            // Filtrar las facturas por mes (esto se puede hacer en la consulta del modelo o aquí)
                            // Ejemplo de cálculo para un mes (aquí asumes que ya tienes las facturas del mes)
                            $datMes = $mbargan->getAll(); // Filtrado por mes en el modelo
                            $totalMes = 0;
                            foreach ($datMes as $factura) {
                                $totalMes += $factura['total'];
                            }
                            echo '<h5>' . '$ ' . number_format($totalMes, 0, ',', '.') . '</h5>';
                        ?>
                    </div>
                    <div>
                        <h3 class="text-danger">Mes del Año</h3>
                        <?php
                            if (!empty($datMes)) {
                                // Extraer solo el mes en español
                                foreach ($datMes as $factura) {
                                    // Formatear la fecha para obtener el nombre del mes en español
                                    $mes = strftime('%B', strtotime($factura['fecha']));  // Nombre del mes en español
                                    echo '<h5>' . ucfirst($mes) . '</h5>';  // La función ucfirst pone la primera letra en mayúscula
                                }
                            } else {
                                echo '<h5>No hay fechas disponibles</h5>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
