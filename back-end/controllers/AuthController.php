<?php
// back-end/controllers/AuthController.php

require_once __DIR__ . '/../database/Conexion.php';
require_once __DIR__ . '/../auth/sesion.php';

class AuthController {

    private $db;

    public function __construct() {
        $this->db = Conexion::getConexion();
    }

    public function login(): void {
        $usuario  = trim($_POST['usuario']  ?? '');
        $password = $_POST['password']      ?? '';

        if ($usuario === '' || $password === '') {
            $_SESSION['error_login'] = "Usuario y contraseña son obligatorios.";
            header('Location: /punto-venta/front-end/pages/login.php');
            exit;
        }

        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $hash = $row['password'];

            // Acepta contraseña en hash o en texto plano (para que puedas usar '123' rápido)
            if (password_verify($password, $hash) || $hash === $password) {
                iniciar_sesion($row);
                redirigir_segun_rol();
            }
        }

        $_SESSION['error_login'] = "Credenciales incorrectas.";
        header('Location: /punto-venta/front-end/pages/login.php');
        exit;
    }

    public function logout(): void {
        cerrar_sesion();
        header('Location: /punto-venta/front-end/pages/login.php');
        exit;
    }

    public function crearUsuario(): void {
        requerir_admin(); // Solo admin puede crear usuarios

        $nombre  = trim($_POST['nombre']  ?? '');
        $usuario = trim($_POST['usuario'] ?? '');
        $password = $_POST['password']    ?? '';
        $rol      = $_POST['rol']         ?? 'cajero';

        if ($nombre === '' || $usuario === '' || $password === '') {
            $_SESSION['mensaje_error'] = "Todos los campos son obligatorios.";
            header('Location: /punto-venta/front-end/pages/crearUsuario.php');
            exit;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare(
            "INSERT INTO usuarios (nombre, usuario, password, rol)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $nombre, $usuario, $hash, $rol);

        try {
            $stmt->execute();
            $_SESSION['mensaje_exito'] = "Usuario creado correctamente.";
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() === 1062) {
                $_SESSION['mensaje_error'] = "Ya existe un usuario con ese nombre de usuario.";
            } else {
                $_SESSION['mensaje_error'] = "Error al crear usuario.";
            }
        }

        header('Location: /punto-venta/front-end/pages/crearUsuario.php');
        exit;
    }
}
