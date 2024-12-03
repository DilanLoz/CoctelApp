<?php require_once ('controllers/cbarxprod.php'); ?>

        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID Pedido</th>
                    <th>Fecha y Hora del Pedido</th>
                    <th>Estado</th>
                </tr>
            </thead>    
            <tbody>
                <?php if (isset($datAll) && !empty($datAll)) { foreach ($datAll as $dta) { ?>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center;">
                            <?php if (!empty($dta["fotprod"]) && file_exists("img/" . $dta["fotprod"])) { ?>
                                <img src="img/<?=$dta["fotprod"];?>" width="120px" style="margin-right: 10px;">
                            <?php } else { ?>
                                <img src="img/coctelapp/logo.png" width="120px" style="margin-right: 10px;">
                            <?php } ?> 
                            <div>
                                <strong><?=$dta['idprod'];?> - <?=$dta['nomprod'];?></strong><br>
                                <small>
                                    <strong>Descripción: </strong><?=$dta['desprod'];?><br>
                                    <strong>Valor producto: </strong><?=$dta['vlrprod'];?><br>
                                    <strong>Cantidad Producto: </strong><?=$dta['cantprod'];?><br>
                                    <strong>ID del bar: </strong><?=$dta['idbar'];?><br>
                                    <strong>Tipo de producto: </strong><?=$dta['tipoprod'];?><br>
                                </small>
                            </div>
                        </div>
                    </td>
                    <td style="text-align:center;">
                        <a href="home.php?pg=<?=$pg;?>&idprod=<?=$dta['idprod'];?>&ope=edi" title="Editar">
                            <i class="fa-solid fa-pen-to-square fa"></i>
                        </a>
                        <a href="home.php?pg=<?=$pg;?>&idprod=<?=$dta['idprod'];?>&ope=eli" title="Eliminar" onclick="return eliminar();">
                            <i class="fa-solid fa-trash-can fa"></i>
                        </a>
                    </td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Pedido</th>
                <th>Fecha y Hora del Pedido</th>
                <th>Estado</th>
            </tr>
        </thead>
    </table>
</div>