<?php
require_once "models/conexion.php";
require_once "controllers/cbuscador.php";

if (isset($_GET['termino'])) {
    $termino = trim($_GET['termino']);
    
    $productoController = new ProductoController();
    $pedidoController = new PedidoController();

    $productos = $productoController->buscarProducto($termino);
    $pedidos = $pedidoController->buscarPedido($termino);

    // Retornamos productos y pedidos en un solo JSON
    echo json_encode(["productos" => $productos, "pedidos" => $pedidos]);
}
?>

<a id="logo-navegacion" target="_blank">
<img src="img/coctelapp/logo.png" id="logococtelapp">
<div class="barra-busqueda">
    <input type="text" id="input-buscar" placeholder="Buscar...">
    <button type="button" id="boton-buscar">
        <i class="fa-solid fa-magnifying-glass"></i>
    </button>
</div>
<div id="resultados-busqueda"></div>
</a>

<script>
function mostrarResultados(data) {
    let contenedor = document.getElementById("resultados-busqueda");
    contenedor.innerHTML = "";

    if (data.productos.length > 0 || data.pedidos.length > 0) {
        // Mostrar productos
        if (data.productos.length > 0) {
            let tituloProductos = document.createElement("h4");
            tituloProductos.textContent = "Productos";
            contenedor.appendChild(tituloProductos);

            data.productos.forEach(producto => {
                let item = document.createElement("div");
                item.classList.add("resultado-item");
                item.innerHTML = `
                    <img src="${producto.fotprod}" alt="${producto.nomprod}" width="50">
                    <p><strong>${producto.nomprod}</strong> - ${producto.vlrprod} - ${producto.nombar}</p>
                `;
                contenedor.appendChild(item);
            });
        }

        // Mostrar pedidos
        if (data.pedidos.length > 0) {
            let tituloPedidos = document.createElement("h4");
            tituloPedidos.textContent = "Pedidos";
            contenedor.appendChild(tituloPedidos);

            data.pedidos.forEach(pedido => {
                let item = document.createElement("div");
                item.classList.add("resultado-item");
                item.innerHTML = `<p>Pedido #${pedido.idpedido}</p>`;
                contenedor.appendChild(item);
            });
        }
    } else {
        contenedor.innerHTML = "<p>No se encontraron resultados</p>";
    }
}

</script>

<style>
.barra-busqueda {
    position: relative; /* Mantiene el buscador y resultados alineados */
    display: inline-block;
    width: 100%;
}

#resultados-busqueda {
    background: white;
    border: 1px solid #ddd;
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    max-height: 300px;
    overflow-y: auto;
    z-index: 1000;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

.resultado-item {
    padding: 10px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
}

.resultado-item:hover {
    background: #f0f0f0;
}

</style>
