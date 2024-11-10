document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.querySelector(".navbar-toggler");
    const menu = document.querySelector(".navbar-collapse");

    // Alterna la clase 'show' y cambia el icono al hacer clic
    toggleButton.addEventListener("click", function () {
        menu.classList.toggle("show");

    });
});
