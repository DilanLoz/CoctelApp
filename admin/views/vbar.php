<?php require_once 'admin/controllers/cbar.php'; 
require_once 'admin/controllers/cubi.php';
?>

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
                    <label for="nit"><strong>NIT Del bar</strong></label>
                    <input type="text" name="nit" id="nit" class="form-control" 
                        value="<?= isset($datOne[0]['nit']) ? $datOne[0]['nit'] : ''; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="emabar"><strong>Email Del bar</strong></label>
                    <input type="text" name="emabar" id="emabar" class="form-control" 
                        value="<?= isset($datOne[0]['emabar']) ? $datOne[0]['emabar'] : ''; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="telbar"><strong>Teléfono</strong></label>
                    <input type="text" name="telbar" id="telbar" class="form-control" 
                        value="<?= isset($datOne[0]['telbar']) ? $datOne[0]['telbar'] : ''; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="pssbar"><strong>Contraseña del bar</strong></label>
                    <input type="text" name="pssbar" id="telbar" class="form-control" 
                        value="<?= isset($datOne[0]['pssbar']) ? $datOne[0]['pssbar'] : ''; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="dircbar"><strong>Dirección</strong></label>
                    <input type="text" name="dircbar" id="dircbar" class="form-control" 
                        value="<?= isset($datOne[0]['dircbar']) ? $datOne[0]['dircbar'] : ''; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="codubi"><b>Ubicacion</b></label>
                    <select name="codubi" id="codubi" class="form-control form-select" required>
                        <option value="" disabled selected>Seleccione una ciudad</option>
                        <?php if ($datAll) { 
                            foreach ($datAll as $dta) { ?>
                                <option value="<?=$dta['codubi'];?>" <?php if($datOne && $datOne[0]['codubi'] == $dta['codubi']) echo 'selected'; ?>>
                                    <?=$dta['nomubi'];?>
                                </option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="idval"><strong>Numero de valor</strong></label>
                    <select name="idval" id="idval" class="form-select">
                    <option value="" disabled selected></option> <!-- Opción inicial -->
                    <?php
                    $vals = $mbar->getAllVal(); // Método que obtiene todas las ciudades
                    foreach ($vals as $va) {
                        // Verificar si la ciudad actual está seleccionada
                        $selected = (isset($datOne[0]['idval']) && $datOne[0]['idval'] == $va['idval']) ? 'selected' : '';
                    ?>
                        <option value="<?= $va['idval']; ?>" <?= $selected; ?>>
                <?= $va['nomval']; ?>
                        </option>
                    <?php } ?>
                </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="fotbar"><strong>Imagen Bar</strong></label>
                    <input type="file" class="form-control" name="fots" accept="image/*" id="fotbar">
                    <input type="hidden" name="fotbar" 
                        value="<?= isset($datOne[0]['fotbar']) ? $datOne[0]['fotbar'] : ''; ?>">
                </div>
                <br>
                <br>
                <br>
            </div>
            <div class="form-group col-md-6">
                <br>
                <input class="btn btn-primary" type="submit" value="Enviar">
                <input type="hidden" name="opera" value="save">
                <input type="hidden" name="idbar" id="idbar" value="<?php echo isset($datOne[0]['idbar']) ? $datOne[0]['idbar'] : ''; ?>">
            </div>
        </form>
    </div>
</div>

<!-- Tabla de bares registrados -->
<table id="example" class="table table-striped" width="100%" style="text-align: left">
    <thead>
        <tr>
            <th>Foto</th>
            <th>NIT</th>
            <th>Nombre del bar</th>
            <th>Email</th>
            <th>Contraseña</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if($bars) { foreach ($bars as $bar) { ?>
        <tr>
            <!-- Foto del bar -->
            <td>
                <?php if (!empty($bar["fotbar"]) && file_exists("img/" . $bar["fotbar"])) { ?>
                    <img src="img/<?=$bar["fotbar"];?>" width="120px">
                <?php } else { ?>
                    <img src="img/coctelapp/bar1.jpg" width="120px">
                <?php } ?>
            </td>
            <!-- NIT -->
            <td><b>NIT: </b><?= $bar['nit']; ?><br>
                <b>Telefono: </b><?= $bar['telbar']; ?><br>
                <b>Nombre Propietario: </b><?= $bar['nompropi']; ?><br>
                <b>Horario: </b><?= $bar['horbar']; ?><br>
                <b>Direccion: </b><?= $bar['dircbar']; ?></td>
            <!-- Nombre del Bar -->
            <td><?= $bar['nombar']; ?></td>
            <!-- Email del Bar -->
            <td><?= $bar['emabar']; ?></td>
            <!-- Contraseña -->
            <td><?= $bar['pssbar']; ?></td>
            <!-- Acciones (Editar y Eliminar) -->
            <td>
                <a href="home.php?pg=<?=$pg;?>&idbar=<?=$bar['idbar'];?>&ope=edi" title="Editar">
                    <i class="fa-solid fa-pen-to-square fa"></i>
                </a>
                <a href="home.php?pg=<?=$pg;?>&idbar=<?=$bar['idbar'];?>&ope=del" title="Eliminar" onclick="return eliminar();">
                    <i class="fa-solid fa-trash-can fa"></i>
                </a>
            </td>
        </tr>
        <?php }} ?>
    </tbody>
</table>

