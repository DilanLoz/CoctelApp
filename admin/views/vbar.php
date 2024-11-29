<div class="titulo">
    <?php include("admin/controllers/cbar.php"); ?>
</div>

<br><br>

<div id="ins">
    <h1>Bares</h1>
    <form action="#" method="POST" enctype="multipart/form-data">
        <div class="row">
            <!-- Nombre del bar -->
            <div class="form-group col-md-4">
                <label for="nomusu">Nombre del bar</label>
                <input type="text" class="form-control" name="nomusu" id="nomusu" 
                    value="<?php if($dtOne && $dtOne[0]['nomusu']) echo $dtOne[0]['nomusu']; ?>" required>
            </div>

            <!-- Correo electrónico -->
            <div class="form-group col-md-4">
                <label for="emausu">Correo electrónico</label>
                <input type="email" class="form-control" name="emausu" id="emausu" 
                    value="<?php if($dtOne && $dtOne[0]['emausu']) echo $dtOne[0]['emausu']; ?>" required>
            </div>

            <!-- Celular -->
            <div class="form-group col-md-4">
                <label for="celusu">Celular</label>
                <input type="text" class="form-control" name="celusu" id="celusu" 
                    value="<?php if($dtOne && $dtOne[0]['celusu']) echo $dtOne[0]['celusu']; ?>">
            </div>

            <!-- Número de identificación -->
            <div class="form-group col-md-4">
                <label for="numdocu">Número de identificación</label>
                <input type="text" class="form-control" name="numdocu" id="numdocu" 
                    value="<?php if($dtOne && $dtOne[0]['numdocu']) echo $dtOne[0]['numdocu']; ?>">
            </div>

            <!-- Cambie esto pero no se si sirva -->
            <div class="form-group col-md-4">
                <label for="fotbar">Foto del bar</label>
                <input type="file" class="form-control form-control" name="fots" accept="image/*" id="fotbar">
                <input type="hidden" name="fotbar" value="<?php echo isset($datOne[0]['fotbar']) && !empty($datOne[0]['fotbar']) ? $datOne[0]['fotbar'] : ''; ?>">
            </div>

            <!-- Contraseña -->
            <div class="form-group col-md-4">
                <label for="pssusu">Contraseña</label>
                <input type="password" class="form-control" name="pssusu" id="pssusu" 
                    value="<?php if($dtOne && $dtOne[0]['pssusu']) echo $dtOne[0]['pssusu']; ?>">
            </div>

            <!-- Botón de envío -->
            <div class="form-group col-md-4">
                <br>
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idusu" 
                    value="<?php if($dtOne && $dtOne[0]['idusu']) echo $dtOne[0]['idusu']; ?>" required>
                <input type="submit" class="btn btn-primary" value="Enviar">
            </div>
        </div>
    </form>
</div>

<br>

<!-- Tabla de bares -->
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Estado</th>
            <th>Perfil</th>
            <th>Foto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($dat) {
            foreach ($dat as $dt) { ?>
                <tr>
                    <td><?= $dt["idusu"]; ?></td>
                    <td><?= $dt["nomusu"]; ?></td>
                    <td><?= $dt["emausu"]; ?></td>
                    <td><?= $dt["celusu"]; ?></td>
                    <td><?= $dt["numdocu"]; ?></td>
                    <td><?= $dt["pssusu"]; ?></td>
                    <td class="text-center">
                        <?php if (!empty($dt["fotiden"]) && file_exists("img/fotbar/" . $dt["fotiden"])) { ?>
                            <img src="img/fotbar/<?= $dt["fotiden"]; ?>" width="120px" style="margin-right: 10px;">
                        <?php } else { ?>
                            <img src="img/coctelapp/logo.png" width="120px" style="margin-right: 10px;">
                        <?php } ?>
                    </td>
                    <td>
                        <a href="home.php?pg=4050&ope=edi&idusu=<?= $dt["idusu"]; ?>" title="Editar">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                        <a href="home.php?pg=4050&ope=del&idusu=<?= $dt["idusu"]; ?>" onclick="return eli();" title="Eliminar">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </td>
                </tr>
        <?php } } ?>
    </tbody>
    <tfoot>
        <tr>
            <th>Id</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Correo</th>
            <th>Estado</th>
            <th>Perfil</th>
            <th>Foto</th>
            <th>Acciones</th>
        </tr>
    </tfoot>
</table>
