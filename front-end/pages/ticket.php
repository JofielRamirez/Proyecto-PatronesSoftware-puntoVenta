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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket #<?= $id_venta ?> | Punto de Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
    
    <style>
        /* Estilos exclusivos para impresión */
        @media print {
            .no-print { display: none !important; }
            body, .bg-light { background-color: white !important; }
            .card { box-shadow: none !important; border: none !important; }
            .container { width: 100% !important; max-width: 100% !important; margin: 0 !important; padding: 0 !important; }
        }
        .receipt-font { font-family: 'Courier New', Courier, monospace; }
    </style>
</head>
<body class="bg-light">

<div class="no-print">
    <?php include __DIR__ . '/../includes/navbar.php'; ?>
</div>

<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <?php if ($ticket) { ?>
                <div class="card shadow border-0">
                    <div class="card-header bg-white text-center py-4 border-bottom-0">
                        <div class="mb-2">
                            <i class="fa-solid fa-store fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold m-0">COMPROBANTE DE VENTA</h4>
                        <p class="text-muted small m-0">Punto de Venta Brito Ramirez</p>
                    </div>

                    <div class="card-body p-4">
                        <div class="row mb-4 receipt-font bg-light p-3 rounded mx-1">
                            <div class="col-6">
                                <small class="text-muted d-block">FOLIO</small>
                                <span class="fw-bold">#<?= str_pad($ticket['id_venta'], 6, '0', STR_PAD_LEFT) ?></span>
                            </div>
                            <div class="col-6 text-end">
                                <small class="text-muted d-block">FECHA</small>
                                <span class="fw-bold"><?= date('d/m/Y H:i', strtotime($ticket['fecha'])) ?></span>
                            </div>
                        </div>

                        <h6 class="text-uppercase text-muted small fw-bold border-bottom pb-2 mb-3">Detalle de compra</h6>
                        
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless receipt-font align-middle">
                                <thead>
                                    <tr class="text-secondary border-bottom">
                                        <th style="width: 50%">Producto</th>
                                        <th class="text-center">Cant.</th>
                                        <th class="text-end">P.Unit</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($d = $detalles->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?= $d['nombre'] ?></td>
                                            <td class="text-center"><?= $d['cantidad'] ?></td>
                                            <td class="text-end">$<?= number_format($d['precio'], 2) ?></td>
                                            <td class="text-end fw-bold text-dark">$<?= number_format($d['precio'] * $d['cantidad'], 2) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 text-secondary m-0">TOTAL A PAGAR</span>
                            <span class="h2 text-success fw-bold m-0">$<?= number_format($ticket['total'], 2) ?></span>
                        </div>
                    </div>

                    <div class="card-footer bg-white p-4 border-top-0 no-print">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <button onclick="window.print()" class="btn btn-outline-secondary btn-lg">
                                <i class="fa-solid fa-print me-2"></i> Imprimir
                            </button>
                            <a href="/punto-venta/front-end/pages/ventas.php" class="btn btn-primary btn-lg">
                                <i class="fa-solid fa-cart-plus me-2"></i> Nueva Venta
                            </a>
                        </div>
                    </div>
                </div>

            <?php } else { ?>
                
                <div class="alert alert-warning d-flex align-items-center shadow-sm" role="alert">
                    <i class="fa-solid fa-triangle-exclamation fa-2x me-3"></i>
                    <div>
                        <h4 class="alert-heading">¡Venta no encontrada!</h4>
                        <p class="mb-0">El ticket que buscas no existe o ha sido eliminado.</p>
                        <hr>
                        <a href="/punto-venta/front-end/pages/ventas.php" class="btn btn-warning text-dark fw-bold">Volver al Punto de Venta</a>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>