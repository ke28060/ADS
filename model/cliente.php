<?php
     include_once("conexion.php");

     class Cliente extends Conexion
     {
        public function cliente($nombres, $apellidos, $dni, $telefono) {
            $this->conectarBD();
            $sql_buscar = "SELECT idCliente FROM cliente WHERE DNICliente = '$dni'";
            $resultado_buscar = $this->conexion->query($sql_buscar);
            
            if ($resultado_buscar && $resultado_buscar->num_rows > 0) {
                // Si el cliente existe, retornar su idCliente
                $fila = $resultado_buscar->fetch_assoc();
                return $fila['idCliente'];
            } else {
                // Si el cliente no existe, insertar y luego obtener su idCliente
                $sql_insertar = "INSERT INTO cliente (NombresCliente, ApellidosCliente, DNICliente, TelefonoCliente) 
                                 VALUES ('$nombres', '$apellidos', '$dni', '$telefono')";
                $resultado_insertar = $this->conexion->query($sql_insertar);
                
                if ($resultado_insertar) {
                    // Después de insertar, buscar nuevamente para obtener el idCliente recién insertado
                    $sql_nuevo = "SELECT idCliente FROM cliente WHERE DNICliente = '$dni'";
                    $resultado_nuevo = $this->conexion->query($sql_nuevo);
                    
                    if ($resultado_nuevo && $resultado_nuevo->num_rows > 0) {
                        $fila_nuevo = $resultado_nuevo->fetch_assoc();
                        return $fila_nuevo['idCliente'];
                    }
                }
            }
            
        }
        
         
        
     }
     
?>