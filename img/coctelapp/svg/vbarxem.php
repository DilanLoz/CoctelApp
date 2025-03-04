<?php include("controllers/cbarxem.php");
include_once('admin/controllers/cubi.php');
include_once('admin/controllers/cval.php');?>
<div class="container mt-5 mb-5" style="text-align: left; display: block;">
    <h1 class="mb-4">Crear Empleado</h1>
    <form action="#" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nombre del empleado:</label>
                    <input type="text" id="name" name="name" class="form-control" name="nomemp" id="nomemp" value="<?php if($dtOne && $dtOne[0]['nomemp']) echo $dtOne[0]['nomemp']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Email empleado:</label>
                    <input id="text" name="name" class="form-control"value="<?php if($dtOne && $dtOne[0]['emaemp']) echo $dtOne[0]['emaemp']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="identification">No. de identificación:</label>
                    <input type="text" id="identification" name="identification" class="form-control" name="idemp" id="idemp" value="<?php if($dtOne && $dtOne[0]['idemp']) echo $dtOne[0]['idemp']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="idval">Valor:</label>
                    <select id="idval" name="idval" class="form-control custom-select" >
                    <option value="" disabled selected>Tipo de documento</option>
                                <?php
                                $valoresValidos = $mval->getDocumentos();
                                if ($valoresValidos) {
                                    foreach ($valoresValidos as $valor) {
                                        echo '<option value="' . $valor['idval'] . '">' . $valor['nomval'] . '</option>';
                                    }
                                }
                                ?>
                    </select>
                </div>
                <div class="form-group">
                <label for="employee-type">Contraseña:</label>
                    <input type="password" class="form-control" id="inputPassword2" placeholder="Password" value="<?php if($dtOne && $dtOne[0]['pssemp']) echo $dtOne[0]['pssemp']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono:</label>
                    <input type="tel" id="phone" name="phone" class="form-control" name="celemp" id="celemp" value="<?php if($dtOne && $dtOne[0]['celemp']) echo $dtOne[0]['celemp']; ?>" required>
                </div>
                
                
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="photo">Foto del empleado:</label>
                    <input type="file" id="photo" name="photo" accept="image/*" class="form-control" >
            </div>
                <div class="form-group">
                    <label for="codubi" class="form-label">Ubicación Actual:</label>
                    <select id="codubi" name="codubi" class="form-control" >
                    <option value="" disabled selected>Seleccione una ciudad</option>
                                <?php
                                $dataUbicaciones = $mubi->getCodubiNomubi();
                                if ($dataUbicaciones) {
                                    foreach ($dataUbicaciones as $ubicacion) {
                                        echo '<option value="' . $ubicacion['codubi'] . '">' . $ubicacion['nomubi'] . '</option>';
                                    }
                                }
                                ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bar">Bar donde el empleado está asignado:</label>
                    <input type="text" id="bar" name="bar" class="form-control" value="<?php if($dtOne && $dtOne[0]['nombar']) echo $dtOne[0]['nombar']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="employee-type">Tipo de empleado:</label>
                    <select id="employee-type" name="employee-type" class="form-control custom-select" >
                        <option value="domiciliario">Domiciliario</option>
                        <option value="bartender">Bartender</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="employee-type">Perfil:</label>
                    <select id="employee-type" name="employee-type" class="form-control custom-select" >
                        <option value="empleado">Empleado</option>
                        <option value="bar">Bar</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dob">Fecha de nacimiento:</label>
                    <input type="date" id="dob" name="dob" class="form-control" name="fecnaemp" id="fecnaemp" value="<?php if($dtOne && $dtOne[0]['fecnaemp']) echo $dtOne[0]['fecnaemp']; ?>" required>
                </div>
            </div>
        </div>
        <div class="text-end mt-3">
            <input type="submit" value="Crear empleado" class="btn btn-warning" id="crearemBtn" <?php if($dtOne && $dtOne[0]['idemp']) echo $dtOne[0]['idemp']; ?>>
        </div>
    </form>
    <div>
    <table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>foto</th>
            <th>Id</th>
            <th>Nombre</th>
            <th>No. Documento</th>
            <th>Fecha de Nacimiento</th>
            <th>Bar Asignado</th>
            <th>Tipo Servicio</th>
            <th>Ubicacion</th>
            <th>Email</th>
            <th>Telefono</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if($dat){ foreach ($dat as $dt) { ?>
            <tr>
                <td>
                    <?php if (file_exists($dt["fotiden"])) { ?>
                        <img src="<?=$dt["fotiden"];?>" width="150px"> 
                    <?php } ?>
                </td>
                <td><?=$dt["idemp"];?> </td>
                <td><?=$dt["nomemp"];?></td>
                <td>
                    <div>
                        <small>
                            <strong>Tipo: </strong><?=$dt["nomval"];?><br> <!--Hay que llamar a nomval, para mostrar si es CC o NIT -->
                            <strong>Numero: </strong><?=$dt["numdocu"];?><br>
                        </small>
                    </div>
                </td>
                <td>-<?=$dt["fecnaemp"];?></td>
                <td><?=$dt["nombar"];?></td>
                <td><?=$dt["nomserv"];?></td>
                <td><?=$dt["nomubi"];?></td>
                <td><?=$dt["emaemp"];?></td>
                <td><?=$dt["celemp"];?></td>
                <td class="row">
                    <a href="home.php?pg=3004&ope=edi&idemp=<?=$dt["idemp"];?>" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="home.php?pg=3004&ope=del&idemp=<?=$dt["idemp"];?>" onclick="return eli();" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
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
            <th>Tipo Servicio</th>
            <th>Ubicacion</th>
            <th>Email</th>
            <th>Telefono</th>
            <th></th>
        </tr>
    </tfoot>
</table>

    </div>
    <script src="js/alertas.js"></script>
</div>
