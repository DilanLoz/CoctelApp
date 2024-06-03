<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css">


<div class="container mt-3 mb-5">
    <h1 class="mb-4">Crear producto</h1>
    <form action="#" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Nombre del empleado:</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1" class="form-label me-3">Descripcion del producto:</label>
                <input type="Descripcion" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                        <label for="ubicacion" class="form-label">Categorias:</label>
                        <select id="employee-type" name="employee-type" class="form-control" required>
                            <option value="cocteles">Cocteles</option>
                            <option value="vinos">Vinos</option>
                            <option value="licores">Licores</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="cantprod" class="form-label">Cantidad de producto:</label>
                    <input type="number" class="form-control" id="cantprod" name="cantprod" min="10" step="10" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fotprod">Foto del producto:</label>
                    <input type="file" id="fotprod" name="fotprod" accept="image/*" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="coubi" class="form-label">Ciudades para venta:</label>
                    <select id="employee-type" name="employee-type" class="form-control" required>
                        <option value="bogota">Bogota DC</option>
                        <option value="medellin">Medellin</option>
                        <option value="cartagena">Cartagena</option>
                        <option value="bucaramanga">Bucaramanga</option>
                        <option value="nariño">Nariño</option>
                    </select>
                </div>
                <div class="row form-group">
                    <div class="col-md-3">
                    <label for="descprod" class="form-label">Descuento:</label>
                    <select id="employee-type" name="employee-type" class="form-control" required>
                        <option value="01">5%</option>
                        <option value="02">10%</option>
                        <option value="03">15%</option>
                        <option value="04">20%</option>
                        <option value="05">30%</option>
                    </select>
                    </div>
                    <div class="col-md-9">
                        <label for="exampleInputEmail1" class="form-label">Codigo de descuento:</label>
                        <input type="Ingrese" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="text-end mt-3">
                    <input type="submit" value="Crear producto" class="btn btn-warning" id="crearprodBtn">
                </div>
            </div>
        </div>
    </form>
    <script src="js/alertas.js"></script>
</div>