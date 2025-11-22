<?php
require_once __DIR__ . '/back-end/auth/sesion.php';

if (usuario_autenticado()) {
    redirigir_segun_rol();
} else {
    header('Location: /punto-venta/front-end/pages/login.php');
    exit;
}
