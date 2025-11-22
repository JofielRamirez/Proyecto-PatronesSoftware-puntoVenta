<?php
require_once __DIR__ . '/../../back-end/auth/sesion.php';
requerir_admin(); // Solo admin ve el inventario
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
<body>

<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><i class="fa-solid fa-box-open"></i> Inventario</h1>
        <div>
            <a href="/punto-venta/front-end/pages/agregarProducto.php" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Nuevo Producto
            </a>
            <a href="/punto-venta/front-end/pages/crearUsuario.php" class="btn btn-outline-secondary ms-2">
                <i class="fa-solid fa-user-plus"></i> Crear Usuario
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $data->fetch_assoc()) { ?>
                        <tr class="<?= $fila['activo'] == 0 ? 'table-secondary text-muted' : '' ?>">
                            <td>#<?= $fila['id_producto'] ?></td>
                            <td class="fw-bold"><?= $fila['nombre'] ?></td>
                            <td>$<?= number_format($fila['precio'], 2) ?></td>
                            <td>
                                <span class="badge <?= $fila['stock'] < 5 ? 'bg-danger' : 'bg-success' ?>">
                                    <?= max(0, $fila['stock']) ?> u.
                                </span>
                            </td>
                            <td>
                                <?php if($fila['activo']): ?>
                                    <span class="badge bg-primary">Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a class="btn btn-sm btn-info text-white" href="/punto-venta/front-end/pages/editarStock.php?id=<?= $fila['id_producto'] ?>">
                                    <i class="fa-solid fa-boxes-packing"></i> Stock
                                </a>

                                <?php if ($fila['activo']) { ?>
                                    <a class="btn btn-sm btn-danger" href="/punto-venta/back-end/routes/productos.php?desactivar=<?= $fila['id_producto'] ?>" title="Desactivar">
                                       <i class="fa-solid fa-trash"></i>
                                    </a>
                                <?php } else { ?>
                                    <a class="btn btn-sm btn-success" href="/punto-venta/back-end/routes/productos.php?activar=<?= $fila['id_producto'] ?>" title="Activar">
                                       <i class="fa-solid fa-rotate-left"></i>
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
