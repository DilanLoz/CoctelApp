<?php
require_once('models/memhipe.php');


$idusu = isset($_SESSION['idusu']) ? $_SESSION['idusu'] : null;

// Instanciar el modelo
$memhipe = new Memhipe();

// Obtener la operación
$ope = isset($_REQUEST['ope']) ? $_REQUEST['ope'] : null;

switch ($ope) {
    case 'listar':
        // Obtener pedidos por usuario autenticado
        if ($idusu) {
            $pedidos = $memhipe->getPedidosByUsuario($idusu);
            include('views/vemhipe.php'); // Cargar la vista para mostrar los pedidos
        } else {
            die('No estás autenticado.');
        }
        break;

    case 'actualizar_estado':
        // Actualizar estado del pedido
        $idpedido = isset($_POST['idpedido']) ? $_POST['idpedido'] : null;
        $nuevoEstado = isset($_POST['estado']) ? $_POST['estado'] : null;
        if ($idpedido && $nuevoEstado) {
            $resultado = $memhipe->updateEstado($idpedido, $nuevoEstado);
            echo $resultado > 0 ? "Estado actualizado correctamente." : "No se pudo actualizar el estado.";
        } else {
            echo "Datos insuficientes para actualizar el estado.";
        }
        break;

    default:
        echo "Operación no válida.";
        break;
}
?>
