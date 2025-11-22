<?php
// back-end/routes/auth.php

require_once __DIR__ . '/../controllers/AuthController.php';

$controller = new AuthController();

$accion = $_POST['accion'] ?? ($_GET['accion'] ?? '');

switch ($accion) {
    case 'login':
        $controller->login();
        break;

    case 'logout':
        $controller->logout();
        break;

    case 'crear_usuario':
        $controller->crearUsuario();
        break;

    default:
        header('Location: /punto-venta/front-end/pages/login.php');
        break;
}
