<?php
require_once 'models/conexion.php';

$pdo = (new Conexion())->get_conexion(); // Conectar a la base de datos

$mensaje = ""; // Variable para mensajes de error o éxito

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar si el token es válido y no ha expirado
    $stmt = $pdo->prepare("SELECT emausu FROM token WHERE token = ? AND expiracion > NOW()");
    $stmt->execute([$token]);
    $user = $stmt->fetch();

    if ($user) {
        $email = $user['emausu']; // Correo asociado al token

        // Si se envió el formulario para cambiar contraseña
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password'], $_POST['confirm_password'])) {
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password === $confirm_password) {
                // Hashear la nueva contraseña con el mismo método del registro
                $hashed_password = sha1(md5($password . 'Jd#'));

                // Actualizar la contraseña en la columna pssusu de la tabla usuario
                $stmt = $pdo->prepare("UPDATE usuario SET pssusu = ? WHERE emausu = ?");
                if ($stmt->execute([$hashed_password, $email])) {
                    // Eliminar el token después de cambiar la contraseña
                    $stmt = $pdo->prepare("DELETE FROM token WHERE emausu = ?");
                    $stmt->execute([$email]);

                    $mensaje = "<div class='alert alert-success text-center'>Contraseña cambiada con éxito. <a href='../index.php' class='alert-link'>Inicia sesión aquí</a></div>";
                } else {
                    $mensaje = "<div class='alert alert-danger text-center'>Error al cambiar la contraseña. Inténtalo de nuevo.</div>";
                }
            } else {
                $mensaje = "<div class='alert alert-warning text-center'>Las contraseñas no coinciden.</div>";
            }
        }
    } else {
        $mensaje = "<div class='alert alert-danger text-center'>El enlace ha expirado. <a href='index.php?pg=1002' class='alert-link'>Solicita uno nuevo</a></div>";
    }
} else {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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
        body::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(10px);
            z-index: -1;
        }

        /* Contenedor del formulario con efecto blur */
        .card {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            border-radius: 10px;
        }
    </style>
</head>

<body class="password text-white">
    <main class="d-flex justify-content-center align-items-center vh-100">
        <div class="card text-white shadow p-4" style="max-width: 400px; width: 100%;">
            <h2 class="text-center text-warning">Cambiar Contraseña</h2>

            <?php echo $mensaje; ?>

            <?php if (!isset($mensaje) || strpos($mensaje, 'Contraseña cambiada con éxito') === false) : ?>
                <form method="POST">
                    <div class="mb-3">
                        <label for="password" class="form-label">Nueva Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text bg-warning text-white"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control" required>
                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                                <i class="fas fa-eye" style="color: white;"></i>
                            </button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirmar Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text bg-warning text-white"><i class="fas fa-lock"></i></span>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="confirm_password">
                                <i class="fas fa-eye" style="color: white;"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-warning w-100">Cambiar Contraseña</button>
                </form>
            <?php endif; ?>
        </div>
    </main>
    <script>
        document.querySelectorAll(".toggle-password").forEach(button => {
            button.addEventListener("click", function() {
                const target = document.getElementById(this.getAttribute("data-target"));
                const icon = this.querySelector("i");

                if (target.type === "password") {
                    target.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    target.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
            });
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>