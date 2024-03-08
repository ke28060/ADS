<?php
include_once('conexion.php');

class Reporte extends Conexion
{
    public function calcularganacia()
{
    $this->conectarBD();

    $sql = "SELECT SUM(Total) AS TotalDelDia
             FROM boletas
             WHERE DATE(Fecha_Emision) = CURDATE()";

    $resultado = $this->conexion->query($sql);

    if ($resultado) {
        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            $totalDelDia = $fila['TotalDelDia'];
            $this->desConectarBD();
            return $totalDelDia; // Retorna la suma total del día
        } else {
            $this->desConectarBD();
            return 0; // No hay resultados para el día actual
        }
    } else {
        $this->desConectarBD();
        return null; // Retorna null si hay un error en la consulta
    }
}


    public function obteneridreporte() {
        $this->conectarBD();
        $numero = str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT); // Genera un número de 6 dígitos
        $sql = "SELECT COUNT(*) as total FROM reporte WHERE idReporte = '$numero'";
        $resultado = $this->conexion->query($sql);
        
        if ($resultado) {
            $fila = $resultado->fetch_assoc();
            $total = $fila['total'];
        
            if ($total > 0) {
                $this->desconectarBD();
                return $this->obteneridreporte(); // Si el número existe, genera otro recursivamente
            } else {
                $this->desconectarBD();
                return $numero; // Devuelve el número si no existe en la base de datos
            }
        } else {
            $this->desconectarBD();
            return $this->obteneridreporte(); // Si hay un error en la consulta, intenta generar otro número
        }
    }

    public function Guardarreporte($idReporte, $ganancia, $calculoganacia, $login){
        $this->conectarBD();
        $sql="INSERT INTO `reporte`(`idReporte`, `cantidad_ingresada`, `cantidad_calculada`, `empleado`) VALUES ('$idReporte','$ganancia','$calculoganacia','$login')";
        $resultado = $this->conexion->query($sql);

        if ($resultado) {
            $this->desConectarBD();
            return true;
        }else{
            $this->desconectarBD();
            return false;
        }
    
    }

    public function listarReporte()
        {
            $this->conectarBD();

            $sql = "SELECT idReporte, empleado
            FROM reporte";
            $resultado = $this->conexion->query($sql);

            if ($resultado) {
                $Reportes = array();
                while ($fila = $resultado->fetch_assoc()) {
                    $Reportes[] = $fila;
                }
                $this->desConectarBD();
                return $Reportes;
            } else {
                $this->desConectarBD();
                return null; // Retorna null si hay un error en la consulta
            }
        }

        public function EliminarReporte($idReporte)
        {
            $this->conectarBD();

            $sql = "DELETE FROM reporte WHERE idReporte = '$idReporte'";
            $resultado = $this->conexion->query($sql);

            if ($resultado) {
                $this->desConectarBD();
                return true;
            } else {
                $this->desConectarBD();
                return false; 
            }
        }

        public function Detallesdereporte($idReporte)
        {
            $this->conectarBD();

            $sql = "SELECT idReporte, cantidad_ingresada, cantidad_calculada, empleado
            FROM reporte
            WHERE idReporte = '$idReporte'";
            $resultado = $this->conexion->query($sql);

            if ($resultado && $resultado->num_rows > 0) {
                $detalles = $resultado->fetch_assoc();
                $this->desConectarBD();
                return $detalles;
            } else {
                $this->desConectarBD();
                return false; 
            }
        }

        public function productos($idReporte)
        {
            $this->conectarBD();

            $sql = "SELECT p.idproductos, p.nameproductos, p.imagen, p.cantidad, p.precio, p.idcategoria
            FROM productosreportados pr
            JOIN productos p ON pr.Idproducto = p.idproductos
            WHERE pr.idReporte = '$idReporte'";
            $resultado = $this->conexion->query($sql);

            if ($resultado) {
                $reporte = array();
                while ($fila = $resultado->fetch_assoc()) {
                    $reporte[] = $fila;
                }
                $this->desConectarBD();
                return $reporte;
            } else {
                $this->desConectarBD();
                return false; 
            }
        }
    }

?>