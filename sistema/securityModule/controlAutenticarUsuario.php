<?
    include_once("../model/usuario.php");
    include_once("../model/usuarioPrivilegio.php");
    include_once("screenBienvenida.php");
    class controlAutenticarUsuario
    {
        public function validarUsuario($login,$password)
        {
            $objUsuario = new usuario();
            $resultado = $objUsuario->verificarUsuario($login,$password);
            if(!$resultado)
            {
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje -> screenMensajeShow("ERROR:El usuario no existe,<br>el password esta errado o<br>el usuario esta inhabilitado ",
                                     "<a href='../index.php'>Ir al inicio</a>");
            }
            else
            {
                $objUsuarioPrivilegio = new usuarioPrivilegio();
                $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
                //print_r($listaPrivilegios);
                //session_start();
                $_SESSION['login']=$login;
                $objScreenBienvenida = new screenBienvenida();
                $objScreenBienvenida-> screenBienvenidaShow($listaPrivilegios);
            }
        }
    }
?>