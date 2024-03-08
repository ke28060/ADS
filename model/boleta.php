<?php
     include_once("conexion.php");

     class Boleta extends Conexion
     {
         public function Boleta()
         {
             $sql = "INSERT INTO Clientes (NombresCliente, ApellidosCliente, DNICliente, TelefonoCliente)";
             
             $this->conectarBD();
             $resultado = $this->conexion->query($sql);

             if ($resultado) {
                 
                 $this->desConectarBD();
                 return TRUE;
             } else {
                 $this->desConectarBD();
                 return null;
             }
         }
        
         public function obtenerTotalBoleta($codigo) {
            $sql = "SELECT SUM(p.precio * pb.cantidad) AS total_boleta
                    FROM productosboleta pb
                    INNER JOIN productos p ON pb.producto_id = p.idproductos
                    WHERE pb.codigo = '$codigo'";
        
            $this->conectarBD();
            $resultado = $this->conexion->query($sql);
        
            if ($resultado) {
                if ($resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc();
                    $total_boleta = $row['total_boleta'];
                    $this->desConectarBD();
                    return $total_boleta;
                } else {
                    $this->desConectarBD();
                    return null;
                }
            } else {
                $this->desConectarBD();
                return null;
            }
        }

        public function CrearBoleta($total, $buscarid, $codigonuevo) {
            $sql = "INSERT INTO boletas (CodigoBoleta, idCliente, Total, detalles)
                    VALUES ('$codigonuevo', '$buscarid', '$total','Por atender')";
        
            $this->conectarBD();
            $resultado = $this->conexion->query($sql);
        
            if ($resultado) {
                $this->desConectarBD();
                return true; // La boleta se creó correctamente
            } else {
                $this->desConectarBD();
                return false; // Hubo un error al crear la boleta
            }
        }
        
        public function obtenerDetallesBoleta($codigonuevo) {
            $sql = "SELECT p.nameproductos, p.precio, pb.cantidad
                    FROM boletas b
                    INNER JOIN productosboleta pb ON b.CodigoBoleta = pb.codigo
                    INNER JOIN productos p ON pb.producto_id = p.idproductos
                    WHERE b.CodigoBoleta = '$codigonuevo'";
        
            $this->conectarBD();
            $resultado = $this->conexion->query($sql);
            $detalles_boleta = array();
            if ($resultado) {
                
                while ($row = $resultado->fetch_assoc()) {
                    $detalles_boleta[] = $row;
                }
                $this->desConectarBD();
                return $detalles_boleta;
            } else {
                $this->desConectarBD();
                return null;
            }
        }
        
        
        public function obtenerDatosCliente($codigonuevo) {
            $sql = "SELECT b.CodigoBoleta, b.Fecha_Emision, b.idCliente, b.Total,
                    c.idCliente, c.NombresCliente, c.ApellidosCliente, c.DNICliente, c.TelefonoCliente
                    FROM boletas b
                    INNER JOIN cliente c ON b.idCliente = c.idCliente
                    WHERE b.CodigoBoleta = '$codigonuevo'";
        
            $this->conectarBD();
            $resultado = $this->conexion->query($sql);
            if ($resultado && $resultado->num_rows > 0) {
                $cliente = $resultado->fetch_assoc();
                $this->desConectarBD();
                return $cliente;
            } else {
                $this->desConectarBD();
                return null;
            }
        }

        public function listarboletas(){
            $sql = "SELECT b.CodigoBoleta, b.Fecha_Emision, b.idCliente, b.Total, b.detalles,
                    CONCAT(c.NombresCliente, ' ', c.ApellidosCliente) AS NombreCliente
                    FROM boletas b
                    INNER JOIN cliente c ON b.idCliente = c.idCliente";

            $this->conectarBD();
            $resultado = $this->conexion->query($sql);
            $boletas = array();
            if ($resultado && $resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $boletas[] = $row;
                }
                $this->desConectarBD();
                return $boletas;
            } else {
                $this->desConectarBD();
                return null;
            }
        }

        public function modificarBoletaDetalles($codigo){
            $sql = "UPDATE boletas
            SET detalles = 'Atendido'
            WHERE CodigoBoleta = '$codigo'";

            $this->conectarBD();
            $resultado = $this->conexion->query($sql);
            if ($resultado) {
                $this->desConectarBD();
                return true; // La boleta se creó correctamente
            } else {
                $this->desConectarBD();
                return false; // Hubo un error al crear la boleta
            }
        }
         
     }
     
?>