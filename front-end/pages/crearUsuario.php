<?php
require_once __DIR__ . '/../../back-end/auth/sesion.php';
requerir_admin();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario | Punto de Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body class="bg-light">

<?php include __DIR__ . '/../includes/navbar.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h4 class="m-0"><i class="fa-solid fa-user-plus"></i> Crear nuevo usuario</h4>
                </div>
                <div class="card-body p-4">

                    <?php if (isset($_SESSION['mensaje_exito'])): ?>
                        <div class="alert alert-success d-flex align-items-center">
                            <i class="fa-solid fa-check-circle me-2"></i>
                            <?= $_SESSION['mensaje_exito']; ?>
                        </div>
                        <?php unset($_SESSION['mensaje_exito']); ?>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['mensaje_error'])): ?>
                        <div class="alert alert-danger d-flex align-items-center">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            <?= $_SESSION['mensaje_error']; ?>
                        </div>
                        <?php unset($_SESSION['mensaje_error']); ?>
                    <?php endif; ?>

                    <form action="/punto-venta/back-end/routes/auth.php" method="POST">
                        <input type="hidden" name="accion" value="crear_usuario">

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nombre completo</label>
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre y Apellido" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Usuario (Login)</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-at"></i></span>
                                <input type="text" name="usuario" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Contraseña</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Rol</label>
                                <select name="rol" class="form-select">
                                    <option value="cajero">Cajero</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button class="btn btn-primary btn-lg" type="submit">
                                <i class="fa-solid fa-save"></i> Guardar Usuario
                            </button>
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