<?php
require_once __DIR__ . '/../auth/sesion.php';
requerir_login();

require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Venta.php';

session_start();

$productoModel = new Producto();
$ventaModel = new Venta();

$accion = $_POST['accion'] ?? null;

// =========================================
// ✅ AGREGAR PRODUCTO AL CARRITO
// =========================================
if ($accion === "agregar") {

    $id_producto = $_POST['id_producto'];
    $cantidad = $_POST['cantidad'];

    $producto = $productoModel->obtenerPorId($id_producto);

    // Validar stock suficiente
    if ($producto['stock'] < $cantidad) {
        $_SESSION['error'] = "No hay suficiente stock para este producto.";
        header("Location: /punto-venta/front-end/pages/ventas.php");
        exit;
    }

    // Crear carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Agregar al carrito
    $_SESSION['carrito'][] = [
        'id' => $producto['id_producto'],
        'nombre' => $producto['nombre'],
        'precio' => $producto['precio'],
        'cantidad' => $cantidad
    ];

    header("Location: /punto-venta/front-end/pages/ventas.php");
    exit;
}


// =========================================
// ✅ CONFIRMAR VENTA
// =========================================
if ($accion === "confirmar") {

    if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
        $_SESSION['error'] = "El carrito está vacío.";
        header("Location: /punto-venta/front-end/pages/ventas.php");
        exit;
    }

    $total = 0;

    // Calcular total
    foreach ($_SESSION['carrito'] as $item) {
        $total += $item['precio'] * $item['cantidad'];
    }

    // Registrar venta
    $id_venta = $ventaModel->crearVenta($total);

    // Registrar detalles y descontar stock
    foreach ($_SESSION['carrito'] as $item) {

        // ✅ Guardar detalle correctamente
        $ventaModel->agregarDetalle(
            $id_venta,
            $item['id'],
            $item['cantidad'],
            $item['precio']
        );

        // ✅ Descontar stock
        $productoModel->descontarStock($item['id'], $item['cantidad']);
    }

    // ✅ Vaciar carrito
    unset($_SESSION['carrito']);

    // ✅ Redirigir al ticket
    header("Location: /punto-venta/front-end/pages/ticket.php?id_venta=" . $id_venta);
    exit;
}


// =========================================
// ✅ SI LLEGA AQUÍ, REGRESAR A VENTAS
// =========================================
header("Location: /punto-venta/front-end/pages/ventas.php");
exit;
