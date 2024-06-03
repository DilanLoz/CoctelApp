<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="../style.css">

<div class="background-image-container col-md" id="imgcont">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card p-4 transparent-form">
            <div class="card-body">
                <h2>Bar</h2>
                <form>
                    <div class="mb-3">
                        <label for="nit" class="form-label">No. de NIT:</label>
                        <input type="text" class="form-control" id="nit" placeholder="Ingrese el numero de NIT">
                    </div>
                    <div class="mb-3">
                        <label for="nombre_bar" class="form-label">Nombre del BAR:</label>
                        <input type="text" class="form-control" id="nombre_bar" placeholder="Ingrese el nombre del bar">
                    </div>
                    <div class="mb-3">
                        <label for="propietario" class="form-label">Nombre del propietario:</label>
                        <input type="text" class="form-control" id="propietario" placeholder="Ingrese el nombre del propietario">
                    </div>
                    <div class="mb-3">
                        <label for="ubicacion" class="form-label">Ubicación del bar:</label>
                        <input type="text" class="form-control" id="ubicacion" placeholder="Ingrese la ubicación del bar">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="password" placeholder="Contraseña">
                    </div>
                    
                    <button type="submit" class="btn btn-warning btn-block">Registrarse</button>
                    <div class="text-center mt-3">
                        <a href="#" class="text-dark">¿Ya tienes una cuenta?</a> | <a href="#" class="text-warning">Iniciar sesión</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
