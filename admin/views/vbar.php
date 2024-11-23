<?php require_once 'admin/controllers/cbar.php'; ?>

<br><br><br>

<!-- Título -->
<div class="conte">
    <h1><i class="fa-solid fa-wine-bottle"></i> Bares</h1>

    <!-- Formulario para crear o editar un bar -->
    <div class="inser">
        <form action="home.php?pg=<?= $pg; ?>" method="POST" enctype="multipart/form-data">
            <!-- Aquí utilizamos un solo registro para editar o crear un bar -->
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="idbar"><strong>ID del bar</strong></label>
                    <input type="text" name="idbar" id="idbar" class="form-control" 
                        value="<?= isset($datOne[0]['idbar']) ? $datOne[0]['idbar'] : ''; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombar"><strong>Nombre del bar</strong></label>
                    <input type="text" name="nombar" id="nombar" class="form-control" 
                        value="<?= isset($datOne[0]['nombar']) ? $datOne[0]['nombar'] : ''; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nompropi"><strong>Nombre del propietario</strong></label>
                    <input type="text" name="nompropi" id="nompropi" class="form-control" 
                        value="<?= isset($datOne[0]['nompropi']) ? $datOne[0]['nompropi'] : ''; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nit"><strong>NIT</strong></label>
                    <select name="nit" id="nit" class="form-select">
                    <option value="" disabled selected></option> <!-- Opción inicial -->
                    <?php
                    $bars = $mbar->getAll(); // Método que obtiene todas las ciudades
                    foreach ($bars as $ni) {
                        // Verificar si la ciudad actual está seleccionada
                        $selected = (isset($datOne[0]['nit']) && $datOne[0]['nit'] == $ni['nit']) ? 'selected' : '';
                    ?>
                        <option value="<?= $ni['nit']; ?>" <?= $selected; ?>>
                <?= $ni['nit']; ?>
                        </option>
                    <?php } ?>
                </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="telbar"><strong>Teléfono</strong></label>
                    <input type="text" name="telbar" id="telbar" class="form-control" 
                        value="<?= isset($datOne[0]['telbar']) ? $datOne[0]['telbar'] : ''; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="dircbar"><strong>Dirección</strong></label>
                    <input type="text" name="dircbar" id="dircbar" class="form-control" 
                        value="<?= isset($datOne[0]['dircbar']) ? $datOne[0]['dircbar'] : ''; ?>" required>
                </div>
                <div class="form-group col-md-6">
    <label for="codubi"><strong>Seleccione la ciudad</strong></label>
    <select name="codubi" id="codubi" class="form-select">
        <option value="" disabled selected>Seleccionar</option> <!-- Opción inicial -->
        <?php
        $ubi = $mbar->getAll(); // Método que obtiene todas las ciudades
        foreach ($ubi as $ci) {
            // Verificar si la ciudad actual está seleccionada
            $selected = (isset($datOne[0]['depubi']) && $datOne[0]['depubi'] == $ci['depubi']) ? 'selected' : '';
        ?>
            <option value="<?=$ci['codubi'];?>" <?php if($datOne && $datOne[0]['depubi']==$ci['codubi']) echo "selected";?>><?=$ci['depubi'];?></option>
        <?php } ?>
    </select>
</div>


                <div class="form-group col-md-6">
                    <label for="pssbar"><strong>Contraseña del bar</strong></label>
                    <input type="text" name="pssbar" id="pssbar" class="form-control" 
                        value="<?= isset($datOne[0]['pssbar']) ? $datOne[0]['pssbar'] : ''; ?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="fotbar">Imagen Bar</label>
                    <input type="file" class="form-control" name="fots" accept="image/*" id="fotbar">
                    <input type="hidden" name="fotbar" 
                        value="<?= isset($datOne[0]['fotbar']) ? $datOne[0]['fotbar'] : ''; ?>">
                </div>
                <br><br>
            </div>
            <div class="form-group col-md-6" style="margin:auto;">
                <input class="btn btn-primary" type="submit" value="Enviar">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idbar" value="<?= isset($datOne[0]['idbar']) ? $datOne[0]['idbar'] : ''; ?>">
            </div>
        </form>
    </div>
</div>

<!-- Tabla de bares registrados -->
<table id="example" class="table table-striped" style="width:100%;">
    <thead>
        <tr>
            <th>Foto del bar</th>
            <th>Bares</th>
            <th>Nombre Propietario</th>
            <th>Teléfono</th>
            <th>NIT</th>
            <th>Dirección del bar</th>
            <th>Código de ubicación</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if($bars){ foreach ($bars as $bar) { ?>
        <tr>
            <td><?= $bar['fotbar']; ?></td>
            <td><?= $bar['nombar']; ?></td>
            <td><?= $bar['nompropi']; ?></td>
            <td><?= $bar['telbar']; ?></td>
            <td><?= $bar['nit']; ?></td>
            <td><?= $bar['dircbar']; ?></td>
            <td><?= $bar['codubi']; ?></td>
            <td style="text-align:center;">
                <a href="home.php?pg=<?= $pg; ?>&idbar=<?= $bar['idbar']; ?>&ope=edi" title="Editar">
                    <i class="fa-solid fa-pen-to-square fa"></i>
                </a>
                <a href="home.php?pg=<?= $pg; ?>&idbar=<?= $bar['idbar']; ?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                    <i class="fa-solid fa-trash-can fa"></i>
                </a>
            </td>
        </tr>
        <?php }} ?>
    </tbody>
</table>