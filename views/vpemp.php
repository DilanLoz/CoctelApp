<?php require_once('controllers/cpusu.php');
require_once('admin/controllers/cubi.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<div id="perfil" class="container mt-5 mb-5" style="text-align: left;">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <h2 class="fw-bold mb-3"><i class="fa-solid fa-file-shield"></i> Datos personales</h2>
            <!-- Columna izquierda -->
            <div class="col-md-6">
                <div class="form-group col-md-12">
                    <label for="numdocu"><strong>No. De Identificación</strong></label>
                    <input type="text" name="numdocu" id="numdocu" class="form-control" value="<?=$_SESSION['numdocu'];?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="nomusu"><strong>Nombres y apellidos</strong></label>
                    <input type="text" name="nomusu" id="nomusu" class="form-control" value="<?=$_SESSION['nomusu'];?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="nomserv"><strong>Servicio</strong></label>
                    <input type="text" name="nomserv" id="nomserv" class="form-control" value="<?php echo isset($_SESSION['nomserv']) ? $_SESSION['nomserv'] : ''; ?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="fotiden"><strong>Foto del documento</strong></label>
                    <input type="file" class="form-control" name="fotiden_file" accept="image/*" id="fotiden_file">
                    <input type="hidden" name="fotiden" id="fotiden" value="<?php echo isset($_SESSION['fotiden']) ? $_SESSION['fotiden'] : ''; ?>">
                </div>
            </div>

            <!-- Columna derecha -->
            <div class="col-md-6">
                <div class="form-group col-md-12">
                    <label for="nombar"><strong>Bar de contrato</strong></label>
                    <input type="text" name="nombar" id="nombar" class="form-control" value="<?php echo isset($_SESSION['nombar']) ? $_SESSION['nombar'] : ''; ?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="codubi">Ubicacion</label>
                    <select name="codubi" id="codubi" class="form-control form-select" required>
                        <option value="" disabled selected>Seleccione una ciudad</option>
                        <?php if ($dataAll) { 
                            foreach ($dataAll as $dta) { ?>
                                <option value="<?=$dta['codubi'];?>" <?php if($datOne && $datOne[0]['codubi'] == $dta['codubi']) echo 'selected'; ?>>
                                    <?=$dta['nomubi'];?>
                                </option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="fecnausu"><strong>Fecha de nacimiento</strong></label>
                    <input type="text" name="fecnausu" id="fecnausu" class="form-control" value="<?php echo isset($_SESSION['fecnausu']) ? $_SESSION['fecnausu'] : ''; ?>">
                </div>
                <div class="form-group col-md-12">
                    <label for="pssusu"><strong>Contraseña</strong></label>
                    <input type="password" name="pssusu" id="pssusu" class="form-control" value="<?php echo isset($_SESSION['pssusu']) ? $_SESSION['pssusu'] : ''; ?>">
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="form-group col-md-6 mt-3">
            <input class="btn btn-primary" type="submit" value="Enviar">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idusu" id="idusu" value="<?php echo isset($datOne[0]['idusu']) ? $datOne[0]['idusu'] : ''; ?>">
        </div>
    </form>
</div>

<script src="js/alertas.js"></script>