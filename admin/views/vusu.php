<?php require_once ('admin/controllers/cpag.php'); ?>

<div class="conte mt-5" style="text-align: left;"> 
    <div class="inser">
        <form action="home.php?pg=<?=$pg;?>" method="POST" >
            <div class="row">
                <h1>Usuarios</h1>
                <div class="form-group col-md-6 mb-2">
                    <label for="nombres" class="form-label" style="text-align: left; display: block;">Nombres y apellidos:</label>
                    <input type="text" class="form-control" name="nomusu" id="nomusu" value="" required>
                </div>
                <div class="form-group col-md-6 mb-2">
                    <label for="correo" class="form-label" style="text-align: left; display: block;">Correo electrónico:</label>
                    <input type="email" class="form-control" name="emausu" id="emausu" value="" required>
                </div>
                
                <div class="form-group col-md-6 mb-2">
                    <label for="celusu" class="form-label" style="text-align: left; display: block;">Celular:</label>
                    <input type="text" class="form-control" name="celusu" id="celusu" value="">
                </div>
                <div class="form-group col-md-6 mb-2">
                    <label for="fotiden" class="form-label" style="text-align: left; display: block;">Foto de Identificación:</label>
                    <input type="file" class="form-control" name="fotiden" id="fotiden">
                </div>
                <div class="form-group col-md-6 mb-2">
                    <label for="identificacion" class="form-label" style="text-align: left; display: block;">No. de Identificacion:</label>
                    <input type="text" class="form-control" name="numdocu" id="numdocu" value="" required>
                </div>
                <div class="form-group col-md-6 mb-2">
                    <label for="fecha_nacimiento" class="form-label" style="text-align: left; display: block;">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" name="fecnausu" id="fecnausu" value="" required>
                </div>
                <div class="form-group col-md-6 mb-2">
                        <label for="despag">Contraseña</label>
                        <input type="password" class="form-control" name="passusu" id="passusu" value="" required>
                </div>
                <!-- <div class="form-group col-md-6">
                        <label for="despag">Ubicación</label>
                        <textarea name="despag" id="despag" rows="3" class="form-control"><?php if($datOne) echo $datOne[0]['despag'];?></textarea>
                </div> -->
                <div class="form-group col-md-6 mb-2">
                        <label for="mospag">Tipo de documento</label>
                        <select name="mospag" id="mospag" class="form-control">
                            <option value="1"></option>
                            <option value="2"></option>
                            <option value="3"></option>
                        </select>
                </div>
                <div class="form-group col-md-6" style="margin:auto">
                    <input class="btn btn-warning" type="submit" value="Enviar">
                    <input type="hidden" name="opera" value="save">
                    <input type="hidden" name="idpag" id="idpag" value="<?php if($datOne) echo $datOne[0]['idpag'];?>">
                </div>
            </div>
        </form>
    </div>
</div>

<table id="example" class="table table-striped" style="width:100%; text-align: left;">
    <thead>
        <tr>  
            <th>Icono</th>
            <th>Usuarios</th>
            <th>Administrar</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td style="text-align: center; vertical-align: middle;"></td>
                <td>
                    <strong>Usuario</strong><br>
                    <small>
                        <strong>Numero de documento: </strong>
                        <br>
                        <strong>Nombre: </strong>
                        <br>
                        <strong>Correo: </strong>
                        <br>
                        <strong>Celular: </strong>
                    </small>
                </td>                
                <td style="text-align:right;">
                <a href="home.php?pg=<?=$pg;?>&idpag=<?=$dta['idpag'];?>&opera=edi" title="Editar">
                        <i class="fa-solid fa-pen-to-square fa-2x"></i>
                </a>
                <a href="home.php?pg=<?=$pg;?>&idpag=<?=$dta['idpag'];?>&opera=eli" title="Eliminar" onclick="return eliminar();">
                        <i class="fa-solid fa-trash-can fa-2x"></i>
                </a>
                </td>
            </tr>      
    </tbody>
    <tfoot>
        <tr>
            <th>Icono</th>
            <th>Página</th>
            <th>Mostrar</th>
            
            <th></th>
        </tr>
    </tfoot>
</table>