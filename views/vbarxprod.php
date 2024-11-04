<?php require_once ('controllers/cbarxprod.php');?>

<div class="container mt-5 mb-5" style="text-align: left; display: block;">
    <h1><i class=""></i>  Crear producto y Historial del producto</h1>
        <form id="frmins" action="home.php?pg=<?=$pg;?>" method="POST">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nomprod">Producto</label>
                    <input type="text" name="nomprod" id="nomprod" class="form-control" cursive-label="Default select example"value="<?php if($datOne) echo $datOne[0]['nomprod']; else echo "Aguardiente"; ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="desprod">Descripcion producto</label>
                    <input type="text" name="desprod" id="desprod" class="form-control" cursive-label="Default select example"value="<?php if($datOne) echo $datOne[0]['desprod'];?>" required></div>
                <div class="form-group col-md-6">
                    <label for="vlrprod">Valor de producto</label>
                    <input type="text" name="vlrprod" id="vlrprod" class="form-control" cursive-label="Default select example"value="<?php if($datOne) echo $datOne[0]['vlrprod'];?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="cantprod"><strong>Cantidad de producto</strong></label>
                    <input type="text" name="cantprod" id="cantprod" class="form-control" cursive-label="Default select example"value="<?php if($datOne) echo $datOne[0]['cantprod'];?>" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="fotprod">Imagen</label>
                    <input type="file" class="form-control form-control" name="fots" accept="image/*" id="fotprod">
                    <input type="hidden" name="fotprod" value="<?php if(isset($datOne) && $datOne[0]['fotprod']) echo $datOne[0]['fotprod']; ?>">
                </div>
                <div class="form-group col-md-6">
            <br>
            <input class="btn btn-primary" type="submit" value="Enviar">
            <input type="hidden" name="ope" value="save">
            <input type="hidden" name="idprod" id="idprod" value="<?php if(isset($datOne) && !empty($datOne)) echo $datOne[0]['idprod']; ?>">
        </div>
        </form>
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php if (isset($datAll) && !empty($datAll)) { foreach ($datAll as $dta) { ?>
    <tr>
        <td>
            <?php 
            if (!empty($dta["fotprod"]) && file_exists("img/" . $dta["fotprod"])) { ?>
                <img src="img/<?=$dta["fotprod"];?>" width="120px"> 
            <?php } else { ?>
                <img src="img/logo.png" width="120px">
            <?php } ?>
            <strong><?=$dta['idprod'];?> - <?=$dta['nomprod'];?></strong><br>
            <small><small>
                <strong>Descripción: </strong><?=$dta['desprod'];?><br>
                <strong>Valor producto: </strong><?=$dta['vlrprod'];?><br>
                <strong>Cantidad Producto: </strong><?=$dta['cantprod'];?><br>
                <strong>Foto Producto: </strong><?=$dta['fotprod'];?>
            </small></small>
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

    <tfoot>
        <tr>
            <th>Producto</th>
            <th></th>
        </tr>
    </tfoot>
</table>
<nav aria-label="...">
    <ul class="pagination">
        <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item">
        <a class="page-link" href="#">Siguiente</a>
        </li>
    </ul>
</nav>
</div>