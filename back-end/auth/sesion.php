<?php
// back-end/auth/sesion.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function usuario_autenticado(): bool {
    return isset($_SESSION['id_usuario']);
}

function rol_es(string $rol): bool {
    return isset($_SESSION['rol']) && $_SESSION['rol'] === $rol;
}

function iniciar_sesion(array $usuario): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nombre']     = $usuario['nombre'];
    $_SESSION['usuario']    = $usuario['usuario'];
    $_SESSION['rol']        = $usuario['rol'];
}

function cerrar_sesion(): void {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    session_unset();
    session_destroy();
}

function requerir_login(): void {
    if (!usuario_autenticado()) {
        header('Location: /punto-venta/front-end/pages/login.php');
        exit;
    }
}

function requerir_admin(): void {
    requerir_login();

    if (!rol_es('admin')) {
        $_SESSION['error'] = "Solo los administradores pueden acceder a esta sección.";
        header('Location: /punto-venta/front-end/pages/ventas.php');
        exit;
    }
}

function redirigir_segun_rol(): void {
    if (rol_es('admin')) {
        header('Location: /punto-venta/back-end/routes/productos.php');
    } else {
        header('Location: /punto-venta/front-end/pages/ventas.php');
    }
    exit;
}
