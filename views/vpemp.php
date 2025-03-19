<?php
// Iniciar sesión si no está activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Incluir los controladores necesarios
include('controllers/cpusu.php');
require_once('admin/controllers/cubi.php');
require_once('admin/controllers/cval.php');

$idbar = $_SESSION['idbar'] ?? null;
$nombar = '';

if ($idbar) {
    $mpusu = new Mpusu(); // Instancia del modelo
    $nombar = $mpusu->obtenerNombreBar($idbar); // Método corregido para obtener el nombre del bar
}

?>

<div id="perfil" class="container mt-5 mb-5" style="text-align: left; display: block;">
    <div class="mt-3">
        <div class="p-4 bg-light border rounded">
            <div class="d-flex justify-content-between mb-3">
                <h3 class="fw-bold">Información Personal</h3>
                <button class="btn btn-outline-primary align-content-start" id="infoButton">
                    <i class="fa-solid fa-question-circle"></i>
                </button>
            </div>
            <hr>
            <form name="frm1" action="home.php?pg=<?= $pg; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idusu" value="<?= $_SESSION['idusu'] ?? ''; ?>">

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-group" for="nomusu">Nombre *</label>
                            <input type="text" class="form-control restricted" name="nomusu" id="nomusu"
                                value="<?= $_SESSION['nomusu'] ?? ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="idval" class="form-label">Tipo de documento *</label>
                            <select class="form-control form-select restricted" id="idval" name="idval">
                                <option value="" disabled>Tipo de documento</option>
                                <?php
                                $valoresValidos = $mval->getDocumentos();
                                $selectedDocumento = $_SESSION['idval'] ?? '';
                                if ($valoresValidos) {
                                    foreach ($valoresValidos as $valor) {
                                        $selected = ($selectedDocumento == $valor['idval']) ? 'selected' : '';
                                        echo '<option value="' . $valor['idval'] . '" ' . $selected . '>' . $valor['nomval'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-group" for="fecnausu">Fecha de Nacimiento *</label>
                            <input type="date" class="form-control restricted" name="fecnausu" id="fecnausu"
                                value="<?= $_SESSION['fecnausu'] ?? ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-group" for="celusu">Celular</label>
                            <input type="number" class="form-control" name="celusu" id="celusu"
                                value="<?= $_SESSION['celusu'] ?? ''; ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-group" for="emausu">Email</label>
                            <input type="email" class="form-control" name="emausu" id="emausu"
                                value="<?= $_SESSION['emausu'] ?? ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-group" for="numdocu">No. Documento *</label>
                            <input type="text" class="form-control restricted" name="numdocu" id="numdocu"
                                value="<?= $_SESSION['numdocu'] ?? ''; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="codubi" class="form-label">Ubicación:</label>
                            <select class="form-control form-select" id="codubi" name="codubi">
                                <option value="" disabled>Seleccione una ciudad</option>
                                <?php
                                $dataUbicaciones = $mubi->getCodubiNomubi();
                                $selectedUbicacion = $_SESSION['codubi'] ?? '';
                                if ($dataUbicaciones) {
                                    foreach ($dataUbicaciones as $ubicacion) {
                                        $selected = ($selectedUbicacion == $ubicacion['codubi']) ? 'selected' : '';
                                        echo '<option value="' . $ubicacion['codubi'] . '" ' . $selected . '>' . $ubicacion['nomubi'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-group" for="nombar">Nombre Del Bar Asociado *</label>
                            <input type="text" class="form-control restricted" name="nombar" id="nombar"
                                value="<?= htmlspecialchars($nombar); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-group" for="imgusu">Imagen</label>
                            <input type="file" class="form-control" name="fots" accept="image/*" id="imgusu">
                            <input type="hidden" name="imgusu" value="<?= $_SESSION['imgusu'] ?? ''; ?>">
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <input type="hidden" name="ope" value="save">
                        <button type="button" class="btn btn-outline-success btn-lg px-4 shadow-sm" id="showConfirmModal">
                            <i class="fas fa-paper-plane"></i> Actualizar Datos
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas actualizar los datos?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="confirmSave">Sí, actualizar</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const showConfirmModal = document.getElementById("showConfirmModal");
        const confirmSave = document.getElementById("confirmSave");
        const form = document.querySelector("form");
        const infoButton = document.getElementById("infoButton");

        showConfirmModal.addEventListener("click", function() {
            new bootstrap.Modal(document.getElementById("confirmModal")).show();
        });

        confirmSave.addEventListener("click", function() {
            form.submit();
        });

        infoButton.addEventListener("click", function() {
            alert("La contraseña no se puede modificar en perfil, solo en 'Cambiar Contraseña'.");
        });
    });
</script>
