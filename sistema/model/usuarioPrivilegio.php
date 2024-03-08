<?
     include_once("conexion.php");
     class usuarioPrivilegio extends conexion
     {
        public function obtenerPrivilegios($login) 
        {
            $sql = "SELECT P.labelPrivilegio,
                           P.pathPrivilegio,
                           P.iconPrivilegio,
                           P.namePrivilegio
                    FROM usuarios U, privilegios P, usuariosPrivilegios UP
                    WHERE U.login = '$login' AND
                          U.login = UP.login AND
                          P.idPrivilegio = UP.idPrivilegio";
            //echo $sql;
            $this->conectarBD();
            $resultado = mysql_query($sql);
            $numFilas = mysql_num_rows($resultado);  
            $this->desConectarBD();
            for($i = 0; $i < $numFilas; $i++)
                $fila[$i] = mysql_fetch_array($resultado);
            return $fila;
        }       
     }
?>