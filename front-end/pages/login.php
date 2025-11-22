<?php
require_once __DIR__ . '/../../back-end/auth/sesion.php';

if (usuario_autenticado()) {
    redirigir_segun_rol();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Punto de Venta</title>
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body>

<div class="container">
    <h1>Iniciar sesión</h1>

    <?php if (isset($_SESSION['error_login'])): ?>
        <p style="color:red; font-weight:bold;">
            <?= $_SESSION['error_login'] ?>
        </p>
        <?php unset($_SESSION['error_login']); ?>
    <?php endif; ?>

    <form action="/punto-venta/back-end/routes/auth.php" method="POST">
        <input type="hidden" name="accion" value="login">

        <label>Usuario</label>
        <input type="text" name="usuario" required>

        <label>Contraseña</label>
        <input type="password" name="password" required>

        <button class="btn" type="submit">Entrar</button>
    </form>


</div>

</body>
</html>
