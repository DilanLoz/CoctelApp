<?php require_once ('admin/controllers/cpag.php'); 
?>

<div class="conte mt-5" style="text-align: left;"> 
    <div class="inser">
        <form action="home.php?pg=<?=$pg;?>" method="POST" >
            <div class="row">
                <h1>Paginas</h1>
                <!--<div class="form-group col-md-6">
                        <label for="idpag">Id de pagina</label>
                        <input type="numer" name="idpag" id="idpag" maxlength="70" class="form-control" value="<?php if($datOne) echo $datOne[0]['idpag']; ?>" required>
                </div>-->
                <div class="form-group col-md-6">
                        <label for="nompag">Nombre en menu</label>
                        <input type="text" name="nompag" id="nompag" maxlength="70" class="form-control" value="<?php if($datOne) echo $datOne[0]['nompag']; ?>" required>
                </div>
                <div class="form-group col-md-6">
                        <label for="rutpag">Ruta</label>
                        <input type="text" name="rutpag" id="rutpag" class="form-control" required value="<?php if($datOne) echo $datOne[0]['rutpag']; ?>">
                </div>
                <div class="form-group col-md-6">
                        <label for="mospag">Mostrar</label>
                        <select name="mospag" id="mospag" class="form-control">
                            <option value="1" <?php if ($datOne && $datOne[0]['mospag'] == 1) echo " selected "; ?>>Si</option>
                            <option value="2" <?php if ($datOne && $datOne[0]['mospag'] == 2) echo " selected "; ?>>No</option>
                        </select>
                </div>
                <div class="form-group col-md-6">
                        <label for="ordpag">Ordenar</label>
                        <input type="number" name="ordpag" id="ordpag" class="form-control" required value="<?php if($datOne) echo $datOne[0]['ordpag']; ?>">
                </div>
                <div class="form-group col-md-6">
                        <label for="titupag">Titulo en pagina</label>
                        <input type="text" name="titupag" id="titupag" class="form-control" required value="<?php if($datOne) echo $datOne[0]['titupag']; ?>">
                </div>
                <div class="form-group col-md-6">
                        <label for="icopag">Icono</label>
                        <input type="text" name="icopag" id="icopag" class="form-control" value="<?php if($datOne) echo $datOne[0]['icopag']; ?>">
                </div>
                <div class="form-group col-md-6">
                        <label for="despag">Descripción</label>
                        <textarea type="text" name="despag" id="despag" rows="3" class="form-control"><?php if($datOne) echo $datOne[0]['despag'];?></textarea>
                </div>
                <div class="form-group col-md-6" style="margin:auto; padding-top: 20px;">
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
                    <strong><?=$dta['idpag'];?> - <?=$dta['titupag'];?></strong><br>
                    <small>
                        <strong>Nombre en menu: </strong><?=$dta['nompag'];?>&nbsp;<br>
                        <strong>Ruta: </strong><?=$dta['rutpag'];?><br><strong>Nombre del icono: </strong>
                        <?=$dta['icopag'];?>&nbsp;
                        
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