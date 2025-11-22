<?php
require_once __DIR__ . '/../../back-end/auth/sesion.php';
requerir_admin();

require_once __DIR__ . '/../../back-end/models/Venta.php';

$ventaModel = new Venta();
$ventas = $ventaModel->obtenerTodas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas Registradas</title>
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body>

<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container">
    <h1>Ventas Registradas</h1>

    <table>
        <tr>
            <th>ID Venta</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Ticket</th>
        </tr>

        <?php while ($v = $ventas->fetch_assoc()) { ?>
            <tr>
                <td><?= $v['id_venta'] ?></td>
                <td><?= $v['fecha'] ?></td>
                <td>$<?= number_format($v['total'], 2) ?></td>
                <td>
                    <a class="btn" href="/punto-venta/front-end/pages/ticket.php?id_venta=<?= $v['id_venta'] ?>">
                        Ver Ticket
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
