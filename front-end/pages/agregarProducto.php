<?php
require_once __DIR__ . '/../../back-end/auth/sesion.php';
requerir_admin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body>

<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container">
    <h1>Agregar nuevo producto</h1>

    <form action="/punto-venta/back-end/routes/productos.php" method="POST">

        <label>Nombre</label>
        <input type="text" name="nombre" required>

        <label>Descripción</label>
        <input type="text" name="descripcion">

        <label>Precio</label>
        <input type="number" name="precio" step="0.01" required>

        <label>Stock inicial</label>
        <input type="number" name="stock" min="0" required>

        <button class="btn" type="submit">Guardar</button>
    </form>

    <a class="btn" href="/punto-venta/back-end/routes/productos.php">Volver</a>
</div>

</body>
</html>
