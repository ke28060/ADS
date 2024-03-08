<?
    include_once("conexion.php");
    class usuario extends conexion
    {
        public function verificarUsuario($login,$password)
        {
            $sql = "select login from usuarios where login = '$login' and password = '$password' AND estado = 1 ";
            $this->conectarBD();
            $resultado = mysql_query($sql);
            $numFilas = mysql_num_rows($resultado);
            $this->desConectarBD();
            if($numFilas == 1)
                return true;
            else
                return false;
        }        
    }
?>