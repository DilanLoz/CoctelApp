<?php require_once('controllers/cpusu.php');
require_once('admin/controllers/cubi.php');
require_once('controllers/cpbar.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<link rel="stylesheet" href="css/main.css">
<div id="perfil" class="container mt-5 mb-5" style="text-align: left; display: block;">
    <!-- Contenedor de encabezado con botón alineado a la derecha -->
    <div class="d-flex justify-content-between align-items-center p-3 bg-light border rounded">
        <h3 class="mb-0">Hola, <?= $_SESSION['nomusu'] ?? 'No disponible'; ?></h3>
        <button class="btn btn-dark d-flex align-items-center" id="editButton">
            <i class="fa-solid fa-pen-to-square me-2"></i> Editar
        </button>
    </div>

    <!-- Formulario de edición (inicialmente oculto) -->
    <div id="editForm" class="mt-3" style="display: none;">
        <div class="p-4 bg-light border rounded">
            <h3 class="text-center mb-3">Editar Información del Bar</h3>
            <form action="home.php?pg=<?= $pg; ?>" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nombar" class="form-label">Nombre del Bar:</label>
                            <input type="text" class="form-control" id="nombar" name="nombar" value="<?= isset($datOne[0]['nombar']) ? $datOne[0]['nombar'] : ''; ?>" >
                        </div>
                        <div class="mb-3">
                            <label for="nit" class="form-label">No. de NIT:</label>
                            <input type="text" class="form-control" id="nit" name="nit" value="<?= isset($datOne[0]['nit']) ? $datOne[0]['nit'] : ''; ?>" >
                        </div>
                        <div class="mb-3">
                            <label for="nompropi" class="form-label">Nombre del Propietario:</label>
                            <input type="text" class="form-control" id="nompropi" name="nompropi" value="<?= isset($datOne[0]['nompropi']) ? $datOne[0]['nompropi'] : ''; ?>" >
                        </div>
                        <div class="mb-3">
                            <label for="pssbar" class="form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="pssbar" name="pssbar" value="<?= isset($datOne[0]['pssbar']) ? $datOne[0]['pssbar'] : ''; ?>" >
                        </div>
                        <div class="mb-3">
                            <label for="fotiden" class="form-label">Foto del Bar:</label>
                            <input type="file" class="form-control" id="fotiden" name="fotiden" accept="image/*">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="emabar" class="form-label">Gmail:</label>
                            <input type="email" class="form-control" id="emabar" name="emabar" value="<?= isset($datOne[0]['emabar']) ? $datOne[0]['emabar'] : ''; ?>" >
                        </div>
                        <div class="mb-3">
                            <label for="telbar" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="telbar" name="telbar" value="<?= isset($datOne[0]['telbar']) ? $datOne[0]['telbar'] : ''; ?>" >
                        </div>
                        <div class="mb-3">
                            <label for="dircbar" class="form-label">Dirección del Bar:</label>
                            <input type="text" class="form-control" id="dircbar" name="dircbar" value="<?= isset($datOne[0]['dircbar']) ? $datOne[0]['dircbar'] : ''; ?>" >
                        </div>
                        <div class="mb-3">
                            <label for="horbar" class="form-label">Horario del Bar:</label>
                            <input type="text" class="form-control" id="horbar" name="horbar" value="<?= isset($datOne[0]['horbar']) ? $datOne[0]['horbar'] : ''; ?>" >
                        </div>
                        <div class="mb-3">
                            <label for="codubi" class="form-label">Ubicación:</label>
                            <select class="form-control" id="codubi" name="codubi" >
                                <option value="" disabled selected>Seleccione una ciudad</option>
                                <?php
                                $dataUbicaciones = $mubi->getCodubiNomubi();
                                if ($dataUbicaciones) {
                                    foreach ($dataUbicaciones as $ubicacion) {
                                        $selected = (isset($datOne[0]['codubi']) && $datOne[0]['codubi'] == $ubicacion['codubi']) ? 'selected' : '';
                                        echo '<option value="' . $ubicacion['codubi'] . '" ' . $selected . '>' . $ubicacion['nomubi'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" value="save" class="btn btn-warning">Actualizar datos</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla de los datos del bar -->
    <div class="container mt-4" style="text-align: left;">
        <div class="p-4 bg-light border rounded">
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nombre del bar:</strong> <span><?= $_SESSION['nomusu'] ?? 'No disponible'; ?></span></p>
                    <p><strong>No. de NIT:</strong> <span><?= $_SESSION['numdocu'] ?? 'No disponible'; ?></span></p>
                    <p><strong>Nombre del propietario:</strong> <span><?= $_SESSION['nompropi'] ?? 'No disponible'; ?></span></p>
                    <p><strong>Gmail:</strong> <span><?= $_SESSION['emausu'] ?? 'No disponible'; ?></span></p>
                </div>
                <div class="col-md-6">
                    <p><strong>Teléfono:</strong> <span><?= $_SESSION['celusu'] ?? 'No disponible'; ?></span></p>
                    <p><strong>Ubicación Actual:</strong> <span><?= $_SESSION['nomubi'] ?? 'No disponible'; ?></span></p>
                    <p><strong>Dirección del bar:</strong> <span><?= $_SESSION['dircbar'] ?? 'No disponible'; ?></span></p>
                    <p><strong>Horario del bar:</strong> <span><?= $_SESSION['horbar'] ?? 'No disponible'; ?></span></p>
                    <p><strong>Foto del bar:</strong></p>
                    <img src="<?= $_SESSION['fotiden'] ?? 'default.jpg'; ?>" alt="Foto del bar" class="img-fluid rounded border" style="max-width: 200px;">
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/main.js"></script>
<script src="js/editForm.js"></script>
