<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css">
<div class="container mt-3 mb-5">
    <h1 class="mb-4">Datos personales</h1>
    <form action="#" method="post">
        <div class="row">
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

