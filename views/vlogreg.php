<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/loginreg.css">
<style>
    .carousel-inner {
    width: 100%;
    height: 900px; 
}
</style>

<main>
    <div class="box">
        <div class="inner-box">
            <div class="forms-wrap"> 
                <form action="./models/control.php" method="POST" autocomplete="off" class="sign-in-form">
                    <div class="logo">
                        <img src="img/coctelapp/coctelapp.png" alt="Logo"/>
                    </div>

                    <div class="heading">
                        <h6 class="fw-bold">¿Aún no posee una cuenta?</h6>
                        <a href="#" class="toggle fw-bold">Presione aquí para registrarse.</a>
                    </div>

                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="text" minlength="4" id="email" name="usu" class="input-field" autocomplete="off" required />
                            <label><i class="fa-solid fa-envelope" style="color: #ffffff;"></i> Correo Electronico</label>
                        </div>

                        <div class="input-wrap">
                            <input type="password" minlength="4" id="password" name="pss" class="input-field" autocomplete="off" required />
                            <label><i class="fa-solid fa-lock" style="color: #ffffff;"></i> Contraseña</label>
                        </div>
                        <?php
				$err = isset($_GET['err']) ? $_GET['err']:NULL;
				if($err=='oK') echo "<span class='dtinv'>Datos invalidos</span>"
			?>

                        <input type="submit" value="Iniciar Sesión" class="sign-btn" />

                        <p class="text fw-bold">
                        ¿Ha olvidado su contraseña?
                            <a href="#" class="toggle fw-bold">Presione aquí para recuperarla.</a>
                        </p>
                    </div>
                </form>


                <form action="home.html" autocomplete="off" class="sign-up-form">
                    <div class="heading">
                        <h2>Registro</h2>
                        <h6 class="fw-bold">¿Ya tienes una cuenta?</h6>
                        <a href="#" class="toggle fw-bold">Iniciar Sesion</a>
                    </div>
                    <p class="text"><i class="fa-solid fa-circle-exclamation" style="color: #ff0000;"></i> Para BARES seleccione el tipo de documento NIT y NOMBRE del Bar</p>
                    <div class="actual-form">
                        <div class="input-wrap">
                            <select class="input-field" minlength="10" id="tipo_documento" required>
                                <option value="" disabled selected>Tipo de documento</option>
                                <option value="CC">CC</option>
                                <option value="NIT">NIT</option>
                                <option value="CE">CE</option>
                            </select>
                        </div>

                        <div class="input-wrap">
                            <input type="number" minlength="4" class="input-field" autocomplete="off" required />
                            <label><i class="fa-regular fa-address-card" style="color: #ffffff;"></i>  Numero Identificacion o NIT</label>
                        </div>

                        <div class="input-wrap">
                            <input type="text" minlength="4" class="input-field" autocomplete="off" required />
                            <label><i class="fa-solid fa-file-signature" style="color: #ffffff;"></i>  Nombre</label>
                        </div>

                        <div class="input-wrap">
                            <select class="input-field" id="ubicacion" required>
                                <option value="" disabled selected> Ubicacion Actual</option>
                                <option value="BOG">BOGOTA</option>
                                <option value="MED">MEDELLIN</option>
                                <option value="CART">CARTAGENA</option>
                            </select>
                        </div>

                        <div class="input-wrap">
                            <input type="email" class="input-field" autocomplete="off" required/>
                            <label><i class="fa-regular fa-envelope" style="color: #ffffff;"></i>  Correo Electronico</label>
                        </div>

                        <div class="input-wrap">
                            <input type="password" minlength="4" class="input-field" autocomplete="off" required />
                            <label><i class="fa-solid fa-lock" style="color: #ffffff;"></i>  Contraseña</label>
                        </div>

                        <input type="submit" value="Registrar" class="registro-btn" />
                    </div>
                </form>
                <form action="home.html" autocomplete="off" class="recovery-form" style="display: none;">
                    <div class="heading">
                        <h2>Cambiar Contraseña</h2>
                    </div>
                    <p class="text"><i class="fa-solid fa-circle-exclamation" style="color: #ff0000;"></i> Al momento de cambiar la contraseña confirma en el correo electronico la nueva contraseña.</p>
                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="text" minlength="4" id="email" name="tipo_usuario" class="input-field" autocomplete="off" required />
                            <label><i class="fa-regular fa-envelope" style="color: #ffffff;"></i>  Correo Electronico</label>
                        </div>
                        <div class="input-wrap">
                            <input type="number" minlength="4" id="password" name="password" class="input-field" autocomplete="off" required />
                            <label><i class="fa-regular fa-address-card" style="color: #ffffff;"></i>  Numero de Identificacion o NIT</label>
                        </div>
                        <div class="input-wrap">
                            <input type="password" minlength="4" id="password" name="password" class="input-field" autocomplete="off" required />
                            <label><i class="fa-solid fa-lock" style="color: #ffffff;"></i>  Nueva Contraseña</label>
                        </div>
                        <input type="submit" value="Cambiar Contraseña" class="recupcontra-btn" />
                    </div>
                    <p class="text fw-bold">
                        Ya tengo una cuenta <a href="#" class="toggle fw-bold" id="return-to-login"> Inicia Sesión</a>
                    </p>
                </form>
            </div>

            <div class="container-carousel text-center">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="5000">
                            <img src="img/coctelapp/pub1.jpg" >
                        </div>
                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="img/coctelapp/pub2.jpg" >
                        </div>
                        <div class="carousel-item" data-bs-interval="5000">
                            <img src="img/coctelapp/pub3.jpg" >
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

        </div>   
    </div>
</main>

<script src="js/loginreg.js"></script>