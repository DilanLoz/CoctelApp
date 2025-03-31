<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<main>
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="alert alert-success text-center mt-2">
            <i class="fa-solid fa-check-circle"></i>
            ¡Solicitud enviada con éxito! Nos pondremos en contacto contigo pronto.
        </div>
    <?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
        <div class="alert alert-danger text-center mt-2">
            <i class="fa-solid fa-times-circle"></i>
            Hubo un error al enviar tu solicitud. Inténtalo de nuevo más tarde.
            <br>
            <small>Error: <?= htmlspecialchars($_GET['msg'] ?? 'Desconocido') ?></small>
        </div>
    <?php endif; ?>

    <form action="controllers/ccorreo_planes.php" method="POST" autocomplete="off" class="container text-white p-4 mt-5 mb-5 rounded">
        <div class="mb-4 text-center">
            <h2 class="text-warning">Solicitar Plan para tu Bar</h2>
            <p><i class="fa-solid fa-circle-info text-warning"></i> Completa el formulario y te contactaremos a la brevedad.</p>
            <p class="text-white">
                <i class="fa-solid fa-location-dot text-warning"></i>
                Por el momento, solo estamos operando en <strong class="text-warning">Bogotá</strong>.
            </p>
        </div>

        <div class="row g-3 mb-5">
            <div class="col-md-6">
                <label for="emausu" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="emausu" id="emausu" required>
            </div>
            <div class="col-md-6">
                <label for="nombre_bar" class="form-label">Nombre del Bar</label>
                <input type="text" class="form-control" name="nombre_bar" id="nombre_bar" required>
            </div>
            <div class="col-md-6">
                <label for="nit" class="form-label">NIT</label>
                <input type="text" class="form-control" name="nit" id="nit" required>
            </div>
            <div class="col-md-6">
                <label for="ciudad" class="form-label">Ubicacion:</label>
                <select class="form-select" name="ciudad" id="ciudad" required>
                    <option value="" disabled selected>Seleccione una localidad</option>
                    <option value="usaquen">Usaquén</option>
                    <option value="chapinero">Chapinero</option>
                    <option value="santa_fe">Santa Fe</option>
                    <option value="san_cristobal">San Cristóbal</option>
                    <option value="usme">Usme</option>
                    <option value="tunjuelito">Tunjuelito</option>
                    <option value="bosa">Bosa</option>
                    <option value="kennedy">Kennedy</option>
                    <option value="fontibon">Fontibón</option>
                    <option value="engativa">Engativá</option>
                    <option value="suba">Suba</option>
                    <option value="barrios_unidos">Barrios Unidos</option>
                    <option value="teusaquillo">Teusaquillo</option>
                    <option value="los_martires">Los Mártires</option>
                    <option value="antonio_nariño">Antonio Nariño</option>
                    <option value="puente_aranda">Puente Aranda</option>
                    <option value="la_candelaria">La Candelaria</option>
                    <option value="rafael_uribe_uribe">Rafael Uribe Uribe</option>
                    <option value="ciudad_bolivar">Ciudad Bolívar</option>
                    <option value="sumapaz">Sumapaz</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" class="form-control" name="direccion" id="direccion" required>
            </div>
            <div class="col-md-6">
                <label for="propietario" class="form-label">Nombre del Propietario</label>
                <input type="text" class="form-control" name="propietario" id="propietario" required>
            </div>

            <div class="col-md-6">
                <label for="hora_apertura" class="form-label">Hora de Apertura</label>
                <input type="time" class="form-control" name="hora_apertura" id="hora_apertura" required>
            </div>
            <div class="col-md-6">
                <label for="hora_cierre" class="form-label">Hora de Cierre</label>
                <input type="time" class="form-control" name="hora_cierre" id="hora_cierre" required>
            </div>
            <div class="col-md-6">
                <label for="plan" class="form-label">Plan</label>
                <select class="form-select" name="plan" id="plan" required>
                    <option value="Mensual">Mensual</option>
                    <option value="Semestral">Semestral</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="mensaje" class="form-label">Mensaje Adicional</label>
                <textarea class="form-control" name="mensaje" id="mensaje" rows="4" placeholder="Escribe aquí cualquier información adicional..." required></textarea>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-warning text-dark fw-bold px-4">Enviar Solicitud</button>
            </div>
        </div>
    </form>
</main>

<style>
    body,
    main {
        position: relative;
        width: 100%;
        height: 100%;
        background-image: url('./img/coctelapp/registro.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    form::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: inherit;
        filter: blur(10px);
        z-index: -1;
    }

    .container {
        background: rgba(0, 0, 0, 0.48);
        backdrop-filter: blur(5px);
        border-radius: 10px;
    }
</style>