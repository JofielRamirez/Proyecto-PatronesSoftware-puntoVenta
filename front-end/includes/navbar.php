<?php
// front-end/includes/navbar.php
require_once __DIR__ . '/../../back-end/auth/sesion.php';
?>
<header class="navbar">
    <div class="navbar-title">
        PUNTO DE VENTA BRITO RAMIREZ
    </div>

    <?php if (usuario_autenticado()): ?>
        <nav class="navbar-links">
            <a href="/punto-venta/back-end/routes/productos.php">Inventario</a>
            <a href="/punto-venta/front-end/pages/ventas.php">Punto de venta</a>
            <a href="/punto-venta/front-end/pages/ventasRegistradas.php">Ventas registradas</a>
        </nav>

        <div class="navbar-user">
            <span>
                <?= htmlspecialchars($_SESSION['usuario']) ?>
                (<?= htmlspecialchars($_SESSION['rol']) ?>)
            </span>
            <a href="/punto-venta/back-end/routes/auth.php?accion=logout">Cerrar sesión</a>
        </div>
    <?php endif; ?>
</header>
