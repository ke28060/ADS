<?php

    include_once("../model/usuario.php");
    include_once("../model/usuarioPrivilegio.php");
    include_once("screenBienvenida.php");
    include_once("formPreguntaSecreta.php");
    include_once("formCambiarClave.php");
    class controladorRecuperarClave
    {
        public function buscarPregunta($login)
        {
            $objUsuario = new usuario();
            $resultado = $objUsuario->BuscarPregunta($login);
            if(!$resultado)
            {
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje -> screenMensajeShow("ERROR:El usuario no existe,<br>o no se encontro reintentar ",
                                     "<a href='../index.php'>Ir al inicio</a>");
            }
            else
            {
                
                setcookie('usuario_autenticado', $login, time() + (86400 * 30), '/');
                session_start();
                $_SESSION['login']=$login;

                    $objPregunta = new formPreguntaSecreta();
                    $objPregunta -> formPruntaSecretaShow($resultado,$login);
            }
        }
        public function VerificarRespuesta($respuesta){
            session_start();
            $login=$_SESSION['login'];
            $objUsuario = new usuario();
            $resultado = $objUsuario -> ValidarRespuesta($login, $respuesta);
            if(!$resultado){
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje -> screenMensajeShow("ERROR:El usuario no existe,<br>el password esta errado o<br>el usuario esta inhabilitado ",
                                     "<a href='../index.php'>Ir al inicio</a>");
            }else{

                $objPregunta = new formCambiarClave();
                $objPregunta -> formCambiarClaveShow($login);
            }


        }

        public function cambiarPasswort($newpasswort) {
            session_start();
            $login=$_SESSION["login"];
            $objUsuario = new usuario();
            $resultado = $objUsuario -> CambiarPasswort($login, $newpasswort);

            if(!$resultado){
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje -> screenMensajeShow("ERROR:No se logro cambiar el password",
                                     "<a href='../index.php'>Ir al inicio</a>");
            }else{
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje -> screenMensajeShow("Password cambiado",
                                     "<a href='../index.php'>Ir al inicio</a>");
            }
        }
        
    }
?>