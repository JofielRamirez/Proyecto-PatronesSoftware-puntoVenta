<?php
// 1. Lógica de PHP (Mantén esto igual)
require_once __DIR__ . '/../../back-end/auth/sesion.php';
requerir_login();

require_once __DIR__ . '/../../back-end/models/Producto.php';

$productoModel = new Producto();
$productos = $productoModel->obtenerActivos();
$carrito = $_SESSION['carrito'] ?? [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto de Venta</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body class="bg-light">

    <?php include __DIR__ . '/../includes/navbar.php'; ?>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card p-4 mb-4 shadow-sm border-0">
                    <h4 class="mb-3 text-primary"><i class="fa-solid fa-barcode"></i> Agregar Producto</h4>
                    
                    <?php if (isset($_SESSION['error'])) { ?>
                        <div class="alert alert-danger d-flex align-items-center">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            <?= $_SESSION['error'] ?>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php } ?>

                    <form action="/punto-venta/back-end/routes/ventas.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Buscar Producto</label>
                            <select name="id_producto" class="form-select form-select-lg" required>
                                <option value="">Seleccione...</option>
                                <?php 
                                // Aseguramos que el puntero esté al inicio
                                if($productos) { mysqli_data_seek($productos, 0); }
                                while($p = $productos->fetch_assoc()) { 
                                ?>
                                    <?php if ($p['stock'] > 0 && $p['activo'] == 1) { ?>
                                        <option value="<?= $p['id_producto'] ?>">
                                            <?= $p['nombre'] ?> — $<?= number_format($p['precio'], 2) ?> (Stock: <?= $p['stock'] ?>)
                                        </option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Cantidad</label>
                            <input type="number" name="cantidad" class="form-control form-control-lg" min="1" value="1" required>
                        </div>

                        <button class="btn btn-primary w-100 btn-lg" type="submit" name="accion" value="agregar">
                            <i class="fa-solid fa-plus-circle"></i> Agregar al Carrito
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card p-4 shadow-sm border-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="m-0 text-secondary"><i class="fa-solid fa-cart-shopping"></i> Carrito Actual</h3>
                        <span class="badge bg-primary rounded-pill"><?= count($carrito) ?> items</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Producto</th>
                                    <th class="text-center">Cant.</th>
                                    <th class="text-end">Precio Unit.</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $total = 0;
                                if(empty($carrito)): ?>
                                    <tr><td colspan="4" class="text-center py-5 text-muted fs-5">
                                        <i class="fa-solid fa-basket-shopping fa-2x mb-2 d-block"></i>
                                        El carrito está vacío
                                    </td></tr>
                                <?php else:
                                    foreach ($carrito as $item) {
                                        $subtotal = $item['precio'] * $item['cantidad'];
                                        $total += $subtotal;
                                ?>
                                    <tr>
                                        <td class="fw-500"><?= $item['nombre'] ?></td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark border"><?= $item['cantidad'] ?></span>
                                        </td>
                                        <td class="text-end text-muted">$<?= number_format($item['precio'], 2) ?></td>
                                        <td class="text-end fw-bold">$<?= number_format($subtotal, 2) ?></td>
                                    </tr>
                                <?php } endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                        <h2 class="text-success fw-bold m-0">Total: $<?= number_format($total, 2) ?></h2>
                        
                        <?php if ($total > 0) { ?>
                            <form action="/punto-venta/back-end/routes/ventas.php" method="POST">
                                <button class="btn btn-success btn-lg px-5 shadow" type="submit" name="accion" value="confirmar">
                                    <i class="fa-solid fa-check-circle"></i> Cobrar
                                </button>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>