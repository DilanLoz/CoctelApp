<?php include("controllers/cpbar.php"); ?>

<div id="perfil" class="container mt-5 mb-5" style="text-align: left; display: block;">
    <form action="#" method="post" enctype="multipart/form-data"></form>
        <div class="row">
        <h2 class="fw-bold mb-3"><i class="fa-solid fa-file-shield"></i>Datos personales</h2>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nombre del bar:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="identification">No. de NIT:</label>
                    <input type="text" id="identification" name="identification" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="identification">Nombre del propietario:</label>
                    <input type="text" id="identification" name="identification" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="photo">Foto del bar:</label>
                    <input type="file" id="photo" name="photo" accept="image/*" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono:</label>
                    <input type="tel" id="phone" name="phone" class="form-control" required>
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
                    <label for="city">Direccion del bar:</label>
                    <input type="text" id="city" name="city" class="form-control" required>
                </div>
            </div>
        </div>
        <div class="text-end mt-3">
            <input type="submit" value="Actualizar datos" class="btn btn-warning" id="actualizarBtn">
        </div>
    </form>
    <script src="js/alertas.js"></script>
</div>

