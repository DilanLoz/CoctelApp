<?php
require_once ( __DIR__ . '/../models/conexion.php');
require_once ( __DIR__ . '/../models/mbarxprod.php');

$mbarxprod = new Mbarxprod();
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <h1 style="text-align: left; display: block;"><i class="fa-solid fa-shop"></i> Bares</h1>
       
        <!-- Bar 1 -->
        <div class="col-md-3 mt-4">
            <div class="imguno rounded">
                <a href="views/vusbarxprod.php?id=1"><img src="img/bar1.jpg" alt="baruno" class="img-fluid rounded"></a>
            </div>
            <div class="text-center">
                <h4 class="fw-bold">Bar del Norte</h4>
                <div>
                    <h6 class="d-inline"> <i class="fa-solid fa-location-dot"></i> Dirección: Calle del Norte, 123</h6>
                </div>
                <div>
                    <h6 class="d-inline"><i class="fa-regular fa-clock"></i> Horario: 10:00 AM - 11:00 PM</h6>
                </div>
                <a href="views/vusbarxprod.php?id=1" class="col-md-8 btn btn-warning mt-2 btn-block">Ver más</a>
            </div>
        </div>

        <!-- Bar 2 -->
        <div class="col-md-3 mt-4">
            <div class="imguno rounded">
                <a href="views/vusbarxprod.php?id=2"><img src="img/bar2.jpg" alt="bardos" class="img-fluid rounded"></a>
            </div>
            <div class="text-center">
                <h4 class="fw-bold">Bazzar</h4>
                <div>
                    <h6 class="d-inline"> <i class="fa-solid fa-location-dot"></i> Dirección: Calle de la Playa, 456</h6>
                </div>
                <div>
                    <h6 class="d-inline"><i class="fa-regular fa-clock"></i> Horario: 9:00 AM - 12:00 AM</h6>
                </div>
                <a href="views/vusbarxprod.php?id=2" class="col-md-8 btn btn-warning mt-2 btn-block">Ver más</a>
            </div>
        </div>

        <!-- Bar 3 -->
        <div class="col-md-3 mt-4">
            <div class="imguno rounded">
                <a href="views/vusbarxprod.php?id=3"><img src="img/bar3.jpg" alt="bartres" class="img-fluid rounded"></a>
            </div>
            <div class="text-center">
                <h4 class="fw-bold">Coctelería Mar</h4>
                <div>
                    <h6 class="d-inline"> <i class="fa-solid fa-location-dot"></i> Dirección: Paseo Marítimo, 789</h6>
                </div>
                <div>
                    <h6 class="d-inline"><i class="fa-regular fa-clock"></i> Horario: 12:00 PM - 2:00 AM</h6>
                </div>
                <a href="views/vusbarxprod.php?id=3" class="col-md-8 btn btn-warning mt-2 btn-block">Ver más</a>
            </div>
        </div>

        <!-- Bar 4 -->
        <div class="col-md-3 mt-4">
            <div class="imguno rounded">
                <a href="views/vusbarxprod.php?id=4"><img src="img/bar4.jpg" alt="barcuatro" class="img-fluid rounded"></a>
            </div>
            <div class="text-center">
                <h4 class="fw-bold">Bar Playas</h4>
                <div>
                    <h6 class="d-inline"> <i class="fa-solid fa-location-dot"></i> Dirección: Playa Central, 101</h6>
                </div>
                <div>
                    <h6 class="d-inline"><i class="fa-regular fa-clock"></i> Horario: 11:00 AM - 1:00 AM</h6>
                </div>
                <a href="views/vusbarxprod.php?id=4" class="col-md-8 btn btn-warning mt-2 btn-block">Ver más</a>
            </div>
        </div>
    </div>
</div>
