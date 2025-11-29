<?php
require_once __DIR__ . '/../../back-end/auth/sesion.php';
requerir_admin();

require_once __DIR__ . '/../../back-end/models/Producto.php';

$id = $_GET['id'] ?? 0;
$productoModel = new Producto();
$producto = $productoModel->obtenerPorId($id);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Stock</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body class="bg-light">

<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-body text-center p-5">
                    <div class="mb-4">
                        <i class="fa-solid fa-boxes-stacked fa-4x text-info mb-3"></i>
                        <h2 class="fw-bold"><?= htmlspecialchars($producto['nombre']) ?></h2>
                        <p class="text-muted">Stock actual: <strong><?= $producto['stock'] ?> unidades</strong></p>
                    </div>

                    <form action="/punto-venta/back-end/routes/productos.php" method="POST">
                        <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">

                        <div class="mb-4 text-start">
                            <label class="form-label fw-bold">Cantidad a agregar al inventario</label>
                            <input type="number" name="cantidad" class="form-control form-control-lg" min="1" placeholder="Ej. 10" required>
                            <div class="form-text">Ingresa solo la cantidad de productos nuevos que llegaron.</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-info text-white btn-lg" type="submit" name="accion" value="agregar_stock">
                                <i class="fa-solid fa-plus-circle"></i> Actualizar Stock
                            </button>
                            <a class="btn btn-light" href="/punto-venta/back-end/routes/productos.php">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>