<?php
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
    <title>Punto de Venta</title>
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body>

<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container">
    <h1>Punto de Venta</h1>

    <?php if (isset($_SESSION['error'])) { ?>
        <p style="color:red; font-weight:bold;">
            <?= $_SESSION['error'] ?>
        </p>
        <?php unset($_SESSION['error']); ?>
    <?php } ?>

    <h3>Seleccionar producto</h3>

    <form action="/punto-venta/back-end/routes/ventas.php" method="POST">
        <select name="id_producto" required>
            <option value="">Seleccione...</option>

            <?php while($p = $productos->fetch_assoc()) { ?>
                <?php if ($p['stock'] > 0 && $p['activo'] == 1) { ?>
                    <option value="<?= $p['id_producto'] ?>">
                        <?= $p['nombre'] ?> — $<?= number_format($p['precio'], 2) ?> (Stock: <?= $p['stock'] ?>)
                    </option>
                <?php } ?>
            <?php } ?>
        </select>

        <input type="number" name="cantidad" min="1" value="1" required>
        <button class="btn" type="submit" name="accion" value="agregar">Agregar al carrito</button>
    </form>

    <hr>

    <h3>Carrito</h3>

    <table>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
        </tr>

        <?php
        $total = 0;
        foreach ($carrito as $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;
        ?>
            <tr>
                <td><?= $item['nombre'] ?></td>
                <td><?= $item['cantidad'] ?></td>
                <td>$<?= number_format($item['precio'], 2) ?></td>
                <td>$<?= number_format($subtotal, 2) ?></td>
            </tr>
        <?php } ?>
    </table>

    <h2>Total: $<?= number_format($total, 2) ?></h2>

    <?php if ($total > 0) { ?>
        <form action="/punto-venta/back-end/routes/ventas.php" method="POST">
            <button class="btn" type="submit" name="accion" value="confirmar">Confirmar Venta</button>
        </form>
    <?php } ?>

</div>

</body>
</html>
