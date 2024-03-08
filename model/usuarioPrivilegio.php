<?php
     include_once("conexion.php");

     class UsuarioPrivilegio extends Conexion
     {
         public function obtenerPrivilegios($login) 
         {
             $sql = "SELECT P.labelPrivilegio,
                            P.pathPrivilegio,
                            P.iconPrivilegio,
                            P.namePrivilegio
                     FROM usuarios U
                     INNER JOIN usuariosPrivilegios UP ON U.login = UP.login
                     INNER JOIN privilegios P ON P.idPrivilegio = UP.idPrivilegio
                     WHERE U.login = '$login'";
             
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
     }
     
?>