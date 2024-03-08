<?php
include_once('conexion.php');

class ProductosReportados extends Conexion
{
    public function GuardarProductosCero($idReporte)
    {
        $this->conectarBD();

        $sql = "INSERT INTO productosreportados (Idproducto, idReporte)
        SELECT idproductos, '$idReporte' AS idReporte
        FROM productos
        WHERE cantidad = 0";

        $resultado = $this->conexion->query($sql);
        
        if ($resultado) {
            $this->desConectarBD();
            return true;
        } else {
            $this->desConectarBD();
            return NULL;
        }
    }
}
?>