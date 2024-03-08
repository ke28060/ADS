<?php
include_once("conexion.php");
class Proforma extends Conexion
{
    public function listarProformas() {
        $this->conectarBD();
    
        $sql = "SELECT DISTINCT codigo FROM proforma";
    
        $resultado = $this->conexion->query($sql);
    
        $codigos = array();
    
        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $codigos[] = $fila;
            }
            $this->desConectarBD();
            return $codigos;
        }
        else {
            $this->desConectarBD();
            return null;
        }
    }
    public function BuscarCodigo($Busqueda)
    {
        $sql = "SELECT DISTINCT codigo FROM proforma WHERE codigo LIKE '%$Busqueda%'";
        $this->conectarBD();
        $resultado = $this->conexion->query($sql);

        $codigosEncontrados = array();

        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $codigosEncontrados[] = $fila;
            }
            $this->desConectarBD();
            return $codigosEncontrados; // Devuelve los códigos encontrados
        } else {
            $this->desConectarBD();
            return array(); // Devuelve un array vacío si no se encuentran códigos
        }
    }

    public function obtenerProformas($Codigo) 
    {
        $sql = "SELECT p.idproductos, p.nameproductos, p.precio, pr.cantidad AS cantidad_en_proforma
                FROM productos p
                INNER JOIN proforma pr ON p.idproductos = pr.producto_id
                WHERE pr.codigo = '$Codigo'";
             
        $this->conectarBD();
        $resultado = $this->conexion->query($sql);
     
        $filas = array();
        if ($resultado) {
            while ($fila = $resultado->fetch_assoc()) {
                $filas[] = $fila;
            }
            $this->desConectarBD();
            return $filas;
        } else {
            $this->desConectarBD();
            return null;
        }
    }

    public function Eliminar($Codigo){
        $this->conectarBD();

        $sqlDelete = "DELETE FROM proforma WHERE codigo = '$Codigo'";
        $resultadoDelete = $this->conexion->query($sqlDelete);

        $this->desConectarBD();

        return $resultadoDelete;


    }
    
    
}
?>