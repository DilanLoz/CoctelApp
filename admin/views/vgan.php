<?php require_once 'admin/controllers/cgan.php'; ?>
<br><br><br>

<!-- Tabla de ganes registrados -->
<table id="example" class="table table-striped" style="width:100%;">
    <thead>
        <tr>
            <th>Detalle Factura</th>
            <th>ID de la factura</th>
            <th>ID del producto</th>
            <th>Cantidad de productos</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
            <th>ID del Bar</th>
            <th></th> <!-- Columna extra para las acciones -->
        </tr>
    </thead>
    <tbody>
        <?php
        // Obtenemos los datos utilizando el método getAll()
        $gans = $mgan->getAll(); 
        foreach ($gans as $gan) {
        ?>
        <tr>
            <td><?=$gan['iddetfact'];?></td>
            <td><?=$gan['idfact'];?></td>
            <td><?=$gan['idprod'];?></td>
            <td><?=$gan['cantidad'];?></td>
            <td><?=$gan['precio_unitario'];?></td>
            <td><?=$gan['subtotal'];?></td>
            <td><?=$gan['idbar'];?></td>
            <td style="text-align:center;"> <!-- Columna para las acciones -->
                <a href="home.php?pg=<?=$pg;?>&iddetfact=<?=$gan['iddetfact'];?>&ope=delete" title="Eliminar" onclick="return eliminar();">
                    <i class="fa-solid fa-trash-can fa"></i>
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Detalle Factura</th>
            <th>ID de la factura</th>
            <th>ID del producto</th>
            <th>Cantidad de productos</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
            <th>ID del Bar</th>
            <th></th> <!-- Columna extra para las acciones -->
        </tr>
    </tfoot>
    <style>
        .charts-container {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }
        canvas {
            max-width: 40%;
            max-height: 90%;
        }
        #pieChart {
            max-width: 40%; /* La gráfica de pastel será más pequeña */
            max-height: 100%;
        }
    </style>
</table>

<h1 style="text-align: center;">Subtotales por Bar</h1>
<div class="charts-container">
    <canvas id="barChart"></canvas>
    <canvas id="pieChart"></canvas>
</div>

<?php
// Agrupar los datos por idbar para los subtotales
$data = [];
foreach ($gans as $gan) {
    $nombar = $gan['nombar'];
    if (!isset($data[$nombar])) {
        $data[$nombar] = 0;
    }
    $data[$nombar] += $gan['subtotal'];
}

// Preparar datos para las gráficas
$barIDs = array_keys($data);
$subtotals = array_values($data);

// Calcular porcentajes para la gráfica de pastel
$total = array_sum($subtotals);
$percentages = array_map(function($value) use ($total) {
    return round(($value / $total) * 100, 2);
}, $subtotals);
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pasar datos de PHP a JavaScript
    const barIDs = <?php echo json_encode($barIDs); ?>; // IDs de los bares
    const subtotals = <?php echo json_encode($subtotals); ?>; // Subtotales
    const percentages = <?php echo json_encode($percentages); ?>; // Porcentajes
    const colors = [
        'rgba(75, 192, 192, 0.6)',
        'rgba(255, 99, 132, 0.6)',
        'rgba(54, 162, 235, 0.6)',
        'rgba(255, 206, 86, 0.6)',
        'rgba(153, 102, 255, 0.6)',
        'rgba(255, 159, 64, 0.6)'
    ];

    // Gráfico de barras
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: barIDs, // IDs de los bares
            datasets: [{
                label: 'Subtotal por Bar ($)',
                data: subtotals,
                backgroundColor: colors,
                borderColor: colors.map(color => color.replace('0.6', '1')),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Subtotal ($)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Nombre del Bar'
                    }
                }
            }
        }
    });

    // Gráfico de pastel
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: barIDs.map((id, index) => Bar ${id} (${percentages[index]}%)), // Etiquetas con porcentaje
            datasets: [{
                label: 'Porcentaje de Subtotal por Bar',
                data: subtotals, // Datos de subtotales
                backgroundColor: colors, // Colores para cada sector
                borderColor: '#fff',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        boxWidth: 15,
                        padding: 10
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return ${context.label}: $${context.raw}; // Mostrar subtotales en el tooltip
                        }
                    }
                }
            }
        }
    });
</script>
<?php require_once 'admin/controllers/cgan.php'; ?>
<br><br><br>