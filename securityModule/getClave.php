<?php 

if (isset($_POST["btnUsuario"])) {
    if(!empty($_POST["txtlogin"]) ){
        $login = trim($_POST['txtlogin']);
        include_once("controladorRecuperarClave.php");
        $producto = new controladorRecuperarClave();
        $producto->buscarPregunta($login);
    }
    else {
        include_once("../shared/screenMensaje.php");
        $objMensaje = new screenMensaje();
        $objMensaje->screenMensajeShow("ERROR: No se encontro el login",
            "<a href='../index.php'>Ir al inicio</a>");
    }
    
} 

elseif(isset($_POST["btnEnviarRespuesta"])){
    if(!empty($_POST["txtrespuesta"]) ){
        $respuesta = trim($_POST['txtrespuesta']);
        include_once("controladorRecuperarClave.php");
        $producto = new controladorRecuperarClave();
        $producto->VerificarRespuesta($respuesta);
    }
    else {
        include_once("../shared/screenMensaje.php");
        $objMensaje = new screenMensaje();
        $objMensaje->screenMensajeShow("ERROR: No se encontro el login",
            "<a href='../index.php'>Ir al inicio</a>");
    }

}

elseif(isset($_POST["btnCambiarPasswort"])){
    if(!empty($_POST["txtpasswort"]) ){
        $newpasswort = trim($_POST['txtpasswort']);
        include_once("controladorRecuperarClave.php");
        $producto = new controladorRecuperarClave();
        $producto->cambiarPasswort($newpasswort);
    }
    else {
        include_once("../shared/screenMensaje.php");
        $objMensaje = new screenMensaje();
        $objMensaje->screenMensajeShow("ERROR: No se encontro el login",
            "<a href='../index.php'>Ir al inicio</a>");
    }

}

else {
    include_once("../shared/screenMensaje.php");
    $objMensaje = new screenMensaje();
    $objMensaje->screenMensajeShow("ERROR: Acción no válida",
        "<a href='../index.php'>Ir al inicio</a>");
}

?>