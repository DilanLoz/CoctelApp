<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<link rel="stylesheet" href="../style.css">

<div class="container barrareg">
    <nav class="row navbar navbar-expand-lg navbar-warning" id="menu">
        <ul class="navbar-nav me-auto">
            <li class="nav-item text-center">
                <a class="nav-link" href="vregusu.php?pg=101">Usuario</a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link" href="vregbar.php?pg=102">Bar</a>
            </li>
        </ul>
    </nav>
</div>

<div class="background-image-container" id="imgcont">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card p-4 transparent-form">
            <div class="card-body">
                <h2 class="text-center mb-4">Usuario</h2>
                <form>
                    <div class="row">
                        <div class="mb-3 col-md-4">
                            <label for="tipo_documento" class="form-label">Tipo:</label>
                            <select class="form-select form-control" id="tipo_documento">
                                <option value="CC">CC</option>
                                <option value="CE">CE</option>
                                <option value="PA">PA</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-8">
                            <label for="numero_documento" class="form-label">Número de documento:</label>
                            <input type="text" class="form-control" id="numero_documento" placeholder="Número de documento">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                    </div>
                    <div class="mb-3">
                        <label for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" placeholder="Apellidos">
                    </div>
                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                        <input type="date" class="form-control" id="fecha_nacimiento">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="tel" class="form-control" id="telefono" placeholder="Teléfono">
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

