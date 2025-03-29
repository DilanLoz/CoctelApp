<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('controllers/cbarxprod.php'); ?>

<div class="container" style="text-align: left;">
    <br><br><br>
    <form id="frmins" action="home.php?pg=3003" enctype="multipart/form-data" method="POST">
    <div class="d-flex justify-content-end mt-4">
        <button class="btn btn-dark btn-md" onclick="window.location.href='home.php?pg=3030'"><i class="fa-solid fa-headset"></i>
        </button>
    </div>
        <h1><i class=""></i> Crear producto y Historial del producto</h1>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nomprod"><strong>Producto</strong></label>
                <input type="text" name="nomprod" id="nomprod" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['nomprod']) ? $datOne[0]['nomprod'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="vlrprod"><strong>Valor de producto</strong></label>
                <input type="number" name="vlrprod" id="vlrprod" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['vlrprod']) ? $datOne[0]['vlrprod'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="cantprod"><strong>Cantidad de producto</strong></label>
                <input type="number" name="cantprod" id="cantprod" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['cantprod']) ? $datOne[0]['cantprod'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="mililitros"><strong>Mililitros</strong></label>
                <input type="number" name="mililitros" id="mililitros" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne[0]['mililitros']) ? $datOne[0]['mililitros'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="tipoprod"><strong>Tipo de Producto</strong></label>
                <select name="tipoprod" id="tipoprod" class="form-control form-select" required>
                    <option value="licor" <?php echo (isset($datOne[0]['tipoprod']) && $datOne[0]['tipoprod'] == 'licor') ? 'selected' : ''; ?>>Licor</option>
                    <option value="vino" <?php echo (isset($datOne[0]['tipoprod']) && $datOne[0]['tipoprod'] == 'vino') ? 'selected' : ''; ?>>Vino</option>
                    <option value="coctel" <?php echo (isset($datOne[0]['tipoprod']) && $datOne[0]['tipoprod'] == 'coctel') ? 'selected' : ''; ?>>Coctel</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="fotprod">Foto Producto:</label>
                <input type="file" class="form-control form-control" name="fots" accept="image/*" id="fotprod">
                <input type="hidden" name="fotprod" value="<?php if ($dtOne && $dtOne[0]['fotprod']) echo $dtOne[0]['fotprod']; ?>">
            </div>
            <div class="form-group col-md-6">
                <label for="desprod"><strong>Descripción del Producto</strong></label>
                <textarea name="desprod" id="desprod" class="form-control" rows="3" required><?php echo isset($datOne[0]['desprod']) ? $datOne[0]['desprod'] : ''; ?></textarea>
            </div>
            <div class="form-group col-md-6">
                <br>
                <input class="btn btn-outline-warning shadow-sm" type="submit" value="Enviar">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idprod" id="idprod" value="<?php echo isset($datOne[0]['idprod']) ? $datOne[0]['idprod'] : ''; ?>">
            </div>
    </form>

    <br><br><br>
    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad en Stock</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($dattab) && !empty($dattab)) {
                foreach ($dattab as $dta) { ?>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center;">
                                <?php if (!empty($dta["fotprod"]) && file_exists("img/productos/" . $dta["fotprod"])) { ?>
                                    <img src="img/productos/<?= $dta["fotprod"]; ?>" width="120px" style="margin-right: 10px;">
                                <?php } else { ?>
                                    <img src="img/coctelapp/logo.png" width="120px" style="margin-right: 10px;">
                                <?php } ?>
                                <div>
                                    <strong><?= $dta['idprod']; ?> - <?= $dta['nomprod']; ?></strong><br>
                                    <small>
                                        <strong>Descripción: </strong><?= $dta['desprod']; ?><br>
                                        <strong>Mililitros: </strong><?= $dta['mililitros']; ?><br>
                                        <strong>Tipo de producto: </strong><?= $dta['tipoprod']; ?><br>
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td><?= $dta['cantprod']; ?><br></td>
                        <td><?= $dta['vlrprod']; ?><br></td>
                        <td style="text-align:center;">
                        <?php if ($dta['estado'] == 1) { ?>
                                <a href="home.php?pg=<?= $pg; ?>&idprod=<?= $dta['idprod']; ?>&ope=acti&estado=1" title="Estado del Producto Activado">
                                    <i class="fa fa-solid fa-circle-check fa-2x"></i>
                                </a>
                            <?php } else { ?>
                                <a href="home.php?pg=<?= $pg; ?>&idprod=<?= $dta['idprod']; ?>&ope=acti&estado=2" title="Estado del Producto Desactivado">
                                    <i class="fa fa-solid fa-circle-xmark fa-2x" style="color: #ff0000;"></i>
                                </a>
                            <?php } ?>

                            <a href="home.php?pg=<?= $pg; ?>&idprod=<?= $dta['idprod']; ?>&ope=edi" title="Editar" class="ms-3"> 
                                <i class="fa-solid fa-pen-to-square fa"></i>
                            </a>
                        </td>
                    </tr>
            <?php }
            } ?>
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
<script>
    function eliminar() {
        console.log("Intentando eliminar: " + window.location.href);
        return confirm("¿Estás seguro de que deseas eliminar este producto?");
    }
</script>