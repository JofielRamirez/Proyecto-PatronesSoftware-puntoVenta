<?php
require_once __DIR__ . '/../controllers/ProductoController.php';

$controller = new ProductoController();

if (isset($_GET['desactivar'])) {
    $controller->desactivar();
    exit;
}

if (isset($_GET['activar'])) {
    $controller->activar();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $accion = $_POST['accion'] ?? '';

    if ($accion === "agregar_stock") {
        $controller->agregarStock();
        exit;
    }

    $controller->crear();
    exit;
}

$controller->listar();
