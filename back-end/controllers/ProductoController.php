<?php
require_once __DIR__ . '/../models/Producto.php';

class ProductoController {

    private $producto;

    public function __construct() {
        $this->producto = new Producto();
    }

    public function listar() {
        $data = $this->producto->obtenerTodos();
        include __DIR__ . '/../../front-end/pages/listaProductos.php';
    }

    public function crear() {
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $precio = $_POST['precio'] ?? 0;
        $stock  = $_POST['stock'] ?? 0;

        $this->producto->crear($nombre, $descripcion, $precio, $stock);

        header("Location: /punto-venta/back-end/routes/productos.php");
        exit;
    }

    public function agregarStock() {
        $id = $_POST['id_producto'];
        $cantidad = $_POST['cantidad'];

        $this->producto->agregarStock($id, $cantidad);

        header("Location: /punto-venta/back-end/routes/productos.php");
        exit;
    }

    public function desactivar() {
        $id = $_GET['desactivar'] ?? 0;
        $this->producto->desactivar($id);

        header("Location: /punto-venta/back-end/routes/productos.php");
        exit;
    }

    public function activar() {
        $id = $_GET['activar'] ?? 0;
        $this->producto->activar($id);

        header("Location: /punto-venta/back-end/routes/productos.php");
        exit;
    }
}
