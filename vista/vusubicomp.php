<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css">

<nav class="navbar navbar-expand-lg">
    <img src="../img/logo.png" alt="" class="navbar-brand mx-5" height="60px">
    <a href="vuscarcomp.php" class="btn btn-warning ms-auto mx-5">VOLVER</a>
</nav>
<div class="container mt-5">

    <form action="#" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="mt-3">
                        <img src="imgcoctellapp.png" alt="" class="img-fluid"
                            style="max-height: 200px; max-width: 100%;">
                    </div>
                    <h1 class="text-warning text-start fw-bold">Direccion del envio</h1>
                    <div class="col">
                        <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre">
                    </div>
                    <div class="col">
                        <select id="inputState" class="form-select" placeholder="Nombre" aria-label="Nombre">
                            <option>ciudad</option>
                            <option>Bogota</option>
                            <option>Medellin</option>
                            <option>Barranquilla</option>
                            <option>Cali</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Direccion residencial</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Direccion">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Direccion 2</label>
                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Direccion">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Mensaje de recomendaciones</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>

            </div>

            <div class="col-md-6 bg-black border rounded" id="detpedpq">
                <div class=" mt-4">
                    <h1 class="text-warning fw-bold">Detalles del pedido</h1>
                    <div style="border: 2px solid black; padding: 10px;">
                    <div class="row">
            <div class="col border rounded-5 me-4 bg-black" style="height: 650px;">
                <div class="pt-3 ps-3 pe-3 bg-white mt-4 rounded rounded-3" style="height: 100px;">
                    <div class="row">
                        <img class="col-1 p-0" src="" alt="" width="auto" height="auto">
                        <div class="col-9 me-3">
                            <ul style="list-style-type: none; padding-left: 0;" none;>
                                <li><b>Licor Sake Yaegaki</b></li>
                                <li><b style="font-size: 13px;">750ml</b></li>
                                <li><b class="text-warning">190.000</b></li>
                            </ul>
                        </div>
                        <div style="padding: 0%;" class="col-1">
                            <button class="border border-white" style="padding: 0%; margin-left: 50px;"><i class="fa-solid fa-trash" style="color: #f00000;"></i></button>
                            <select style="margin-top: 30px; width: 70px;" class="bg-black text-white" id="inputState" class="form-control">
                                <option selected>0</option>
                                <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="pt-3 ps-3 pe-3 bg-white mt-4 rounded rounded-3" style="height: 100px;">
                    <div class="row">
                        <img class="col-1 p-0" src="" alt="" width="auto" height="auto">
                        <div class="col-9 me-3">
                            <ul style="list-style-type: none; padding-left: 0;" none;>
                                <li><b>Vino Blanco Chradonnay</b></li>
                                <li><b style="font-size: 13px;">750ml</b></li>
                                <li><b class="text-warning">29.990</b></li>
                            </ul>
                        </div>
                        <div style="padding: 0%;" class="col-1">
                            <button class="border border-white" style="padding: 0%; margin-left: 50px;"><i class="fa-solid fa-trash" style="color: #f00000;"></i></button>
                            <select style="margin-top: 30px; width: 70px;" class="bg-black text-white" id="inputState" class="form-control">
                                <option selected>0</option>
                                <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="pt-3 ps-3 pe-3 bg-white mt-4 rounded rounded-3" style="height: 100px;">
                    <div class="row">
                        <img class="col-1 p-0" src="" alt="" width="auto" height="auto">
                        <div class="col-9 me-3">
                            <ul style="list-style-type: none; padding-left: 0;" none;>
                                <li><b>Tequila Herradura Añeja</b></li>
                                <li><b style="font-size: 13px;">700ml</b></li>
                                <li><b class="text-warning">304.800</b></li>
                            </ul>
                        </div>
                        <div style="padding: 0%;" class="col-1">
                            <button class="border border-white" style="padding: 0%; margin-left: 50px;"><i class="fa-solid fa-trash" style="color: #f00000;"></i></button>
                            <select style="margin-top: 30px; width: 70px;" class="bg-black text-white" id="inputState" class="form-control">
                                <option selected>0</option>
                                <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="border rounded border-warning border-2"></div>
                        <div class="mb-3 mt-3 row">
                            <div class="row">
                                <label for="inputPassword" class="col-md-6 col-form-label mt-2"><strong class="text-white">Codigo de descuento</strong></label>
                                <input for="inputPassword" class="border-3 rounded border-warning col-md-6 mt-3 text-end text-white"></input>
                            </div>
                            <label for="inputPassword" class="col-md-6 col-form-label mt-2"><strong class="text-white">Costo del envio</strong></label>
                            <label for="inputPassword" class="col-md-6 mt-3 text-end text-white"><strong>$ 4.200</strong></label>
                            <div class="border rounded border-warning border-2"></div>
                            <label for="inputPassword" class="col-md-6 col-form-label mt-2"><strong class="text-white">Total a pagar</strong></label>
                            <label for="inputPassword" class="col-md-6 mt-3 text-end text-white"><strong>$ 528.990</strong></label>
                            <div class="text-end mt-3">
                            <a href="vusdatcomp.php" class="btn btn-warning col-md-6">Ir a pagar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>
</div>