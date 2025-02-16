<?php require_once('controllers/cpusu.php');
require_once('admin/controllers/cubi.php');
// Iniciar la sesión si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div id="perfil" class="container mt-5 mb-5" style="text-align: left; display: block;">
    <h2 class="fw-bold mb-3" style="display: inline-block;"> 
        <i class="fa-solid fa-file-shield"></i> Datos del bar
        <!-- Botón circular al lado del título -->
        <button class="btn btn-circle" id="editButton" style="margin-left: 10px;">
            <i class="fa-solid fa-plus" style="font-size: 20px;"></i>
        </button>
    </h2>
    
    <!-- Formulario de edición (inicialmente oculto) -->
    <div id="editForm" style="display: none; margin-top: 20px;">
        <form action="edit_profile_action.php" method="POST">
            <div class="mb-3">
                <label for="nomusu" class="form-label">Nombre del Bar:</label>
                <input type="text" class="form-control" id="nomusu" name="nomusu" value="<?= isset($_SESSION['nomusu']) ? $_SESSION['nomusu'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="numdocu" class="form-label">No. de NIT:</label>
                <input type="text" class="form-control" id="numdocu" name="numdocu" value="<?= isset($_SESSION['numdocu']) ? $_SESSION['numdocu'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nompropi" class="form-label">Nombre del Propietario:</label>
                <input type="text" class="form-control" id="nompropi" name="nompropi" value="<?= isset($_SESSION['nompropi']) ? $_SESSION['nompropi'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="pssusu" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="pssusu" name="pssusu" value="<?= isset($_SESSION['pssusu']) ? $_SESSION['pssusu'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="emausu" class="form-label">Gmail:</label>
                <input type="email" class="form-control" id="emausu" name="emausu" value="<?= isset($_SESSION['emausu']) ? $_SESSION['emausu'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="celusu" class="form-label">Teléfono:</label>
                <input type="text" class="form-control" id="celusu" name="celusu" value="<?= isset($_SESSION['celusu']) ? $_SESSION['celusu'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="dircbar" class="form-label">Dirección del Bar:</label>
                <input type="text" class="form-control" id="dircbar" name="dircbar" value="<?= isset($_SESSION['dircbar']) ? $_SESSION['dircbar'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="horbar" class="form-label">Horario del Bar:</label>
                <input type="text" class="form-control" id="horbar" name="horbar" value="<?= isset($_SESSION['horbar']) ? $_SESSION['horbar'] : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Actualizar datos</button>
        </form>
    </div>

    <!-- Tabla de los datos del bar -->
    <table class="table table-bordered" style="margin-top: 20px;">
        <tbody>
            <tr>
                <th>Nombre del bar:</th>
                <td><?= isset($_SESSION['nomusu']) ? $_SESSION['nomusu'] : 'No disponible'; ?></td>
            </tr>
            <tr>
                <th>No. de NIT:</th>
                <td><?= isset($_SESSION['numdocu']) ? $_SESSION['numdocu'] : 'No disponible'; ?></td>
            </tr>
            <tr>
                <th>Nombre del propietario:</th>
                <td><?= isset($_SESSION['nompropi']) ? $_SESSION['nompropi'] : 'No disponible'; ?></td>
            </tr>
            <tr>
                <th>Contraseña:</th>
                <td><?= isset($_SESSION['pssusu']) ? $_SESSION['pssusu'] : 'No disponible'; ?></td>
            </tr>
            <tr>
                <th>Gmail:</th>
                <td><?= isset($_SESSION['emausu']) ? $_SESSION['emausu'] : 'No disponible'; ?></td>
            </tr>
            <tr>
                <th>Foto del bar:</th>
                <td>
                    <img src="<?= isset($_SESSION['fotiden']) ? $_SESSION['fotiden'] : 'default.jpg'; ?>" alt="Foto del bar" class="img-fluid" style="max-width: 200px;">
                </td>
            </tr>
            <tr>
                <th>Teléfono:</th>
                <td><?= isset($_SESSION['celusu']) ? $_SESSION['celusu'] : 'No disponible'; ?></td>
            </tr>
            <tr>
                <th>Ubicación Actual:</th>
                <td><?= isset($_SESSION['nomubi']) ? $_SESSION['nomubi'] : 'No disponible'; ?></td>
            </tr>
            <tr>
                <th>Dirección del bar:</th>
                <td><?= isset($_SESSION['dircbar']) ? $_SESSION['dircbar'] : 'No disponible'; ?></td>
            </tr>
            <tr>
                <th>Horario del bar:</th>
                <td><?= isset($_SESSION['horbar']) ? $_SESSION['horbar'] : 'No disponible'; ?></td>
            </tr>
        </tbody>
    </table>

</div>

<script src="js/alertas.js"></script>

<!-- Script para mostrar/ocultar el formulario de edición y cambiar el ícono del botón -->
<script>
    document.getElementById("editButton").addEventListener("click", function() {
        var editForm = document.getElementById("editForm");
        var icon = this.querySelector("i");

        // Mostrar u ocultar el formulario
        if (editForm.style.display === "none" || editForm.style.display === "") {
            editForm.style.display = "block";  // Mostrar el formulario
            icon.classList.remove("fa-plus");
            icon.classList.add("fa-minus");  // Cambiar a icono de "-"
            this.style.backgroundColor = "black";  // Cambiar color del botón a negro
        } else {
            editForm.style.display = "none";   // Ocultar el formulario
            icon.classList.remove("fa-minus");
            icon.classList.add("fa-plus");    // Cambiar a icono de "+"
            this.style.backgroundColor = "black";  // Mantener color negro
        }
    });
</script>

<!-- Estilos CSS para el botón circular -->
<style>
    .btn-circle {
        width: 25px;
        height: 25px;
        padding: 10px;
        border-radius: 50%;
        font-size: 24px;
        text-align: center;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        background-color: black; /* Color de fondo negro */
        border: none;
        color: white;
        transition: background-color 0.3s ease;
    }

    .btn-circle i {
        color: #fff;
    }
</style>
