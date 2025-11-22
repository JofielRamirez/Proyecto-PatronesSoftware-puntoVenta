<?php
require_once __DIR__ . '/../database/Conexion.php';

class Venta
{
    private $db;

    public function __construct()
    {
        $this->db = Conexion::getConexion();
    }

    public function crearVenta($total)
    {
        $stmt = $this->db->prepare("INSERT INTO ventas (total) VALUES (?)");
        $stmt->bind_param("d", $total);
        $stmt->execute();
        return $this->db->insert_id;
    }

    public function agregarDetalle($id_venta, $id_producto, $cantidad, $precio)
    {
        $stmt = $this->db->prepare("INSERT INTO detalle_venta (id_venta, id_producto, cantidad, precio) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiid", $id_venta, $id_producto, $cantidad, $precio);
        return $stmt->execute();
    }

    // ✅ Obtener encabezado para ticket
    public function obtenerTicket($id_venta)
    {
        $stmt = $this->db->prepare("SELECT * FROM ventas WHERE id_venta = ?");
        $stmt->bind_param("i", $id_venta);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // ✅ Obtener productos del ticket
    public function obtenerDetalle($id_venta)
    {
        $stmt = $this->db->prepare("
            SELECT p.nombre, dv.cantidad, dv.precio,
            (dv.cantidad * dv.precio) AS subtotal
            FROM detalle_venta dv
            INNER JOIN productos p ON dv.id_producto = p.id_producto
            WHERE dv.id_venta = ?
        ");
        $stmt->bind_param("i", $id_venta);
        $stmt->execute();
        return $stmt->get_result();
    }

    // ✅ Método necesario para ventasRegistradas.php
    public function obtenerTodas()
    {
        return $this->db->query("
            SELECT id_venta, fecha, total
            FROM ventas
            ORDER BY fecha DESC
        ");
    }
}
