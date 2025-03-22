<?php
include_once("controllers/cbarxem.php");
include_once('admin/controllers/cubi.php');
include_once('admin/controllers/cval.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['idusu']) && isset($_GET['ope']) && $_GET['ope'] == 'edi') {
    $idusu = $_GET['idusu'];
    $objModelo = new Mbarxem(); // Reemplaza 'TuModelo' con el nombre real de tu clase modelo
    $datOne = $objModelo->getOne($idusu); // Obtener los datos del usuario específico
}
?>

<div class="container" style="text-align: left;">
    <br><br><br>
    <form id="frmins" action="home.php?pg=3004" enctype="multipart/form-data" method="POST">
        <h1><i class=""></i>Crear Empleado</h1>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nomusu"><strong>Nombre del empleado:</strong></label>
                <input type="text" name="nomusu" id="nomusu" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne['nomusu']) ? $datOne['nomusu'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="emausu"><strong>Email empleado:</strong></label>
                <input type="text" name="emausu" id="emausu" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne['emausu']) ? $datOne['emausu'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="numdocu"><strong>No. de identificación:</strong></label>
                <input type="number" name="numdocu" id="numdocu" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne['numdocu']) ? $datOne['numdocu'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="idval">Tipo de documento:</label>
                <select id="idval" name="idval" class="form-control">
                    <option value="" disabled selected>Seleccione</option>
                    <?php
                    if (!empty($datDoc)) {
                        foreach ($datDoc as $valor) {
                            $selected = isset($datOne['idval']) && $datOne['idval'] == $valor['idval'] ? 'selected' : '';
                            echo "<option value='{$valor['idval']}' $selected>{$valor['nomval']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="pssusu"><strong>Contraseña:</strong></label>
                <input type="password" name="pssusu" id="pssusu" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne['pssusu']) ? $datOne['pssusu'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="codubi">Ubicación Actual:</label>
                <select id="codubi" name="codubi" class="form-control">
                <option value="" disabled selected>Seleccione una ciudad</option>
                    <?php
                    if (!empty($dataAll)) {
                        foreach ($dataAll as $ubicacion) {
                            $selected = isset($datOne['codubi']) && $datOne['codubi'] == $ubicacion['codubi'] ? 'selected' : '';
                            echo "<option value='{$ubicacion['codubi']}' $selected>{$ubicacion['nomubi']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>


            <div class="form-group col-md-6">
                <label for="fecnausu"><strong>Fecha de nacimiento:</strong></label>
                <input type="date" name="fecnausu" id="fecnausu" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne['fecnausu']) ? $datOne['fecnausu'] : ''; ?>" required>
            </div>

            <div class="form-group col-md-6">
                <label for="celusu"><strong>Teléfono:</strong></label>
                <input type="number" name="celusu" id="celusu" class="form-control" cursive-label="Default select example" value="<?php echo isset($datOne['celusu']) ? $datOne['celusu'] : ''; ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="fotiden">Foto del empleado:</label>
                <input type="file" class="form-control form-control" name="fots" accept="image/*" id="fotiden">
                <input type="hidden" name="fotiden" value="<?php if($dtOne && $dtOne['fotiden']) echo $dtOne['fotiden']; ?>">
            </div>

            <div class="form-group col-md-6">
                <br>
                <input class="btn btn-outline-warning shadow-sm" type="submit" value="Enviar">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idusu" id="idusu" value="<?php echo isset($datOne['idusu']) ? $datOne['idusu'] : ''; ?>">
            </div>
        </form>

        <br><br><br>
        <table id="example" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>foto</th>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>No. Documento</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Bar Asignado</th>
                    <th>Ubicacion</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Acciones</th>
                </tr>
            </thead>    
            <tbody>
                <?php if (isset($dattab) && !empty($dattab)) { foreach ($dattab as $dtb) { ?>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center;">
                            <?php if (!empty($dtb["fotiden"]) && file_exists("img/" . $dtb["fotiden"])) { ?>
                                <img src="img/<?=$dtb["fotiden"];?>" width="120px" style="margin-right: 10px;">
                            <?php } else { ?>
                                <img src="img/coctelapp/logo.png" width="120px" style="margin-right: 10px;">
                            <?php } ?> 
                            <td><?=$dtb["idusu"];?> </td>
                            <td><?=$dtb["nomusu"];?></td>
                            <td>
                                <div>
                                    <small>
                                        <strong>Tipo: </strong><?=$dtb["nomval"];?><br> <!--Hay que llamar a nomval, para mostrar si es CC o NIT -->
                                        <strong>Numero: </strong><?=$dtb["numdocu"];?><br>
                                    </small>
                                </div>
                            </td>
                            <td>-<?=$dtb["fecnausu"];?></td>
                            <td><?=$dtb["nombar"];?></td>
                            <td><?=$dtb["nomubi"];?></td>
                            <td><?=$dtb["emausu"];?></td>
                            <td><?=$dtb["celusu"];?></td>
                        </div>
                    </td>
                    <td>
                        <?php if($dtb['estado']==1){ ?>
                                <a href="home.php?pg=<?=$pg;?>&idusu=<?=$dtb['idusu'];?>&ope=acti&estado=2">
                                    <i class="fa fa-solid fa-circle-check fa-2x"></i>
                                </a>
                            <?php }else{ ?>
                                <a href="home.php?pg=<?=$pg;?>&idusu=<?=$dtb['idusu'];?>&ope=acti&estado=1">
                                <i class="fa fa-solid fa-circle-xmark fa-2x" style="color: #ff0000;"></i>
                                </a>
                            <?php } ?>
                            <a href="home.php?pg=<?=$pg;?>&idusu=<?=$dtb['idusu'];?>&ope=edi" title="Editar" class="ms-3">
                            <i class="fa-solid fa-pen-to-square fa"></i>
                        </a>
                    </td>
                </tr>
                <?php }} ?>
            </tbody>

            <tfoot>
            <tr>
                <th>foto</th>
                <th>Id</th>
                <th>Nombre</th>
                <th>No. Documento</th>
                <th>Fecha de Nacimiento</th>
                <th>Bar Asignado</th>
                <th>Ubicacion</th>
                <th>Email</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </tfoot>
        </table>
</div>
<script>
    function eliminar() {
        console.log("Intentando eliminar: " + window.location.href);
        return confirm("¿Estás seguro de que deseas eliminar este Empleado?");
    }
</script>

