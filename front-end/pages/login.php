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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Punto de Venta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/punto-venta/front-end/assets/css/estilos.css">
</head>
<body class="d-flex align-items-center min-vh-100 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <div class="text-center mb-4">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="fa-solid fa-store fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-dark">Bienvenido</h2>
                        <p class="text-muted small">Ingresa tus credenciales para continuar</p>
                    </div>

                    <?php if (isset($_SESSION['error_login'])): ?>
                        <div class="alert alert-danger d-flex align-items-center small py-2" role="alert">
                            <i class="fa-solid fa-circle-exclamation me-2"></i>
                            <div><?= $_SESSION['error_login'] ?></div>
                        </div>
                        <?php unset($_SESSION['error_login']); ?>
                    <?php endif; ?>

                    <form action="/punto-venta/back-end/routes/auth.php" method="POST">
                        <input type="hidden" name="accion" value="login">

                        <div class="mb-3">
                            <label class="form-label text-muted fw-semibold font-monospace small">USUARIO</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0 text-primary"><i class="fa-solid fa-user"></i></span>
                                <input type="text" name="usuario" class="form-control bg-light border-start-0" placeholder="Ej. admin" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-muted fw-semibold font-monospace small">CONTRASEÑA</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-end-0 text-primary"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-start-0" placeholder="••••••" required>
                            </div>
                        </div>

                        <button class="btn btn-primary w-100 btn-lg fw-bold" type="submit">ENTRAR</button>
                    </form>
                </div>
                <div class="text-center mt-4 text-muted small">
                    &copy; <?= date('Y') ?> Punto de Venta Brito Ramirez
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>