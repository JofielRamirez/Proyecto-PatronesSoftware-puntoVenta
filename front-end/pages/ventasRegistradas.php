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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body class="bg-light">

<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fa-solid fa-clipboard-list"></i> Historial de Ventas</h1>
        <button class="btn btn-outline-primary" onclick="window.print()"><i class="fa-solid fa-print"></i> Imprimir Reporte</button>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">ID Venta</th>
                            <th>Fecha y Hora</th>
                            <th class="text-end">Total</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($ventas && $ventas->num_rows > 0): ?>
                            <?php while ($v = $ventas->fetch_assoc()) { ?>
                                <tr>
                                    <td class="ps-4 fw-bold">#<?= $v['id_venta'] ?></td>
                                    <td>
                                        <i class="fa-regular fa-calendar me-1 text-muted"></i> 
                                        <?= date('d/m/Y H:i', strtotime($v['fecha'])) ?>
                                    </td>
                                    <td class="text-end fw-bold text-success">$<?= number_format($v['total'], 2) ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-outline-info" href="/punto-venta/front-end/pages/ticket.php?id_venta=<?= $v['id_venta'] ?>">
                                            <i class="fa-solid fa-receipt"></i> Ver Ticket
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted">No hay ventas registradas aún.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>