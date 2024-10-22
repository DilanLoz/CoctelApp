<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/loginreg.css">

<main>
    <div class="box">
        <div class="inner-box">
            <div class="forms-wrap">
                <!-- Formulario de Inicio de Sesión -->
                <form action="models/control.php" method="POST" autocomplete="off" class="sign-in-form">
                    <div class="logo">
                        <img src="img/coctelapp.png" alt="Logo"/>
                    </div>

                    <div class="heading">
                        <h6 class="fw-bold">¿Aún no posee una cuenta?</h6>
                        <a href="#" class="toggle fw-bold">Presione aquí para registrarse.</a>
                    </div>

                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="text" minlength="4" id="email" name="usu" class="input-field" autocomplete="off" required />
                            <label><i class="fa-solid fa-envelope" style="color: #ffffff;"></i> Correo Electrónico</label>
                        </div>

                        <div class="input-wrap">
                            <input type="password" minlength="4" id="password" name="pss" class="input-field" autocomplete="off" required />
                            <label><i class="fa-solid fa-lock" style="color: #ffffff;"></i> Contraseña</label>
                        </div>

                        <!-- Mostrar error si los datos son inválidos -->
                        <?php
                            $err = isset($_GET['err']) ? $_GET['err'] : NULL;
                            if($err == 'oK') echo "<span class='dtinv'>Datos inválidos</span>";
                        ?>

                        <input type="submit" value="Iniciar Sesión" class="sign-btn" />

                        <p class="text fw-bold">
                            ¿Ha olvidado su contraseña?
                            <a href="#" class="toggle fw-bold">Presione aquí para recuperarla.</a>
                        </p>
                    </div>
                </form>

                <!-- Formulario de Registro -->
                <form action="models/control.php" method="POST" autocomplete="off" class="sign-up-form">
                    <div class="heading">
                        <h2>Registro</h2>
                        <h6 class="fw-bold">¿Ya tienes una cuenta?</h6>
                        <a href="#" class="toggle fw-bold">Iniciar Sesión</a>
                    </div>

                    <p class="text"><i class="fa-solid fa-circle-exclamation" style="color: #ff0000;"></i> Para BARES seleccione el tipo de documento NIT y NOMBRE del Bar</p>

                    <div class="actual-form">
                        <div class="input-wrap">
                            <select class="input-field" id="tipo_documento" name="tipo_doc" required>
                                <option value="" disabled selected>Tipo de documento</option>
                                <option value="CC">CC</option>
                                <option value="NIT">NIT</option>
                                <option value="CE">CE</option>
                            </select>
                        </div>

                        <div class="input-wrap">
                            <input type="number" minlength="4" name="docnum" class="input-field" autocomplete="off" required />
                            <label><i class="fa-regular fa-address-card" style="color: #ffffff;"></i> Número Identificación o NIT</label>
                        </div>

                        <div class="input-wrap">
                            <input type="text" minlength="4" name="nombre" class="input-field" autocomplete="off" required />
                            <label><i class="fa-solid fa-file-signature" style="color: #ffffff;"></i> Nombre</label>
                        </div>

                        <div class="input-wrap">
                            <select class="input-field" id="ubicacion" name="ubicacion" required>
                                <option value="" disabled selected>Ubicación Actual</option>
                                <option value="BOG">BOGOTÁ</option>
                                <option value="MED">MEDELLÍN</option>
                                <option value="CART">CARTAGENA</option>
                            </select>
                        </div>

                        <div class="input-wrap">
                            <input type="email" name="email" class="input-field" autocomplete="off" required/>
                            <label><i class="fa-regular fa-envelope" style="color: #ffffff;"></i> Correo Electrónico</label>
                        </div>

                        <div class="input-wrap">
                            <input type="password" minlength="4" name="password" class="input-field" autocomplete="off" required />
                            <label><i class="fa-solid fa-lock" style="color: #ffffff;"></i> Contraseña</label>
                        </div>

                        <input type="submit" value="Registrar" class="registro-btn" />
                    </div>
                </form>

                <!-- Formulario de Recuperación de Contraseña -->
                <form action="models/control.php" method="POST" autocomplete="off" class="recovery-form" style="display: none;">
                    <div class="heading">
                        <h2>Cambiar Contraseña</h2>
                    </div>

                    <p class="text"><i class="fa-solid fa-circle-exclamation" style="color: #ff0000;"></i> Al cambiar la contraseña, confirme en el correo electrónico.</p>

                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="email" name="email" class="input-field" autocomplete="off" required />
                            <label><i class="fa-regular fa-envelope" style="color: #ffffff;"></i> Correo Electrónico</label>
                        </div>

                        <div class="input-wrap">
                            <input type="number" name="docnum" class="input-field" autocomplete="off" required />
                            <label><i class="fa-regular fa-address-card" style="color: #ffffff;"></i> Número de Identificación o NIT</label>
                        </div>

                        <div class="input-wrap">
                            <input type="password" name="new_password" class="input-field" autocomplete="off" required />
                            <label><i class="fa-solid fa-lock" style="color: #ffffff;"></i> Nueva Contraseña</label>
                        </div>

                        <input type="submit" value="Cambiar Contraseña" class="recupcontra-btn" />
                    </div>

                    <p class="text fw-bold">
                        Ya tengo una cuenta <a href="#" class="toggle fw-bold">Inicia Sesión</a>
                    </p>
                </form>
            </div>

            <!-- Carousel de imágenes -->
            <div class="container text-center">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/publi1.png" class="d-block w-100 h-100" alt="Publicación 1">
                        </div>
                        <div class="carousel-item">
                            <img src="img/publi2.png" class="d-block w-100 h-100" alt="Publicación 2">
                        </div>
                        <div class="carousel-item">
                            <img src="img/publi3.png" class="d-block w-100 h-100" alt="Publicación 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="js/loginreg.js"></script>
