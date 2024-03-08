<?php
    include_once("../model/usuario.php");
    include_once("../model/usuarioPrivilegio.php");
    include_once("screenBienvenida.php");
    class controlFormulario
    {
        public function CerrarSession()
        {   
            session_start();
            $_SESSION = [];
            session_destroy();
            header("Location: ../");
            exit();  
        }
        public function Home(){
            session_start();
            $login=$_SESSION['login'];
            $objUsuarioPrivilegio = new UsuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);

            if(!$listaPrivilegios)
            {
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje -> screenMensajeShow("ERROR:El usuario no existe,<br>el password esta errado o<br>el usuario esta inhabilitado ",
                                     "<a href='../index.php'>Ir al inicio</a>");
            }
            else
            {
                $objScreenBienvenida = new screenBienvenida();
                $objScreenBienvenida-> screenBienvenidaShow($listaPrivilegios);
            }
        }
        
    }
?>