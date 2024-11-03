
<link rel="stylesheet" href="style.css">

<div class="container mt-5 mb-5" style="text-align: left; display: block;">
    <h1 class="mb-4">Crear Empleado</h1>
    <form action="#" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nombre del empleado:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="identification">No. de identificación:</label>
                    <input type="text" id="identification" name="identification" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono:</label>
                    <input type="tel" id="phone" name="phone" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="dob">Fecha de nacimiento:</label>
                    <input type="date" id="dob" name="dob" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción del empleado:</label>
                    <textarea id="description" name="description" class="form-control" required></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="photo">Foto del empleado:</label>
                    <input type="file" id="photo" name="photo" accept="image/*" class="form-control" required>
            </div>
                <div class="form-group">
                    <label for="ubicacion" class="form-label">Ubicación Actual:</label>
                    <select id="employee-type" name="employee-type" class="form-control" required>
                        <option value="bogota">Bogota DC</option>
                        <option value="medellin">Medellin</option>
                        <option value="cartagena">Cartagena</option>
                        <option value="bucaramanga">Bucaramanga</option>
                        <option value="nariño">Nariño</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="bar">Bar donde el empleado está asignado:</label>
                    <input type="text" id="bar" name="bar" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="employee-type">Tipo de empleado:</label>
                    <select id="employee-type" name="employee-type" class="form-control custom-select" required>
                        <option value="domiciliario">Domiciliario</option>
                        <option value="bartender">Bartender</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="text-end mt-3">
            <input type="submit" value="Crear empleado" class="btn btn-warning" id="crearemBtn">
        </div>
    </form>
    <div>
    <table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>No. Documento</th>
			<th>Telefono</th>
			<th></th>
		</tr>
    </thead>
	<tbody><!--
		<?php if($dat){ foreach ($dat as $dt) { ?>
			<tr>
				<td>
					<?php if (file_exists($dt["fotiden"])) { ?>
						<img src="<?=$dt["fotiden"];?>" width="150px"> 
					<?php } ?>-->
				</td>
				<td><?=$dt["idemp"];?> <?=$dt["nomemp"];?></td>
				<td><?=$dt["numdocu"];?></td>
				<td><?=$dt["celemp"];?></td>
				<td>
					<a href="home.php?pg=160&ope=del&id=<?=$dt["id"];?>" onclick="return eli();" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
					<a href="home.php?pg=160&ope=edi&id=<?=$dt["id"];?>" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
				</td>
			</tr>
		<?php }} ?>
	</tbody>

    <tfoot>
        <tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>No. Documento</th>
			<th>Telefono</th>
			<th></th>
		</tr>
    </tfoot>
</table>

    </div>
    <script src="js/alertas.js"></script>
</div>
