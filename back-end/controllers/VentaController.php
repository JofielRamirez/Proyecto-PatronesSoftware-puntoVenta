<?php
require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../models/Producto.php';

class VentaController {

    public function agregarAlCarrito() {
        session_start();
        $id_producto = $_POST['id_producto'];
        $cantidadSolicitada = intval($_POST['cantidad']);

        $productoModel = new Producto();
        $producto = $productoModel->obtenerPorId($id_producto);

        if (!$producto) {
            $_SESSION['error'] = "Producto no encontrado.";
            header("Location: /punto-venta/front-end/pages/ventas.php");
            exit;
        }

        $stockDisponible = intval($producto['stock']);

        // Validación principal
        if ($cantidadSolicitada > $stockDisponible) {
            $_SESSION['error'] = "No hay suficiente stock para este producto. Stock disponible: $stockDisponible";
            header("Location: /punto-venta/front-end/pages/ventas.php");
            exit;
        }

        // Agregar al carrito
        $_SESSION['carrito'][] = [
            'id_producto' => $id_producto,
            'nombre' => $producto['nombre'],
            'precio' => $producto['precio'],
            'cantidad' => $cantidadSolicitada
        ];

        header("Location: /punto-venta/front-end/pages/ventas.php");
        exit;
    }

    public function confirmarVenta() {
        session_start();
        $carrito = $_SESSION['carrito'] ?? [];

        if (empty($carrito)) {
            $_SESSION['error'] = "No hay elementos en el carrito.";
            header("Location: /punto-venta/front-end/pages/ventas.php");
            exit;
        }

        $ventaModel = new Venta();
        $id_venta = $ventaModel->crearVenta($carrito);

        unset($_SESSION['carrito']);

        header("Location: /punto-venta/front-end/pages/ticket.php?id_venta=$id_venta");
        exit;
    }
}
