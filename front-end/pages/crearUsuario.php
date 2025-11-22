<?php
require_once __DIR__ . '/../../back-end/auth/sesion.php';
requerir_admin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear usuario</title>
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body>

<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container">
    <h1>Crear nuevo usuario</h1>

    <?php if (isset($_SESSION['mensaje_exito'])): ?>
        <p style="color:green; font-weight:bold;"><?= $_SESSION['mensaje_exito']; ?></p>
        <?php unset($_SESSION['mensaje_exito']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['mensaje_error'])): ?>
        <p style="color:red; font-weight:bold;"><?= $_SESSION['mensaje_error']; ?></p>
        <?php unset($_SESSION['mensaje_error']); ?>
    <?php endif; ?>

    <form action="/punto-venta/back-end/routes/auth.php" method="POST">
        <input type="hidden" name="accion" value="crear_usuario">

        <label>Nombre completo</label>
        <input type="text" name="nombre" required>

        <label>Usuario</label>
        <input type="text" name="usuario" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <label>Rol</label>
        <select name="rol">
            <option value="cajero">Cajero</option>
            <option value="admin">Administrador</option>
        </select>

        <button class="btn" type="submit">Crear usuario</button>
    </form>
</div>

</body>
</html>
