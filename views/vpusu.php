<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<?php include("controllers/cpusu.php"); ?>

<div id="usuario" class="container mt-3 mb-5">
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="row">
            <h2 class="fw-bold mb-3"><i class="fa-solid fa-file-shield"></i> Datos personales</h2>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="identificacion" class="form-label">No. de Identificacion:</label>
                    <input type="text" class="form-control" name="numdocu" id="numdocu" value="<?= $dat && isset($dat[0]['numdocu']) ? $dat[0]['numdocu'] : ''; ?>" required>
                    <span class="text-muted">No se puede modificar</span>
                </div>
                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres y apellidos:</label>
                    <input type="text" class="form-control" name="nomusu" id="nomusu" value="<?= $dat && isset($dat[0]['nomusu']) ? $dat[0]['nomusu'] : ''; ?>" required>
                    <span class="text-muted">No se puede modificar</span>
                </div>
                <div class="mb-3">
                    <label for="correo" class="form-label">Correo electrónico:</label>
                    <input type="email" class="form-control" name="emausu" id="emausu" value="<?= $dat && isset($dat[0]['emausu']) ? $dat[0]['emausu'] : ''; ?>" required>
                    <div class="invalid-feedback">
                        Por favor, introduce un correo electrónico válido.
                    </div>
                </div>
                <div class="mb-3">
                    <label for="celusu" class="form-label">Celular:</label>
                    <input type="text" class="form-control" name="celusu" id="celusu" value="<?= $dat && isset($dat[0]['celusu']) ? $dat[0]['celusu'] : ''; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" name="fecnausu" id="fecnausu" value="<?= $dat && isset($dat[0]['fecnausu']) ? $dat[0]['fecnausu'] : ''; ?>" required>
                    <span class="text-muted">No se puede modificar</span>
                </div>

                <div class="mb-4">
                    <label for="ubicacion" class="form-label">Ubicación Actual:</label>
                    <select id="codubi" name="codubi" class="form-control">
                        <option value="bogota" <?= (isset($dat[0]['codubi']) && $dat[0]['codubi'] == 'bogota') ? 'selected' : ''; ?>>Bogotá DC</option>
                        <option value="medellin" <?= (isset($dat[0]['codubi']) && $dat[0]['codubi'] == 'medellin') ? 'selected' : ''; ?>>Medellín</option>
                        <option value="cartagena" <?= (isset($dat[0]['codubi']) && $dat[0]['codubi'] == 'cartagena') ? 'selected' : ''; ?>>Cartagena</option>
                        <option value="bucaramanga" <?= (isset($dat[0]['codubi']) && $dat[0]['codubi'] == 'bucaramanga') ? 'selected' : ''; ?>>Bucaramanga</option>
                        <option value="nariño" <?= (isset($dat[0]['codubi']) && $dat[0]['codubi'] == 'nariño') ? 'selected' : ''; ?>>Nariño</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="contrasena" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" name="pssusu" id="pssusu" value="<?= $dat && isset($dat[0]['pssusu']) ? $dat[0]['pssusu'] : ''; ?>" required>
                </div>
                <div class="mt-4">
                    <label for="fotiden" class="form-label">Foto de Identificación:</label>
                    <input type="file" class="form-control" name="fotiden" id="fotiden">
                </div>
            </div>
        </div>
        <div class="form-group col-md-4">
            <br>
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idusu" value="<?= $dat && isset($dat[0]['idusu']) ? $dat[0]['idusu'] : ''; ?>" required>
            <input type="hidden" name="idper" value="<?= $dat && isset($dat[0]['idper']) ? $dat[0]['idper'] : ''; ?>">
            <input type="hidden" name="idval" value="<?= $dat && isset($dat[0]['idval']) ? $dat[0]['idval'] : ''; ?>">
            <input type="submit" class="btn btn-warning" value="Enviar">
        </div>
    </form>
</div>