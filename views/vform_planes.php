<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<main>
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="alert alert-success text-center">
            <i class="fa-solid fa-check-circle"></i>
            ¡Solicitud enviada con éxito! En un lapso de 24 a 48 horas, el equipo de CoctelApp se pondrá en contacto con usted.
        </div>
    <?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
        <div class="alert alert-danger text-center">
            <i class="fa-solid fa-times-circle"></i>
            Hubo un error al enviar la solicitud. Inténtalo de nuevo más tarde.
            <br>
            <small>Error: <?= htmlspecialchars($_GET['msg'] ?? 'Desconocido') ?></small>
        </div>
    <?php endif; ?>

    <form action="controllers/ccorreo_planes.php" method="POST" autocomplete="off" class="container text-white p-4 mt-5 rounded">
        <div class="mb-4 text-center">
            <h2 class="text-warning">Contacto para Planes</h2>
            <p><i class="fa-solid fa-circle-info text-warning"></i> Completa los siguientes datos y nos pondremos en contacto contigo.</p>
        </div>

        <div class="row g-3">
            <!-- Correo Electrónico -->
            <div class="col-md-6">
                <label for="emausu" class="form-label">Correo Electrónico</label>
                <div class="input-group">
                    <span class="input-group-text bg-warning text-dark"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" class="form-control" name="emausu" id="emausu" placeholder="Ej: bar@example.com" required />
                </div>
            </div>

            <!-- Nombre del Bar -->
            <div class="col-md-6">
                <label for="nombre_bar" class="form-label">Nombre del Bar</label>
                <div class="input-group">
                    <span class="input-group-text bg-warning text-dark"><i class="fa-solid fa-store"></i></span>
                    <input type="text" class="form-control" name="nombre_bar" id="nombre_bar" placeholder="Ej: Bar La Esquina" required />
                </div>
            </div>

            <!-- Número de NIT -->
            <div class="col-md-6">
                <label for="nit" class="form-label">Número de NIT</label>
                <div class="input-group">
                    <span class="input-group-text bg-warning text-dark"><i class="fa-solid fa-file-invoice"></i></span>
                    <input type="text" class="form-control" name="nit" id="nit" placeholder="Ej: 123456789" required />
                </div>
            </div>

            <!-- Dirección -->
            <div class="col-md-6">
                <label for="direccion" class="form-label">Dirección</label>
                <div class="input-group">
                    <span class="input-group-text bg-warning text-dark"><i class="fa-solid fa-map-marker-alt"></i></span>
                    <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Ej: Calle 123, Ciudad" required />
                </div>
            </div>

            <!-- Nombre del Propietario -->
            <div class="col-md-6">
                <label for="propietario" class="form-label">Nombre del Propietario</label>
                <div class="input-group">
                    <span class="input-group-text bg-warning text-dark"><i class="fa-solid fa-user"></i></span>
                    <input type="text" class="form-control" name="propietario" id="propietario" placeholder="Ej: Juan Pérez" required />
                </div>
            </div>

            <!-- Ciudad -->
            <div class="col-md-6">
                <label for="ciudad" class="form-label">Ciudad</label>
                <div class="input-group">
                    <span class="input-group-text bg-warning text-dark"><i class="fa-solid fa-city"></i></span>
                    <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ej: Medellín" required />
                </div>
            </div>
            <!-- Horario de Apertura -->
            <div class="col-md-6">
                <label for="hora_apertura" class="form-label">Hora de Apertura</label>
                <input type="time" class="form-control" name="hora_apertura" id="hora_apertura" required />
            </div>

            <!-- Horario de Cierre -->
            <div class="col-md-6">
                <label for="hora_cierre" class="form-label">Hora de Cierre</label>
                <input type="time" class="form-control" name="hora_cierre" id="hora_cierre" required />
            </div>
            <!-- Plan -->
            <div class="col-md-6">
                <label for="plan" class="form-label">Selecciona un Plan</label>
                <select class="form-select" name="plan" id="plan" required>
                    <option value="mensual">Plan Mensual</option>
                    <option value="semestral">Plan Semestral</option>
                </select>
            </div>


            <!-- Mensaje -->
            <div class="col-md-6">
                <label for="mensaje" class="form-label">Mensaje</label>
                <textarea class="form-control" name="mensaje" id="mensaje" rows="4" placeholder="Escribe tu mensaje aquí..." required></textarea>
            </div>

            <!-- Botón de envío -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-warning text-dark fw-bold px-4">Enviar Solicitud</button>
            </div>
        </div>
    </form>
</main>

<style>
    /* Imagen de fondo */
    body,
    main {
        position: relative;
        width: 100%;
        height: 100vh;
        background-image: url('./img/coctelapp/registro.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }

    /* Capa de desenfoque */
    form::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        background: inherit;
        filter: blur(10px);
        z-index: -1;
    }

    /* Contenedor del formulario con efecto blur */
    .container {
        background: rgba(0, 0, 0, 0.48);
        backdrop-filter: blur(5px);
        border-radius: 10px;
    }
</style>