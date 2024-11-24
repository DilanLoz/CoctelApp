<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

 require_once ('controllers/cbarxprod.php'); ?>

<?php
// Iniciar sesión si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si hay una sesión activa y si contiene el ID del usuario
if (isset($_SESSION['idusu'])) {
    // Mostrar la ID de sesión y los datos almacenados en la sesión
    echo "<h3>Datos del Usuario en Sesión:</h3>";
    echo "ID de Usuario: " . $_SESSION['idusu'] . "<br>";
    echo "Nombre de Usuario: " . $_SESSION['nomusu'] . "<br>";
    echo "Email de Usuario: " . $_SESSION['emausu'] . "<br>";
    echo "Celular: " . $_SESSION['celusu'] . "<br>";
    echo "Número de Documento: " . $_SESSION['numdocu'] . "<br>";
    // Agrega más datos de la sesión si es necesario
} else {
    // Mensaje si no hay datos de sesión válidos
    echo "<h3>Datos inválidos: No se encontró una sesión activa.</h3>";
}
?>
<div class="container" style="text-align: left;">
    <br><br><br>
    <form id="frmins" action="home.php?pg=3003" enctype="multipart/form-data" method="POST">
        <h1><i class=""></i>  Crear producto y Historial del producto</h1>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nomprod"><strong>Producto</strong></label>
                <input type="text" name="nomprod" id="nomprod" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['nomprod']) ? $datOne[0]['nomprod'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="desprod"><strong>Descripcion producto</strong></label>
                <input type="text" name="desprod" id="desprod" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['desprod']) ? $datOne[0]['desprod'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="vlrprod"><strong>Valor de producto</strong></label>
                <input type="text" name="vlrprod" id="vlrprod" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['vlrprod']) ? $datOne[0]['vlrprod'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="cantprod"><strong>Cantidad de producto</strong></label>
                <input type="text" name="cantprod" id="cantprod" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['cantprod']) ? $datOne[0]['cantprod'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="tipoprod"><strong>Tipo de Producto</strong></label>
                <select name="tipoprod" id="tipoprod" class="form-control" required>
                    <option value="licor" <?php echo (isset($datOne[0]['tipoprod']) && $datOne[0]['tipoprod'] == 'licor') ? 'selected' : ''; ?>>Licor</option>
                    <option value="vino" <?php echo (isset($datOne[0]['tipoprod']) && $datOne[0]['tipoprod'] == 'vino') ? 'selected' : ''; ?>>Vino</option>
                    <option value="coctel" <?php echo (isset($datOne[0]['tipoprod']) && $datOne[0]['tipoprod'] == 'coctel') ? 'selected' : ''; ?>>Coctel</option>
                </select>
            </div>
            <div class="form-group col-md-6">
    <label for="idbar"><strong>Selecciona el ID de tu bar</strong></label>
    <select name="idbar" id="idbar" class="form-select" required>
        <option value="" disabled selected>Seleccionar</option> <!-- Opción inicial -->
        <?php
        $bars = $mbar->getAll(); // Método que obtiene todas las ciudades
        foreach ($bars as $idb) {
            // Determinar si la ciudad actual debe ser seleccionada
            $selected = (isset($datOne[0]['idbar']) && $datOne[0]['idbar'] == $idb['idbar']) ? 'selected' : '';
        ?>
            <option value="<?= $idb['idbar']; ?>" <?= $selected; ?>><?= $idb['idbar']; ?></option>
        <?php } ?>
    </select>
</div>

            <div class="form-group col-md-4">
                <label for="fotprod">Imagen</label>
                <input type="file" class="form-control form-control" name="fots" accept="image/*" id="fotprod">
                <input type="hidden" name="fotprod" value="<?php echo isset($datOne[0]['fotprod']) && !empty($datOne[0]['fotprod']) ? $datOne[0]['fotprod'] : ''; ?>">
            </div>
            <div class="form-group col-md-6">
                <br>
                <input class="btn btn-primary" type="submit" value="Enviar">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idprod" id="idprod" value="<?php echo isset($datOne[0]['idprod']) ? $datOne[0]['idprod'] : ''; ?>">
            </div>
        </form>

        <br>

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Acciones</th>
                </tr>
            </thead>    
            <tbody>
                <?php if (isset($datAll) && !empty($datAll)) { foreach ($datAll as $dta) { ?>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center;">
                            <?php if (!empty($dta["fotprod"]) && file_exists("img/" . $dta["fotprod"])) { ?>
                                <img src="img/<?=$dta["fotprod"];?>" width="120px" style="margin-right: 10px;">
                            <?php } else { ?>
                                <img src="img/coctelapp/logo.png" width="120px" style="margin-right: 10px;">
                            <?php } ?> 
                            <div>
                                <strong><?=$dta['idprod'];?> - <?=$dta['nomprod'];?></strong><br>
                                <small>
                                    <strong>Descripción: </strong><?=$dta['desprod'];?><br>
                                    <strong>Valor producto: </strong><?=$dta['vlrprod'];?><br>
                                    <strong>Cantidad Producto: </strong><?=$dta['cantprod'];?><br>
                                    <strong>ID del bar: </strong><?=$dta['idbar'];?><br>
                                    <strong>Tipo de producto: </strong><?=$dta['tipoprod'];?><br>
                                </small>
                            </div>
                        </div>
                    </td>
                    <td style="text-align:center;">
                        <a href="home.php?pg=<?=$pg;?>&idprod=<?=$dta['idprod'];?>&ope=edi" title="Editar">
                            <i class="fa-solid fa-pen-to-square fa"></i>
                        </a>
                        <a href="home.php?pg=<?=$pg;?>&idprod=<?=$dta['idprod'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                            <i class="fa-solid fa-trash-can fa"></i>
                        </a>
                    </td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
        <thead>
            <tr>
                <th>Producto</th>
                <th></th>
            </tr>
        </thead>
    </table>
</div>