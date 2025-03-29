<?php require_once ('admin/controllers/cubi.php'); ?>

<div class="conte mt-5" style="text-align: left;"> 
    <div class="inser">
        <form action="home.php?pg=<?=$pg;?>" method="POST" >
            <div class="row">
                <h1>Ubicacion</h1>
                <div class="form-group col-md-6">
                        <label for="codubi">Codigo postal</label>
                            <i class="fa-solid fa-info-circle fa-lg text-danger" id="infoCodubi" 
                            data-bs-toggle="tooltip" title="El codigo postal no se puede EDITAR e ELIMINAR solo CREAR." onclick="showInfoMessage()"></i>
                        <input type="number" name="codubi" id="codubi" maxlength="70" class="form-control" value="<?php if($datOne) echo $datOne[0]['codubi']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                        <label for="nomubi">Nombre de la ciudad</label>
                        <input type="text" name="nomubi" id="nomubi" class="form-control" required value="<?php if($datOne) echo $datOne[0]['nomubi']; ?>">
                </div>
                <div class="form-group col-md-6">
                        <label for="depubi">Nombre del departamento</label>
                        <input type="text" name="depubi" id="depubi" class="form-control" required value="<?php if($datOne) echo $datOne[0]['depubi']; ?>">
                </div>
                <div class="form-group col-md-6" style="margin:auto; padding-top: 20px;">
                    <input class="btn btn-warning" type="submit" value="Enviar">
                    <input type="hidden" name="opera" value="save">
                    <input type="hidden" name="codubi" id="codubi" value="<?php if($datOne) echo $datOne[0]['codubi'];?>">
                </div>
            </div>
        </form>
    </div>
</div>

<table id="example" class="table table-striped" style="width:100%; text-align: left;">
    <thead>
        <tr>  
            <th>No. Postal</th>
            <th>Ciudad</th>
            <th>Departamento</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($dataAll) { foreach ($dataAll AS $dta) { ?>       
            <tr>
                <td><?=$dta['codubi'];?></td>
                <td><?=$dta['nomubi'];?></td>
                <td><?=$dta['depubi'];?></td>
                <td style="text-align:right;">
                <a href="home.php?pg=<?=$pg;?>&codubi=<?=$dta['codubi'];?>&opera=edi" title="Editar">
                        <i class="fa-solid fa-pen-to-square fa-2x"></i>
                </a>
                <a href="home.php?pg=<?=$pg;?>&codubi=<?=$dta['codubi'];?>&opera=eli" title="Eliminar" onclick="return eliminar();">
                        <i class="fa-solid fa-trash-can fa-2x"></i>
                </a>
                </td>
            </tr>
        <?php }} ?>      
    </tbody>
    <tfoot>
        <tr>
            <th>No. Postal</th>
            <th>Ciudad</th>
            <th>Departamento</th>
            <th></th>
        </tr>
    </tfoot>
</table>
<script>
    function showInfoMessage() {
        alert("El codigo postal no se puede EDITAR e ELIMINAR solo CREAR.");
    }
    // Inicializar todos los tooltips en la página
    document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
