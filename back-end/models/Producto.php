<?php
require_once __DIR__ . '/../database/Conexion.php';

class Producto {

    private $db;

    public function __construct() {
        $this->db = Conexion::getConexion();
    }

    public function obtenerTodos() {
        $sql = "SELECT * FROM productos ORDER BY id_producto DESC";
        return $this->db->query($sql);
    }

    public function obtenerActivos() {
        $sql = "SELECT * FROM productos WHERE activo = 1 ORDER BY id_producto DESC";
        return $this->db->query($sql);
    }

    public function obtenerPorId($id) {
        $stmt = $this->db->prepare("SELECT * FROM productos WHERE id_producto = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function crear($nombre, $descripcion, $precio, $stock) {
        $stmt = $this->db->prepare(
            "INSERT INTO productos (nombre, descripcion, precio, stock, activo)
             VALUES (?, ?, ?, ?, 1)"
        );
        $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $stock);
        return $stmt->execute();
    }

    public function agregarStock($id, $cantidad) {
        $stmt = $this->db->prepare("UPDATE productos SET stock = stock + ? WHERE id_producto = ?");
        $stmt->bind_param("ii", $cantidad, $id);
        return $stmt->execute();
    }

    public function desactivar($id) {
        $stmt = $this->db->prepare("UPDATE productos SET activo = 0 WHERE id_producto = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function activar($id) {
        $stmt = $this->db->prepare("UPDATE productos SET activo = 1 WHERE id_producto = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    public function descontarStock($id_producto, $cantidad)
{
    $stmt = $this->db->prepare("UPDATE productos SET stock = stock - ? WHERE id_producto = ?");
    $stmt->bind_param("ii", $cantidad, $id_producto);
    return $stmt->execute();
}

}
