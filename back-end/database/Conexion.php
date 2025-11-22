<?php
class Conexion {
    private static $conexion = null;

    public static function getConexion() {
        if (self::$conexion === null) {

            $host = "localhost";
            $user = "root";
            $pass = "Papermariottyd2";
            $db   = "punto_venta";

            self::$conexion = new mysqli($host, $user, $pass, $db);

            if (self::$conexion->connect_error) {
                die("Error de conexión: " . self::$conexion->connect_error);
            }
        }

        return self::$conexion;
    }
}

