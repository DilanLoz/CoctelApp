<?php require_once ('admin/controllers/cusu.php');
include ('admin/controllers/cubi.php');
?>
// require_once ('controllers/cval.php');?>

<div class="conte mt-5" style="text-align: left;"> 
    <div class="inser">
        <form action="home.php?pg=<?=$pg;?>" method="POST" >
            <div class="row">
                <h1>Usuarios</h1>
                <div class="form-group col-md-6 mb-2">
                    <label for="nombres" class="form-label" style="text-align: left; display: block;">Nombres y apellidos:</label>
                    <input type="text" class="form-control" name="nomusu" id="nomusu" value="<?php if($datOne) echo $datOne[0]['nomusu']; ?>" required>
                </div>
                <div class="form-group col-md-6 mb-2">
                    <label for="correo" class="form-label" style="text-align: left; display: block;">Correo electrónico:</label>
                    <input type="email" class="form-control" name="emausu" id="emausu" value="<?php if($datOne) echo $datOne[0]['emausu']; ?>" required>
                </div>
                
                <div class="form-group col-md-6 mb-2">
                    <label for="celusu" class="form-label" style="text-align: left; display: block;">Celular:</label>
                    <input type="text" class="form-control" name="celusu" id="celusu" value="<?php if($datOne) echo $datOne[0]['emausu']; ?>">
                </div>
                <div class="form-group col-md-6 mb-2">
                <label for="numdocu" class="form-label" style="text-align: left; display: block;">Numero de Identificación:</label>
                <input type="text" class="form-control" name="numdocu" id="numdocu" value="<?php if($datOne) echo $datOne[0]['numdocu']; ?>">
                </div>
                    <div class="form-group col-md-6 mb-2">
                    <div class="form-group col-md-12">
                    <label for="imgpro">Foto de Identificación:</label>
                    <input type="file" class="form-control form-control" name="fots" accept="image/*" id="fotiden">
                    <input type="hidden" name="fotiden" value="<?php if($datOne) echo $datOne[0]['fotiden']; ?>">
                </div>
                </div>
                <div class="form-group col-md-6 mb-2">
                    <label for="fecha_nacimiento" class="form-label" style="text-align: left; display: block;">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" name="fecnausu" id="fecnausu" value="<?php if($datOne) echo $datOne[0]['fecnausu']; ?>" required>
                </div>
                <div class="form-group col-md-6 mb-2">
                        <label for="despag">Contraseña</label>
                        <input type="password" class="form-control" name="passusu" id="passusu" value="<?php if($datOne) echo $datOne[0]['passusu']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="codubi">Ubicacion</label>
                    <select name="codubi" id="codubi" class="form-control" required>
                        <option value="" disabled selected>Seleccione una ciudad</option>
                        <?php if ($datAl) { 
                            foreach ($datAl as $dta) { ?>
                                <option value="<?=$dta['codubi'];?>" <?php if($datOne && $datOne[0]['codubi'] == $dta['codubi']) echo 'selected'; ?>>
                                    <?=$dta['nomubi'];?>
                                </option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <!-- <div class="form-group col-md-6 mb-2">
                        <label for="idval">Tipo de documento</label>
                        <select name="idval" id="idval" class="form-control">
                            <option value="1"></option>
                            <option value="2"></option>
                            <option value="3"></option>
                        </select>
                </div> -->
                <div class="form-group col-md-6" style="margin:auto">
                    <input class="btn btn-warning" type="submit" value="Enviar">
                    <input type="hidden" name="opera" value="save">
                    <input type="hidden" name="idusu" id="idusu" value="<?php if($datOne) echo $datOne[0]['idusu'];?>">
                </div>
            </div>
        </form>
    </div>
</div>

<table id="example" class="table table-striped" style="width:100%; text-align: left;">
    <thead>
        <tr>  
            <th></th>
            <th>Usuarios</th>
            <th>Administrar</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) { foreach ($datAll AS $dta) { ?>  
            <tr>
                <td style="text-align: center; vertical-align: middle;"></td>
                <td>
                    <strong>Usuario</strong><br>
                    <small>
                        <strong>Numero de documento: </strong><?=$dta['numdocu'];?>
                        <br>
                        <strong>Nombre: </strong><?=$dta['nomusu'];?>
                        <br>
                        <strong>Ubicacion: </strong><?=$dta['nomusu'];?>
                        <br>
                        <strong>Correo: </strong><?=$dta['emausu'];?>
                        <br>
                        <strong>Celular: </strong><?=$dta['celusu'];?>
                    </small>
                </td>                
                <td style="text-align:right;">
                <a href="home.php?pg=<?=$pg;?>&idusu=<?=$dta['idusu'];?>&opera=edi" title="Editar">
                        <i class="fa-solid fa-pen-to-square fa-2x"></i>
                </a>
                <a href="home.php?pg=<?=$pg;?>&idusu=<?=$dta['idusu'];?>&opera=eli" title="Eliminar" onclick="return eliminar();">
                        <i class="fa-solid fa-trash-can fa-2x"></i>
                </a>
                </td>
            </tr>
        <?php }} ?>     
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>Usuarios</th>
            <th>Administrar</th>
        </tr>
    </tfoot>
</table>