<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/style.css">

<div class="container mt-5 col-12 col-md-8" id="detpedpq" style="text-align: left">
    <div class="mt-4">
        <h1 class="text-warning fw-bold" style="font-size: 30px"><i class="fa-solid fa-cart-shopping"></i> Carrito</h1>
        <div class="row">
            <div class="container rounded-3 me-4 mb-5 text-black" style="background-color: #fff;">
                
                <!-- Producto 1 -->
                <div class="row product-item pt-3 ps-3 pe-3 mt-2 rounded rounded-3 border border-secondary mb-3">
                    <div class="col-3 col-sm-2 d-flex justify-content-center">
                        <img src="img/logo.png" alt="" class="prodcar" draggable="false" style="width: 50px; height: 70px;">
                    </div>
                    <div class="col-7 col-sm-8">
                        <ul style="list-style-type: none; padding-left: 0;">
                            <li><b>Licor Sake Yaegaki</b></li>
                            <li><b style="font-size: 13px;">750ml</b></li>
                            <li><b class="text-warning">190.000</b></li>
                        </ul>
                    </div>
                    <div class="col-2 d-flex flex-column align-items-center justify-content-center">
                        <button class="trash" style="background-color: transparent; border-color: transparent; padding: 0;">
                            <i class="fa-solid fa-trash" style="color: #f00000;"></i>
                        </button>
                        <select class="selcprod" style="margin-top: 10px; width: 70px;" class=" form-control form-select">
                            <option selected>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select>
                    </div>
                </div>

                <!-- Cálculos y pagos -->
                <div class="mb-3 mt-3">
                    <div class="row">
                        <label class="col-7 col-md-9 col-form-label mt-2"><strong>Código de descuento</strong></label>
                        <input type="text" class="border-3 rounded border border-warning col-5 col-md-3 mt-3 text-end">
                    </div>
                    <div class="row mt-2">
                        <label class= col-6 col-md-4 col-form-label"><strong>Costo del envío</strong></label>
                        <label class="costenvio col-6 col-md-4 text-end p-2"><strong>$ 4.200</strong></label>
                    </div>
                    <div class="border rounded border-warning border-2 mt-2"></div>
                    <div class="row mt-2">
                        <label class="col-6 col-md-6 col-form-label"><strong>Total a pagar</strong></label>
                        <label class="col-6 col-md-6 text-end"><strong>$ 528.990</strong></label>
                    </div>
                    <div class="text-end mt-3">
                        <a href="vusdatcomp.php" class="btn btn-warning col-12 col-md-6">Ir a pagar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
