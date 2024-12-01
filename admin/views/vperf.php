<?php require_once ('admin/controllers/cperf.php'); ?>

<div class="conte mt-5" style="text-align: left;"> 
    <div class="inser">
        <form id="frmins" action="home.php?pg=<?= $pg; ?>" method="POST">
            <div class="row" style="margin-bottom: 50px">
                <div class="form-group col-md-6">
                    <label for="nomper">Nombre de perfil</label>
                    <input type="text" name="nomper" id="nomper" class="form-control" required value="<?php if ($datOne) echo $datOne[0]['nomper']; ?> ">
                </div>
                <div class="form-group col-md-6">
                    <label for="idpag">Pagina Inicial</label>
                    <select name="idpag" id="idpag" class="form-control form-select">
                        <?php
                        if ($datpag) {
                            foreach ($datpag  as $dt) { ?>
                                <option value="<?= $dt['idpag']; ?>" <?php
                                    if ($datOne && $datOne[0]['idpag'] == $dt['idpag']) echo " selected "; ?>><?= $dt['titupag']; ?></option>
                        <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <br>
                    <input type="submit" class="btn btn-primary" value="Registrar">
                    <input type="hidden" name="opera" value="save">
                    <input type="hidden" name="idper" value="<?php if ($datOne) echo $datOne[0]['idper']; ?>">
                </div>
            </div>
        </form>
    </div>
</div>

<table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Perfil</th>     
                <th>Paginas</th>
                <th></th>          
                <!-- botones pdf -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($dat) {
                foreach ($dat as $d) {
            ?>
                    <tr>
                        <td>
                            <strong><?= $d['idper'] . " - " . $d['nomper']; ?></strong>
                            <br>
                            <small>
                                <strong>Página: </strong><?= $d['titupag']; ?>
                            </small>

                        </td>
                        <td style="text-align:right;">
                            <a href="#"  title="Ver Páginas" data-bs-toggle="modal" data-bs-target="#myModal<?= $d['idper']; ?>">
                                <i class="fa-solid fa-clipboard-check fa-2x"></i>
                            </a>
                            
                            <?php                             
                            $dps = $mper->getPxP();                           
                            modal($d['idper'], $d['nomper'], $dtm, $pg, $smd); ?>
                            <a href="home.php?pg=<?=$pg;?>&idper=<?=$d['idper'];?>&opera=edi" title="Editar">
                                <i class="fa-solid fa-pen-to-square fa-2x"></i>
                            </a>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Perfil</th>        
                <th></th>        
            </tr>
        </tfoot>
    </table>
    