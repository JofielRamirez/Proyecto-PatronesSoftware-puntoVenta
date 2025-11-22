<?php
require_once __DIR__ . '/../../back-end/auth/sesion.php';
requerir_admin(); // Solo admin ve el inventario
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body>

<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container">
    <h1>Productos</h1>

    <a href="/punto-venta/front-end/pages/agregarProducto.php" class="btn">Agregar Producto</a>
    <a href="/punto-venta/front-end/pages/crearUsuario.php" class="btn">Crear usuario</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        <?php while ($fila = $data->fetch_assoc()) { ?>
            <tr style="<?= $fila['activo'] == 0 ? 'background:#eee;color:gray;' : '' ?>">
                <td><?= $fila['id_producto'] ?></td>
                <td><?= $fila['nombre'] ?></td>
                <td>$<?= number_format($fila['precio'], 2) ?></td>
                <td><?= max(0, $fila['stock']) ?></td>
                <td><?= $fila['activo'] ? 'Activo' : 'Inactivo' ?></td>

                <td>
                    <a class="btn" href="/punto-venta/front-end/pages/editarStock.php?id=<?= $fila['id_producto'] ?>">Agregar Stock</a>

                    <?php if ($fila['activo']) { ?>
                        <a class="btn" style="background:#c0392b"
                           href="/punto-venta/back-end/routes/productos.php?desactivar=<?= $fila['id_producto'] ?>">
                           Desactivar
                        </a>
                    <?php } else { ?>
                        <a class="btn" style="background:#27ae60"
                           href="/punto-venta/back-end/routes/productos.php?activar=<?= $fila['id_producto'] ?>">
                           Activar
                        </a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
