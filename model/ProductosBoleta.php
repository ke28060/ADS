<?php
include_once('conexion.php');

class ProductosBoleta extends Conexion
{
    
    public function DuplicarProductosBoleta($Codigo, $codigonuevo){
        $this->conectarBD();

        $sqlInsert = "INSERT INTO productosboleta (codigo, producto_id, cantidad)
            SELECT '$codigonuevo', p.producto_id, p.cantidad
            FROM proforma p
            WHERE p.codigo='$Codigo'";
    
        $resultadoInsert = $this->conexion->query($sqlInsert);
    
        if ($resultadoInsert) {
            $this->desconectarBD();
            return true; // Los datos se copiaron correctamente a productosboletas con el código único
        } else {
            $this->desconectarBD();
            return false; // Error al copiar los datos a productosboletas
        }
    }

    public function generarCodigoUnico() {
        $this->conectarBD();
        $numero = str_pad(rand(1, 999999999), 9, '0', STR_PAD_LEFT); // Genera un número de 11 dígito
        $sql = "SELECT COUNT(*) as total FROM productosboleta WHERE codigo = '$numero'";
        $resultado = $this->conexion->query($sql);
        
        if ($resultado) {
            $fila = $resultado->fetch_assoc();
            $total = $fila['total'];
        
            if ($total > 0) {
                $this->desconectarBD();
                return $this->generarCodigoUnico(); // Si el número existe, genera otro recursivamente
            } else {
                $this->desconectarBD();
                return $numero; // Devuelve el número si no existe en la base de datos
            }
        } else {
            $this->desconectarBD();
            return $this->generarCodigoUnico(); // Si hay un error en la consulta, intenta generar otro número
        }
    }
    
    
    
}
?>