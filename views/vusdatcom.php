<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("controllers/cusdatcom.php"); 
include("controllers/cbarxprod.php");
?>
<?php
// Iniciar sesión si aún no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Aquí puedes obtener datos si es necesario
$datOne = isset($datOne) ? $datOne : []; // Si $datOne no está definido, se asegura de que esté vacío.
?>
<br><br><br><br>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Métodos de Pago</title>
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            max-width: 100%;
        }

        .payment-container {
            background: linear-gradient(to right, #f7f7f7, #ffffff);
            background: rgba(255, 255, 255, 0.95);
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 45%;
            text-align: center;
        }

        .payment-container h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .products-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 20px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 45%;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 6px;
            box-sizing: border-box;
            outline: none;
            transition: all 0.3s;
        }

        .form-group input:focus, .form-group select:focus {
            border-color: #5a67d8;
            box-shadow: 0 0 5px rgba(90, 103, 216, 0.5);
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            background-color: #5a67d8;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #434190;
        }

        .payment-methods {
            margin-top: 15px;
        }

        .payment-methods div {
            margin-bottom: 10px;
        }

        #card-details, #nequi-details, #pse-details {
            display: none;
        }

        .products-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .products-table th, .products-table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .products-table th {
            background-color: #f2f2f2;
        }

        .total-price {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            text-align: right;
            color: #333;
        }
    </style>
     <script>
        // Función para mostrar/ocultar detalles según el método de pago seleccionado
        function togglePaymentDetails(method) {
            // Ocultar todos los detalles primero
            document.getElementById('card-details').style.display = 'none';

            // Mostrar solo los detalles correspondientes al método de pago seleccionado
            if (method === 'tarjeta') {
                document.getElementById('card-details').style.display = 'block';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <!-- Formulario de Métodos de Pago -->
        <div class="payment-container">
            <h2>Selecciona tu Método de Pago</h2>
            <form action="procesar_metodo_pago.php" method="POST">
                <div class="form-group">
                    <label for="metodo_pago">Método de Pago</label>
                    <select name="metodo_pago" id="metodo_pago" onchange="togglePaymentDetails(this.value)" required>
                        <option value="" disabled selected>Selecciona un método</option>
                        <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                    </select>
                </div>

                <!-- Detalles para tarjeta de crédito/débito -->
                <div id="card-details">
                    <div class="form-group">
                        <label for="nomtitu">Nombre del Titular</label>
                        <input type="text" id="nomtitu" name="nomtitu" value="<?= isset($datOne['nomtitu']) ? $datOne['nomtitu'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="numtarj">Número de Tarjeta</label>
                        <input type="text" name="numtarj" id="numtarj" value="<?= isset($datOne['numtarj']) ? $datOne['numtarj'] : ''; ?>" pattern="\d{16}" maxlength="16" required placeholder="1234 5678 9012 3456">
                    </div>
                    <div class="form-group">
                        <label for="fecvenci">Fecha de Vencimiento</label>
                        <input type="month" name="fecvenci" id="fecvenci" value="<?= isset($datOne['fecvenci']) ? $datOne['fecvenci'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="text" name="cvv" id="cvv" value="<?= isset($datOne['cvv']) ? $datOne['cvv'] : ''; ?>" required>
                    </div>
                </div>

                <!-- Detalles para Nequi 
                <div id="nequi-details">
                    <div class="form-group">
                        <label for="nequi">Número de Teléfono Nequi</label>
                        <input type="text" name="nequi" id="nequi" value="<?= isset($datOne['nequi']) ? $datOne['nequi'] : ''; ?>" pattern="\d{10}" maxlength="10" required placeholder="3001234567">
                    </div>
                </div>
                -->
                <!-- Detalles para PSE -->
                <div id="pse-details">
                    <div class="form-group">
                        <label for="banco">Banco</label>
                        <input type="text" name="banco" id="banco" value="<?= isset($datOne['banco']) ? $datOne['banco'] : ''; ?>" required placeholder="Nombre del Banco">
                    </div>
                    <div class="form-group">
                        <label for="cuenta">Número de Cuenta</label>
                        <input type="text" name="cuenta" id="cuenta" value="<?= isset($datOne['cuenta']) ? $datOne['cuenta'] : ''; ?>" required placeholder="Cuenta PSE">
                    </div>
                </div>
                <div class="form-group col-md-12">
                <br>
                <input class="btn btn-primary" type="submit" value="Realizar Compra">
                <input type="hidden" name="ope" value="save">
                <input type="hidden" name="idmetpago" id="idmetpago" value="<?php echo isset($datOne[0]['idmetpago']) ? $datOne[0]['idmetpago'] : ''; ?>">
            </div>
            </form>
        </div>

        <!-- Resumen de Compra -->
        <div class="products-container">
            <h2>Resumen de tu Compra</h2>
            
            <!-- Tabla de productos -->
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Producto</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $datAll = $mbarxprod->getAll(); // Método que obtiene todas las ciudades
                    foreach ($datAll as $dta) { ?>
                <tr>
                    <td>
                        <div style="display: flex; align-items: center;">
                            <?php if (!empty($dta["fotprod"]) && file_exists("img/" . $dta["fotprod"])) { ?>
                                <img src="img/<?=$dta["fotprod"];?>" width="120px" style="margin-right: 10px;">
                            <?php } else { ?>
                                <img src="img/coctelapp/logo.png" width="120px" style="margin-right: 10px;">
                            <?php } ?> 
                            <div>
                                <small>
                                    <strong>Valor producto: </strong><?=$dta['vlrprod'];?><br>
                                    <strong>Cantidad Producto: </strong><?=$dta['cantprod'];?><br>
                                    <strong>ID del bar: </strong><?=$dta['idbar'];?><br>
                                    <strong>Tipo de producto: </strong><?=$dta['tipoprod'];?><br>
                                </small>
                            </div>
                        </div>
                    </td>
                    <thead>
                    <tr>
                        <th>Producto</th>
                    </tr>
                </thead>
                </tr>
                <?php } ?>
            </tbody>
            </table>
            <?php
$total = 0;
$datAll = $mbarxprod->getAll(); // Método que obtiene todos los productos
foreach ($datAll as $dta) {
    $total += $dta['vlrprod'] * $dta['cantprod']; // Sumar el valor de cada producto
}
?>
            <!-- Precio Total -->
            <div class="total-price">
    <strong>Total a Pagar: </strong>$<?php echo number_format($total, 2); ?>
</div>
        </div>

    </div>
</body>
</html>