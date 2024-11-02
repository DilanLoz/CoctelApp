<?php include("controllers/cpusu.php"); ?>

<div id="usuario" class="container mt-5 mb-5" style="text-align: left; display: block;">
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="row">
            <h2 class="fw-bold mb-3"><i class="fa-solid fa-file-shield"></i> Datos personales</h2>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="identificacion" class="form-label" style="text-align: left; display: block;">No. de Identificacion:</label>
                    <input type="text" class="form-control" name="numdocu" id="numdocu" value="<?= $dat && isset($dat[0]['numdocu']) ? $dat[0]['numdocu'] : ''; ?>" required readonly>
                    <span class="text-muted">No se puede modificar</span>
                </div>
                <div class="mb-3">
                    <label for="nombres" class="form-label" style="text-align: left; display: block;">Nombres y apellidos:</label>
                    <input type="text" class="form-control" name="nomusu" id="nomusu" value="<?= $dat && isset($dat[0]['nomusu']) ? $dat[0]['nomusu'] : ''; ?>" required>
                    <span class="text-muted">No se puede modificar</span>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label" style="text-align: left; display: block;">Correo electrónico:</label>
                    <input type="email" class="form-control" name="emausu" id="emausu" value="<?= $dat && isset($dat[0]['emausu']) ? $dat[0]['emausu'] : ''; ?>" required>
                    <div class="invalid-feedback">
                        Por favor, introduce un correo electrónico válido.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="celusu" class="form-label" style="text-align: left; display: block;">Celular:</label>
                    <input type="text" class="form-control" name="celusu" id="celusu" value="<?= $dat && isset($dat[0]['celusu']) ? $dat[0]['celusu'] : ''; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label" style="text-align: left; display: block;">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" name="fecnausu" id="fecnausu" value="<?= $dat && isset($dat[0]['fecnausu']) ? $dat[0]['fecnausu'] : ''; ?>" required>
                    <span class="text-muted">No se puede modificar</span>
                </div>

                <div class="mb-4">
                    <label for="ubicacion" class="form-label" style="text-align: left; display: block;">Ubicación Actual:</label>
                    <select id="codubi" name="codubi" class="form-control">
                        <option value="bogota" <?= (isset($dat[0]['codubi']) && $dat[0]['codubi'] == 'bogota') ? 'selected' : ''; ?>>Bogotá DC</option>
                        <option value="medellin" <?= (isset($dat[0]['codubi']) && $dat[0]['codubi'] == 'medellin') ? 'selected' : ''; ?>>Medellín</option>
                        <option value="cartagena" <?= (isset($dat[0]['codubi']) && $dat[0]['codubi'] == 'cartagena') ? 'selected' : ''; ?>>Cartagena</option>
                        <option value="bucaramanga" <?= (isset($dat[0]['codubi']) && $dat[0]['codubi'] == 'bucaramanga') ? 'selected' : ''; ?>>Bucaramanga</option>
                        <option value="nariño" <?= (isset($dat[0]['codubi']) && $dat[0]['codubi'] == 'nariño') ? 'selected' : ''; ?>>Nariño</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="contrasena" class="form-label" style="text-align: left; display: block;">Contraseña:</label>
                    <input type="password" class="form-control" name="pssusu" id="pssusu" value="<?= $dat && isset($dat[0]['pssusu']) ? $dat[0]['pssusu'] : ''; ?>" required>
                </div>
                <div class="mt-4">
                    <label for="fotiden" class="form-label" style="text-align: left; display: block;">Foto de Identificación:</label>
                    <input type="file" class="form-control" name="fotiden" id="fotiden">
                </div>
            </div>
        </div>
        <div class="form-group col-md-4" style="text-align: left; display: block;">
            <br>
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idusu" value="<?= $dat && isset($dat[0]['idusu']) ? $dat[0]['idusu'] : ''; ?>" required>
            <input type="hidden" name="idper" value="<?= $dat && isset($dat[0]['idper']) ? $dat[0]['idper'] : ''; ?>">
            <input type="hidden" name="idval" value="<?= $dat && isset($dat[0]['idval']) ? $dat[0]['idval'] : ''; ?>">
            <input type="submit" class="btn btn-warning" value="Enviar">
        </div>
    </form>
</div>