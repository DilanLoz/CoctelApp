<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<?php require_once ('Controllers/cpemp.php');?>

<div id="perfil" class="container mt-5 mb-5" style="text-align: left;">
   <form action="" method="post" enctype="multipart/form-data">
        <div class="row">
            <h2 class="fw-bold mb-3"><i class="fa-solid fa-file-shield"></i> Datos personales</h2>
            <?php if (isset($datAllEmp) && !empty($datAllEmp)) { foreach ($datAllEmp as $dte) { ?>
            <div class="col-md-6">
                <div class="form-group col-md-12">
                    <label for="numdocu"><strong>No. De Identificación</strong></label>
                    <!-- Campo deshabilitado -->
                    <input type="text" name="numdocu" id="numdocu" class="form-control" value="<?=$dte['numdocu'];?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="nomemp"><strong>Nombres y apellidos</strong></label>
                    <input type="text" name="nomemp" id="nomemp" class="form-control" value="<?=$dte['nomemp'];?>">
                </div>
                <div class="form-group col-md-12">
                    <label for="fotiden"><strong>Foto del documento</strong></label>
                    <input type="file" class="form-control" name="fots" accept="image/*" id="fotiden">
                    <input type="hidden" name="fotiden_old" value="<?=$dte['fotiden'];?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group col-md-12">
                    <label for="nombar"><strong>Bar de contrato</strong></label>
                    <!-- Campo deshabilitado -->
                    <input type="text" name="nombar" id="nombar" class="form-control" value="<?=$dte['nombar'];?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="nomubi"><strong>Ubicación</strong></label>
                    <input type="text" name="nomubi" id="nomubi" class="form-control" value="<?=$dte['nomubi'];?>">
                </div>
                <div class="form-group col-md-12">
                    <label for="fecnaemp"><strong>Fecha de nacimiento</strong></label>
                    <input type="date" name="fecnaemp" id="fecnaemp" class="form-control" value="<?=$dte['fecnaemp'];?>" readonly>
                </div>
                <div class="form-group col-md-12">
                    <label for="pssemp"><strong>Contraseña</strong></label>
                    <input type="password" name="pssemp" id="pssemp" class="form-control" value="<?=$dte['pssemp'];?>">
                </div>
            </div>
            <?php }} ?>
        </div>
        <div class="form-group col-md-6">
                <br>
                <input class="btn btn-primary" type="submit" value="Enviar">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idprod" id="idprod" value="<?php echo isset($datOne[0]['idprod']) ? $datOne[0]['idprod'] : ''; ?>">
            </div>
    </form>
</div>
<script src="js/alertas.js"></script>
</div>