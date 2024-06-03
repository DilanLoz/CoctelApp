// Función para mostrar una alerta de éxito
function mostrarAlertaExitosa(mensaje) {
    alert(mensaje);
}


var btnActualizar = document.getElementById('actualizarBtn');
if (btnActualizar) {
    btnActualizar.addEventListener('click', function() {
        mostrarAlertaExitosa('¡Los datos han sido actualizados exitosamente!');
    });
}


var btnCrearProducto = document.getElementById('crearprodBtn');
if (btnCrearProducto) {
    btnCrearProducto.addEventListener('click', function() {
        mostrarAlertaExitosa('¡Has creado un producto exitosamente!');
    });
}


var btnCrearEmpleado = document.getElementById('crearemBtn');
if (btnCrearEmpleado) {
    btnCrearEmpleado.addEventListener('click', function() {
        mostrarAlertaExitosa('¡Has creado un empleado exitosamente!');
    });
}

function confirmped() {
    var resultado = confirm("¿Estás seguro de aceptar el pedido?");
    if (resultado) {
        alert("Pedido aceptado correctamente.");
    } else {
        // No hacemos nada si el usuario cancela
    }
}




