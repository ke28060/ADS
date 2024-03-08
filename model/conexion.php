<?php
class Conexion
{
    protected $conexion;

    protected function conectarBD()
    {
        $servidor = "localhost";
        $usuario = "root";
        $password = ""; // Aquí debes colocar tu contraseña si la tienes, de lo contrario, deja el campo vacío
        $baseDatos = "sistema";

        // Crear una conexión usando MySQLi
        $this->conexion = new mysqli($servidor, $usuario, $password, $baseDatos);

        // Verificar si hay errores en la conexión
        if ($this->conexion->connect_error) {
            die("Error en la conexión: " . $this->conexion->connect_error);
        }
    }

    protected function desConectarBD()
    {
        // Cerrar la conexión si está abierta
        if ($this->conexion) {
            $this->conexion->close();
        }
    }
}


?>
