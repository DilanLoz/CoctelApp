function login() {
    var identificacion = document.getElementById('email').value;
    var contrasena = document.getElementById('password').value;
    if (identificacion.trim() === '' || contrasena.trim() === '') {
        alert('Por favor, complete todos los campos.');
        return;
    }

var tipo_actor;
if (identificacion === '1010') {
    tipo_actor = 'usuario';
} else if (identificacion === '2020') {
    tipo_actor = 'empleado';
} else if (identificacion === '3030') {
    tipo_actor = 'bar';
} else {
    alert('Identificación no válida. Ingrese un número de identificación válido.');
    return;
}

var contrasena_valida;
switch (tipo_actor) {
    case 'usuario':
    contrasena_valida = (contrasena === '12345');
    break;
    case 'empleado':
    contrasena_valida = (contrasena === '12345');
    break;
    case 'bar':
    contrasena_valida = (contrasena === '12345');
    break;
    default:
    contrasena_valida = false;
    break;
}

if (contrasena_valida) {
    switch (tipo_actor) {
    case 'usuario':
        window.location.href = 'home.php?pg=101';
        break;
    case 'empleado':
        window.location.href = 'home.php?pg=201';
        break;
    case 'bar':
        window.location.href = 'home.php?pg=301';
        break;
    }
} else {
    alert('Contraseña incorrecta. Por favor, inténtelo de nuevo.');
}
}

document.addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        if (document.activeElement.tagName === 'INPUT') {
            event.preventDefault();
            document.getElementById('loginForm').submit();
        }
    }
});


const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");

inputs.forEach((inp) => {
  inp.addEventListener("focus", () => {
    inp.classList.add("active");
  });
  inp.addEventListener("blur", () => {
    if (inp.value != "") return;
    inp.classList.remove("active");
  });
});

toggle_btn.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("sign-up-mode");
  });
});

function moveSlider() {
  let index = this.dataset.value;

  let currentImage = document.querySelector(`.img-${home}`);
  images.forEach((img) => img.classList.remove("show"));
  currentImage.classList.add("show");

  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(home - 1) * 2.2}rem)`;

  bullets.forEach((bull) => bull.classList.remove("active"));
  this.classList.add("active");
}

bullets.forEach((bullet) => {
  bullet.addEventListener("click", moveSlider);
});

//js de mostrar form dep del href
// Obtener los enlaces
const registerLink = document.querySelector('.sign-in-form .text a');
const forgotPasswordLink = document.querySelector('.sign-in-form .text a');

// Obtener los formularios
const signInForm = document.querySelector('.sign-in-form');
const signUpForm = document.querySelector('.sign-up-form');
const recoveryForm = document.querySelector('.recovery-form');

// Función para mostrar el formulario de registro y ocultar los demás
function showRegisterForm(event) {
    event.preventDefault();
    signInForm.style.display = 'none';
    recoveryForm.style.display = 'none';
    signUpForm.style.display = 'block';
}

// Función para mostrar el formulario de recuperación de contraseña y ocultar los demás
function showRecoveryForm(event) {
    event.preventDefault();
    signInForm.style.display = 'none';
    signUpForm.style.display = 'none';
    recoveryForm.style.display = 'block';
}

// Agregar eventos de clic a los enlaces
registerLink.addEventListener('click', showRegisterForm);
forgotPasswordLink.addEventListener('click', showRecoveryForm);

const returnToLoginLink = document.getElementById('return-to-login');

// Función para mostrar el formulario de inicio de sesión y ocultar el de recuperación de contraseña
function returnToLogin(event) {
    event.preventDefault();
    const recoveryForm = document.querySelector('.recovery-form');
    const signInForm = document.querySelector('.sign-in-form');
    recoveryForm.style.display = 'none';
    signInForm.style.display = 'block';
    signUpForm.style.display = 'block';
}

// Agregar evento de clic al enlace "Iniciar Sesión"
returnToLoginLink.addEventListener('click', returnToLogin);