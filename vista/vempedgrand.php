<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css">
<div class="container mt-3 mb-5">
  <div class="row">
    <div class="col-md-6">
      <div class="col bg py-3">
        <h1 class="text-dark">No. de Pedido: 020239</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 start">
        <div class="border border-warning border-3"></div>
        <h3>Detalles de Pedido</h3>
        <h5>* Ron Caldas</h5>
        <h5>* Aguardiente Antioqueño</h5>
        <h5>* Vino Blanco</h5>                   
      </div>
      <div class="col-md-6 end">
        <div class="mb-3">
          <h5>Direccion: (Bogota) Calle Primavera #123,</h5>
        </div>
        <div class="mb-3">
        <h5>Tel. Cliente: 123 456 7843</h5>
        </div>
        <div class="mb-3">
          <h5>Cantidad de Productos: 4</h5>
        </div>
        <div class="mb-3">
          <h3>Ganancias por el Pedido: $4.000</h3>
        </div>
        <div class="text-end mt-3">
            <button class="btn btn-warning" onclick="mostrarAlerta()">Aceptar Pedido</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    function mostrarAlerta() {
    var resultado = confirm("¿Estás seguro de aceptar el pedido?");
    if (resultado) {
        alert("Pedido aceptado correctamente.");
    } else {
    }
    }
  </script>
  <script src="js/alertas.js"></script>
</div>
