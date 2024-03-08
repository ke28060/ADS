<?php
    include_once("conexion.php");

    class Usuario extends Conexion
    {
        public function verificarUsuario($login, $password)
        {
            $sql = "SELECT login FROM usuarios WHERE login = '$login' AND password = '$password' AND estado = 1";
            $this->conectarBD();
            $resultado = $this->conexion->query($sql);
    
            if ($resultado && $resultado->num_rows == 1) {
                $this->desConectarBD();
                return true;
            } else {
                $this->desConectarBD();
                return false;
            }
        }

        public function BuscarPregunta($login)
        {
            $sql = "SELECT pregunta FROM usuarios WHERE login = '$login'";
            $this->conectarBD();
            $resultado = $this->conexion->query($sql);

            if ($resultado && $resultado->num_rows == 1) {
                $fila = $resultado->fetch_assoc();
                $pregunta = $fila['pregunta'];
                $this->desConectarBD();
                return $pregunta; // Devuelve la pregunta encontrada
            } else {
                $this->desConectarBD();
                return false; // Si no se encuentra la pregunta, devuelve false
            }
        }

        public function ValidarRespuesta($login, $respuesta) {
            $sql = "SELECT COUNT(*) as count FROM usuarios WHERE login = '$login' AND respuesta = '$respuesta'";
            $this->conectarBD();
            $resultado = $this->conexion->query($sql);
        
            if ($resultado && $resultado->num_rows == 1) {
                $fila = $resultado->fetch_assoc();
                $count = $fila['count'];
                
                if ($count > 0) {
                    $this->desConectarBD();
                    return true; // Si se encontró una coincidencia, la respuesta es correcta
                } else {
                    $this->desConectarBD();
                    return false; // Si no se encontró ninguna coincidencia, la respuesta es incorrecta
                }
            } else {
                $this->desConectarBD();
                return false; // Si hay algún error o no se encontró el usuario, la respuesta es incorrecta
            }
        }

        public function CambiarPasswort($login, $newpasswort) {
            $sql = "UPDATE usuarios
                    SET password = '$newpasswort'
                    WHERE login = '$login'";
            $this->conectarBD();
            $resultado = $this->conexion->query($sql);
        
            if ($resultado && $this->conexion->affected_rows > 0) {
                $this->desConectarBD();
                return true; // La contraseña se actualizó correctamente
            } else {
                $this->desConectarBD();
                return false; // Si hay algún error o no se encontró el usuario, la respuesta es incorrecta
            }
        }
        
        public function listarUsuarios()
        {
            $this->conectarBD();

            $sql = "SELECT idusuarios, login, estado FROM usuarios WHERE login <> 'Gerente'";
            $resultado = $this->conexion->query($sql);

            if ($resultado) {
                $usuarios = array();
                while ($fila = $resultado->fetch_assoc()) {
                    $usuarios[] = $fila;
                }
                $this->desConectarBD();
                return $usuarios;
            } else {
                $this->desConectarBD();
                return null; // Retorna null si hay un error en la consulta
            }
        }

        public function ModificarDesabilitar($idusuarios)
        {
            $this->conectarBD();

            $sql = "UPDATE usuarios
            SET estado = 0
            WHERE idusuarios = '$idusuarios'";
            $resultado = $this->conexion->query($sql);

            if ($resultado) {
                $this->desConectarBD();
                return true;
            } else {
                $this->desConectarBD();
                return false;
            }
        }

        public function ModificarHabilitar($idusuarios)
        {
            $this->conectarBD();

            $sql = "UPDATE usuarios
            SET estado = 1 WHERE idusuarios = '$idusuarios'";
            $resultado = $this->conexion->query($sql);

            if ($resultado) {
                $this->desConectarBD();
                return true;
            } else {
                $this->desConectarBD();
                return false; 
            }
        }





    }


?>