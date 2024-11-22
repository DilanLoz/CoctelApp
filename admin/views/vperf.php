<?php require_once ('admin/controllers/cpag.php'); ?>

<div class="conte mt-5" style="text-align: left;"> 
    <div class="inser">
        <form action="home.php?pg=<?=$pg;?>" method="POST" class="mb-5" >
            <div class="row">
                <h1>Perfil y Pagina</h1>
                <div class="form-group col-md-5">
                        <label for="nompag">Perfil</label>
                        <input type="text" name="nompag" id="nompag" maxlength="70" class="form-control" value="<?php if($datOne) echo $datOne[0]['nompag']; ?>" required>
                </div>
                <div class="form-group col-md-5">
                        <label for="rutpag">Pagina</label>
                        <input type="text" name="rutpag" id="rutpag" class="form-control" required value="<?php if($datOne) echo $datOne[0]['rutpag']; ?>">
                </div>
                <div class="form-group col-md-2" style="margin:auto; padding-top: 22px;">
                    <input class="btn btn-primary" type="submit" value="Enviar">
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
            <th>Página</th>
            <th>Mostrar</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if ($datAll) { foreach ($datAll AS $dta) { ?>       
            <tr>
                <td style="text-align: center; vertical-align: middle;"><i class="<?=$dta['icopag'];?>" style="font-size: 25px;"></i></td>
                <td>
                    <strong><?=$dta['idpag'];?> - <?=$dta['nompag'];?></strong><br>
                    <small>
                        <strong>Ruta: </strong><?=$dta['rutpag'];?><br><strong>Nombre del icono: </strong>
                        <?=$dta['icopag'];?>&nbsp;<br>
                        <?php if ($dta['despag']){?>
                            <br><strong>Descripción: </strong>
                            <?=$dta['despag'];?>
                        <?php }?>
                    </small>
                </td>
                <td>
                <?php if($dta['mospag']==1){ ?>
                        <a href="home.php?pg=<?=$pg;?>&idpag=<?=$dta['idpag'];?>&opera=acti&mospag=2">
                            <i class="fa fa-solid fa-circle-check fa-2x"></i>
                        </a>
                    <?php }else{ ?>
                        <a href="home.php?pg=<?=$pg;?>&idpag=<?=$dta['idpag'];?>&opera=acti&mospag=1">
                        <i class="fa fa-solid fa-circle-xmark fa-2x" style="color: #ff0000;"></i>
                        </a>
                    <?php } ?>
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
        <?php }} ?>      
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