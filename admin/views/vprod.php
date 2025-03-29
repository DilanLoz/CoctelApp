<?php
// licores.php
require_once 'admin/controllers/ccbarxprod.php';

?>


<br>
<br>
<div class="conte">

    <!-- Formulario para crear o editar un bar -->
    <div class="inser">
        <h1>Productos Bares</h1>
        <form action="home.php?pg=<?= $pg; ?>" method="POST" enctype="multipart/form-data">
            <!-- Aquí utilizamos un solo registro para editar o crear un bar -->
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="nomprod"><strong>Nombre producto</strong></label>
                    <input type="text"class="form-control" name="nomprod" id="nomprod" value="<?php if($datOne && $datOne[0]['nomprod']) echo $datOne[0]['nomprod'];?>" required>
                        
                </div>
                 <div class="form-group col-md-6">
                <label for="tipoprod"><strong>Tipo de Producto</strong></label>
                <select name="tipoprod" id="tipoprod" class="form-control" required>
                    <option value="licor" <?php echo (isset($datOne[0]['tipoprod']) && $datOne[0]['tipoprod'] == 'licor') ? 'selected' : ''; ?>>Licor</option>
                    <option value="vino" <?php echo (isset($datOne[0]['tipoprod']) && $datOne[0]['tipoprod'] == 'vino') ? 'selected' : ''; ?>>Vino</option>
                    <option value="coctel" <?php echo (isset($datOne[0]['tipoprod']) && $datOne[0]['tipoprod'] == 'coctel') ? 'selected' : ''; ?>>Coctel</option>
                </select>
            </div>
                <div class="form-group col-md-6">
                    <label for="vlrprod"><strong>Valor producto</strong></label>
                     <input type="text"class="form-control" name="vlrprod" id="vlrprod" value="<?php if($datOne && $datOne[0]['vlrprod']) echo $datOne[0]['vlrprod'];?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombar"><strong>Nombre de bar</strong></label>
                    <input type="text"class="form-control" name="nombar" id="nombar" value="<?php if($datOne && $datOne[0]['nombar']) echo $datOne[0]['nombar'];?>" required>
                </div>
            <div class="form-group col-md-6">
                <br>
                <input class="btn btn-primary" type="submit" value="Enviar">
                <input type="hidden" name="opera" value="save">
                <input type="hidden" name="idbar" id="idbar" value="<?php if($datOne && $datOne[0]['idbar']) echo $datOne[0]['idbar'];?>?>"
            </div>
        </form>
    </div>
    <figure class="highcharts-figure">
    <div id="container"></div>
    <p class="highcharts-description">
        Chart showing stacked columns for comparing quantities. Stacked charts
        are often used to visualize data that accumulates to a sum. This chart
        is showing data labels for each individual section of the stack.
    </p>
</figure>
</div>
<section class="shop container">
    <table id="example" class="table table-striped" width="100%" style="text-align: left;">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombre del Producto</th>
                <th>Tipo de Producto</th>
                <th>Precio</th>
                <th>Nombre del Bar</th>
                <th>Acciones</th> <!-- Columna para los botones -->
            </tr>
        </thead>
        <tbody>
            <?php if ($datAll) { 
                foreach ($datAll as $dta) {
                    // Mostrar productos de tipo 'licor', 'coctel' y 'vino'
                    if ($dta['tipoprod'] == 'licor' || $dta['tipoprod'] == 'coctel' || $dta['tipoprod'] == 'vino' ) { 
                        // Formatear el precio para agregar separadores de miles
                        $formattedPrice = number_format($dta['vlrprod'], 0, ',', '.'); // Sin decimales, separador de miles con punto
                        ?>
                        <tr>
                            <!-- Foto del Producto -->
                            <td>
                                <a href="index.php?pg=02">
                                    <img src="img/<?=$dta["fotprod"];?>" alt="<?=$dta['nomprod'];?>" width="120px" />
                                </a>
                            </td>
                            <!-- Nombre del Producto -->
                            <td><?=$dta['nomprod'];?></td>
                            <!-- Tipo de Producto -->
                            <td><?=$dta['tipoprod'];?></td>
                            <!-- Precio del Producto -->
                            <td>$<?=$formattedPrice;?></td>
                            <!-- Nombre del Bar -->
                            <td><?=$dta['nombar'];?></td>
                            <!-- Columna para las acciones -->
                            <td style="text-align:center;">
                                <!-- Botón de Editar -->
                                <a href="home.php?pg=<?=$pg;?>&idprod=<?=$dta['idprod'];?>&ope=edi" title="Editar"><i class="fa-solid fa-pen-to-square fa"></i>
                                                                    </a>
                                <!-- Botón de Eliminar -->
                                <a href="home.php?pg=<?=$pg;?>&idprod=<?=$dta['idprod'];?>&ope=eli" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este producto?');">
                                    <i class="fa-solid fa-trash-can fa"></i>
                                </a>
                            </td>
                        </tr>
            <?php 
                    }
                }
            } ?>
        </tbody>
    </table>
</section>
 