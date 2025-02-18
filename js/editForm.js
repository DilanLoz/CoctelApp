document.getElementById("editButton").addEventListener("click", function() {
    var editForm = document.getElementById("editForm");
    var icon = this.querySelector("i");

    // Mostrar u ocultar el formulario
    if (editForm.style.display === "none" || editForm.style.display === "") {
        editForm.style.display = "block";  // Mostrar el formulario
        icon.classList.remove("fa-pen-to-square");
        icon.classList.add("fa-minus");  // Cambiar a icono de "-"
    } else {
        editForm.style.display = "none";   // Ocultar el formulario
        icon.classList.remove("fa-minus");
        icon.classList.add("fa-pen-to-square");    // Cambiar a icono de "Editar"
    }
});