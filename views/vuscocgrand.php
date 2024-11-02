<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../style.css">
<!-- LE FALTA TERMINAR BIEN LA DISTRIBUCION (RESPONSIVE)-->
<div class="container mb-5">
    <div class="row">
        <div class="col-md-4 mt-5">
            <img src="../img/refimg.png" alt="coctel" class="img-fluid" id="imagenCoctel">
            <div class="col-2 mt-4 mb-3 border border-black border-4 rounded-3 text-center" id="imagenReferencia">
                <h4>IMAGEN REFERENCIAL</h4>
            </div>
        </div>
        <div class="col-8">
            <div class="ms-5 mt-5">
                <h1><b>Negroni</b></h1>
                <button id="btnSi" class="btn border border-warning border-3 rounded-3 mt-4">
                    <h3><center>SI</center></h3>
                </button>
                <button id="btnNo" class="btn border border-warning border-3 rounded-3 mt-4">
                    <h3><center>NO</center></h3>
                </button>
                <div class="mt-4">
                    <h4><p>Seleccione SI quiere servicio de bartender a domicilio.</p></h4>
                    <h4><p>Por lo contrario la selección NO, el coctel sería de un tamaño ya determinado.</p></h4>
                </div>
                <div class="col-10 border border-warning border-3 rounded-3 mt-4"></div>
                <div class="accordion accordion-flush mt-4" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Información de forma de envío
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border border-warning border-3 rounded-3 mt-5"></div>
            <div class="row">
                <div class="col-md-6 mt-4 text-md-start text-center">
                    <h1 class="fw-bold">$24.990</h1>
                </div>
                <div class="col-md-6 mt-md-5 mt-1">
                    <div class="border border-warning border-3 rounded-3 text-center">
                        Bar playas
                    </div>
                    <div class="text-center mt-1" id="contenedordeventa">
                        -DISTRIBUIDOR -
                    </div>
                </div>
            </div>
            <div class="row">
                <button class="col btn border border-warning border-3 rounded-3 mt-4">
                    <h3><center>Agregar al carrito</center></h3>
                </button>
                <button class="col mt-4 ms-4 border border-warning border-3 rounded-3 bg-warning">
                    <h3><center>Comprar</center></h3>
                </button>
            </div>
            <div class="mt-5">
                <h4>Ciudad de venta: Bogotá</h4>
            </div>
            <div style="margin-top: 50px;">
                <h3 class="fw-bold">Descripción del producto</h3>
                <h5>• ⅔ parte de Campari.</h5>
                <h5>• ⅔ parte de ginebra.</h5>
                <h5>• ⅔ parte de vermouth rosso.</h5>
                <h5>• 1 naranja.</h5>
                <h5>• Hielo.</h5>
            </div>
        </div>
    </div>
</div>
