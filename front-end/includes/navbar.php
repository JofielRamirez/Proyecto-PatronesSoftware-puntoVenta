<?php
// front-end/includes/navbar.php
require_once __DIR__ . '/../../back-end/auth/sesion.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-4">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-cash-register me-2"></i> PV BRITO RAMIREZ</a>
        
        <?php if (usuario_autenticado()): ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/punto-venta/back-end/routes/productos.php"><i class="fa-solid fa-boxes-stacked"></i> Inventario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/punto-venta/front-end/pages/ventas.php"><i class="fa-solid fa-cart-shopping"></i> Punto de Venta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/punto-venta/front-end/pages/ventasRegistradas.php"><i class="fa-solid fa-file-invoice-dollar"></i> Historial</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center text-light gap-3">
                    <div class="small">
                        <i class="fa-solid fa-user-circle"></i> 
                        <?= htmlspecialchars($_SESSION['usuario']) ?> 
                        <span class="badge bg-info text-dark"><?= htmlspecialchars($_SESSION['rol']) ?></span>
                    </div>
                    <a href="/punto-venta/back-end/routes/auth.php?accion=logout" class="btn btn-danger btn-sm">
                        <i class="fa-solid fa-right-from-bracket"></i> Salir
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</nav>