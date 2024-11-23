<?php require_once 'admin/controllers/cbar.php'; ?>

<br>
<br>
<br>

<!-- Título -->
<div class="conte">
    <h1><i class="fa-solid fa-wine-bottle"></i> Bares</h1>

    <!-- Formulario para crear o editar un bar -->
    <div class="inser">
        <form  action="home.php?pg=<?=$pg;?>" method="POST" enctype="multipart/form-data">
            <div class="row">
				<div class="form-group col-md-6">
                <label for="idbar"><strong>ID del bar</strong></label>
                <input type="text" name="idbar" id="idbar" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['idbar']) ? $datOne[0]['idbar'] : ''; ?>" required>
            	</div>
                <div class="form-group col-md-6">
                <label for="nombar"><strong>Nombre del bar</strong></label>
                <input type="text" name="nombar" id="nombar" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['nombar']) ? $datOne[0]['nombar'] : ''; ?>" required>
            	</div>
            	<div class="form-group col-md-6">
                <label for="nompropi"><strong>Nombre del propietario</strong></label>
                <input type="text" name="nompropi" id="nompropi" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['nompropi']) ? $datOne[0]['nompropi'] : ''; ?>" required>
            	</div>
                <div class="form-group col-md-6">
                <label for="nit"><strong>NIT</strong></label>
                <input type="text" name="nit" id="nit" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['nit']) ? $datOne[0]['nit'] : ''; ?>" required>
            	</div>
                <div class="form-group col-md-6">
                <label for="telbar"><strong>Telefono</strong></label>
                <input type="text" name="telbar" id="telbar" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['telbar']) ? $datOne[0]['telbar'] : ''; ?>" required>
            	</div>
                <div class="form-group col-md-6">
                <label for="dircbar"><strong>Direccion</strong></label>
                <input type="text" name="dircbar" id="dircbar" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['dircbar']) ? $datOne[0]['dircbar'] : ''; ?>" required>
            	</div>
                <div class="form-group col-md-6">
                <label for="codubi"><strong>Seleccione la ciudad</strong></label>
                <select class="form-select form-select" name="codubi" id="codubi" onchange="reloadMun(this.value)">
                <?php if ($dep){foreach ($dep as $dp) { ?>
                    <option value="<?=$dp['codubi'];?>" <?php if($datOne && $datOne[0]==$dp['codubi']) echo "selected";?>><?=$dp['nomubi'];?></option>
                <?php }}?>
            </select>
                
            </div>
                <div class="form-group col-md-6">
                <label for="codubi"><strong>ID del valor</strong></label>
                <select name="codubi" id="codubi" class="form-control" required>
                    <option value="Bogota" <?php echo (isset($datOne[0]['codubi']) && $datOne[0]['codubi'] == 'Bogota') ? 'selected' : ''; ?>><?$datOne[0]['nomubi']?></option>
                </select>
            </div>
                <div class="form-group col-md-6">
                <label for="pssbar"><strong>Contraseña del bar</strong></label>
                <input type="text" name="pssbar" id="pssbar" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['pssbar']) ? $datOne[0]['pssbar'] : ''; ?>" required>
            	</div>
                 <div class="form-group col-md-4">
                	<label for="fotbar">Imagen Bar</label>
                	<input type="file" class="form-control form-control" name="fots" accept="image/*" id="fotbar">
                	<input type="hidden" name="fotbar" value="<?php echo isset($datOne[0]['fotbar']) && !empty($datOne[0]['fotbar']) ? $datOne[0]['fotbar'] : ''; 	?>">
            	</div>
                <br>
                <br>
            </div>
            <br>
            <div class="form-group col-md-6" style="margin:auto;">
                <input class="btn btn-primary" type="submit" value="Enviar">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idbar" id="idbar" value="<?php if($datOne) echo $datOne[0]['idbar'];?>">
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
            <th>Direccion del bar</th>
            <th>Codigo de ubicacion</th>
            <th></th> <!-- Columna extra para las acciones -->
        </tr>
    </thead>
    <tbody>
        <?php
        $bars = $mbar->select(); // Método que obtiene todos los bares
        foreach ($bars as $bar) {
        ?>
        <tr>
            <td><?=$bar['fotbar'];?></td>
            <td><?=$bar['nombar'];?></td>
            <td><?=$bar['nompropi'];?></td>
            <td><?=$bar['telbar'];?></td>
            <td><?=$bar['nit'];?></td>
            <td><?=$bar['dircbar'];?></td>
            <td><?=$bar['codubi'];?></td>
            <td style="text-align:center;"> <!-- Columna para las acciones -->
                <a href="home.php?pg=<?=$pg;?>&idbar=<?=$bar['idbar'];?>&ope=edi" title="Editar">
                     <i class="fa-solid fa-pen-to-square fa"></i>
                </a>
                <a href="home.php?pg=<?=$pg;?>&idbar=<?=$bar['idbar'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                     <i class="fa-solid fa-trash-can fa"></i>
                </a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Foto del bar</th>
            <th>Bares</th>
            <th>Nombre Propietario</th>
            <th>Teléfono</th>
            <th>NIT</th>
            <th>Direccion del bar</th>
            <th>Codigo de ubicacion</th>
            <th></th> <!-- Columna extra para las acciones -->
        </tr>
    </tfoot>
</table>