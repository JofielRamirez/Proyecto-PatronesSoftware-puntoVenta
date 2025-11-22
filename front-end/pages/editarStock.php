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
    <title>Agregar Stock</title>
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body>

<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container">
    <h1>Agregar Stock a: <?= $producto['nombre'] ?></h1>

    <form action="/punto-venta/back-end/routes/productos.php" method="POST">
        <input type="hidden" name="id_producto" value="<?= $producto['id_producto'] ?>">

        <label>Cantidad a agregar</label>
        <input type="number" name="cantidad" min="1" required>

        <button class="btn" type="submit" name="accion" value="agregar_stock">Actualizar Stock</button>
    </form>

    <a class="btn" href="/punto-venta/back-end/routes/productos.php">Volver</a>
</div>

</body>
</html>
