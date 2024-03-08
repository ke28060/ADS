<?php
     include_once("conexion.php");

     class reclamo extends Conexion
     {
        public function InsertarReclamo($comentarios, $numBoleta){
            $sql = "INSERT INTO reclamos (codigo_boleta, texto_reclamo) VALUES ('$numBoleta','$comentarios' )";
            $this->conectarBD();
            $resultado = $this->conexion->query($sql);
            if ($resultado) {
                $this->desConectarBD();
                return true;
            } else {
                $this->desConectarBD();
                return false;
            }
        }    
        
        public function listarReclamos()
        {
            $this->conectarBD();

            $sql = "SELECT codigo_boleta, texto_reclamo, fecha_creacion
                    FROM reclamos";
            $resultado = $this->conexion->query($sql);

            if ($resultado) {
                $Reclamos = array();
                while ($fila = $resultado->fetch_assoc()) {
                    $Reclamos[] = $fila;
                }
                $this->desConectarBD();
                return $Reclamos;
            } else {
                $this->desConectarBD();
                return null; // Retorna null si hay un error en la consulta
            }
        }
     }

     
?>