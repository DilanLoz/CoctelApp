<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<main>
    <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="alert alert-success text-center">
            <i class="fa-solid fa-check-circle"></i>
            ¡Mensaje enviado con éxito! Nos pondremos en contacto contigo pronto.
        </div>
    <?php elseif (isset($_GET['error']) && $_GET['error'] == 1): ?>
        <div class="alert alert-danger text-center">
            <i class="fa-solid fa-times-circle"></i>
            Hubo un error al enviar tu mensaje. Inténtalo de nuevo más tarde.
            <br>
            <small>Error: <?= htmlspecialchars($_GET['msg'] ?? 'Desconocido') ?></small>
        </div>
    <?php endif; ?>

    <form action="controllers/soporte_tecnico.php" method="POST" autocomplete="off" class="container text-white p-4 mt-5 rounded">
        <div class="mb-4 text-center">
            <h2 class="text-warning">Soporte Técnico</h2>
            <p><i class="fa-solid fa-circle-info text-warning"></i> Los de Plan mensual cuentan con soporte técnico en 24 a 48 horas. y los de Plan semestral cuentan con soporte técnico en 16 horas.</p>
        </div>

        <div class="row g-3">
            <!-- Nombre del Bar -->
            <div class="col-md-6">
                <label for="nombre_bar" class="form-label">Nombre</label>
                <div class="input-group">
                    <span class="input-group-text bg-warning text-dark"><i class="fa-solid fa-store"></i></span>
                    <input type="text" class="form-control" name="nombre_bar" id="nombre_bar" placeholder="Ej: Bar El Paraíso" required />
                </div>
            </div>

            <!-- Correo Electrónico -->
            <div class="col-md-6">
                <label for="email" class="form-label">Correo Electrónica</label>
                <div class="input-group">
                    <span class="input-group-text bg-warning text-dark"><i class="fa-regular fa-envelope"></i></span>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Ej: contacto@barejemplo.com" required />
                </div>
            </div>

            <!-- Teléfono -->
            <div class="col-md-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <div class="input-group">
                    <span class="input-group-text bg-warning text-dark"><i class="fa-solid fa-phone"></i></span>
                    <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ej: +57 300 1234567" required />
                </div>
            </div>

            <!-- Descripción del Problema -->
            <div class="col-12">
                <label for="mensaje" class="form-label">Descripción del Problema</label>
                <textarea class="form-control" name="mensaje" id="mensaje" rows="4" placeholder="Describe el problema que estás experimentando..." required></textarea>
            </div>

            <!-- Botón de envío -->
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-warning text-dark fw-bold px-4">Solicitar Soporte</button>
            </div>
        </div>
    </form>
</main>

<style>
    body, main {
        position: relative;
        width: 100%;
        height: 100vh;
        background-image: url('./img/coctelapp/soporte.jpg');
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
