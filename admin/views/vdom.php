<?php 
require_once ('admin/controllers/cdom.php');

?>

<br>
<br>
<div class="conte">
    <h1>Dominio</h1>
    <div class="inser">
        <form id="frmins" action="home.php?pg=<?=$pg;?>" method="POST">
            <div class="row">
                <div class="form-grup col-md-6">
                    <label for="nomdom">Nombre Dominio</label>
                    <input type="text" name="nomdom" id="nomdom" value="<?php if($datOne) echo $datOne[0]['nomdom'];?>" class="form-control" required >
                </div>
                <div class="form-group col-md-6">
                    <br>
                    <input class="btn btn-primary" type="submit" value="Enviar">
                    <input type="hidden" name="opera" value="save">
                    <input type="hidden" name="iddom" id="iddom" value="<?php if($datOne) echo $datOne[0]['iddom'];?>">
                </div>
            </div>
        </form>
    </div>
</div>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Dominio</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if($dat){
                foreach($dat AS $d){?>
                    <tr>
                        <td><?=$d['iddom'];?></td>
                        <td><?=$d['nomdom'];?></td>
                        <td style="text-align:right;">
                            <a href="home.php?pg=<?=$pg;?>&iddom=<?=$d['iddom'];?>&opera=edi" title="Editar">
                                <i class="fa-solid fa-pen-to-square fa-2x"></i>
                            </a>
                            <?php 
                                $cd = $mdom->getDxV($d['iddom']);
                                if($cd && $cd[0]['can']==0){
                            ?>
                            <a href="home.php?pg=<?=$pg;?>&iddom=<?=$d['iddom'];?>&opera=eli" title="Eliminar" onclick="return eliminar();">
                                <i class="fa-solid fa-trash-can fa-2x" ></i>
                            </a>
                            <?php } ?>
                        </td>
                    </tr>
            <?php }}?>
    </tbody>
    <tfoot>
    <tr>
            <th>Id</th>
            <th>Dominio</th>
            <th></th>
        </tr>
    </tfoot>
</table>