<?php
require_once __DIR__ . '/../../back-end/auth/sesion.php';
requerir_login();

require_once __DIR__ . '/../../back-end/models/Venta.php';

$id_venta = $_GET['id_venta'] ?? 0;
$ventaModel = new Venta();
$ticket = $ventaModel->obtenerTicket($id_venta);
$detalles = $ventaModel->obtenerDetalle($id_venta);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ticket de Venta</title>
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body>

<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container">
    <h1>Ticket de Venta</h1>

    <?php if ($ticket) { ?>
        <p><strong>ID Venta:</strong> <?= $ticket['id_venta'] ?></p>
        <p><strong>Fecha:</strong> <?= $ticket['fecha'] ?></p>
        <p><strong>Total:</strong> $<?= number_format($ticket['total'], 2) ?></p>

        <hr>

        <h3>Productos vendidos</h3>

        <table>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>

            <?php while ($d = $detalles->fetch_assoc()) { ?>
                <tr>
                    <td><?= $d['nombre'] ?></td>
                    <td><?= $d['cantidad'] ?></td>
                    <td>$<?= number_format($d['precio'], 2) ?></td>
                    <td>$<?= number_format($d['precio'] * $d['cantidad'], 2) ?></td>
                </tr>
            <?php } ?>
        </table>

    <?php } else { ?>
        <p>No se encontró la venta.</p>
    <?php } ?>

    <a class="btn" href="/punto-venta/front-end/pages/ventas.php">Nueva venta</a>
</div>

</body>
</html>
