<?php


function validarTexto($login,$password)
{
    if(strlen($login) > 3 and strlen($password) > 3)
        return true;
    else
        return false;    
}

function validarBoton($Boton)
{
    if (isset($_POST[$Boton])) {
        return true; // Devuelve verdadero si se ha enviado el botón con el nombre especificado
    } else {
        return false; // Devuelve falso si no se ha enviado el botón con el nombre especificado
    }
}

function validarCamposTexto($campos) {
    foreach ($campos as $campo) {
        if (empty($_POST[$campo]) || strlen(trim($_POST[$campo])) === 0) {
            return false; 
        }
    }
    return true; 
}


if(validarBoton("btnIngresar"))
{
    $login = trim($_POST['txtLogin']);
    $password = trim($_POST['txtPassword']);
    if(!validarTexto($login,$password))
    {
        include_once("../shared/screenMensaje.php");
        $objMensaje = new screenMensaje();
        $objMensaje -> screenMensajeShow("ERROR: Ingrese datos adecuados para validarlos",
                                     "<a href='../index.php'>Ir al inicio</a>");

    }
    else
    {
        include_once("controlAutenticarUsuario.php");
        $objControl = new controlAutenticarUsuario();
        $objControl -> validarUsuario($login,$password);
    }

}
elseif(validarBoton("btnRecupera"))
{
    include_once("formRecuperarClave.php");
    $objForm= new formRecuperarClave();
    $objForm -> formRecuperarClaveShow();
}

elseif(validarBoton("btnCerrarSession"))
{
    include_once("ControlFormulario.php");
    $objForm= new controlFormulario();
    $objForm -> CerrarSession();
}

elseif(validarBoton("btnhome"))
{
    include_once("ControlFormulario.php");
    $objForm= new controlFormulario();
    $objForm -> Home();
}

elseif (validarBoton("btnUsuario")) {
    $campos_a_validar = array("txtlogin");
    if(validarCamposTexto($campos_a_validar)){
        $login = trim($_POST['txtlogin']);
        include_once("controladorRecuperarClave.php");
        $producto = new controladorRecuperarClave();
        $producto->buscarPregunta($login);
    }
    else {
        include_once("../shared/screenMensaje.php");
        $objMensaje = new screenMensaje();
        $objMensaje->screenMensajeShow("ERROR: tiene que completar el txtlogin",
            "<a href='../index.php'>Ir al inicio</a>");
    }
    
}

elseif(validarBoton("btnEnviarRespuesta")){
    $campos_a_validar = array("txtrespuesta");
    if(validarCamposTexto($campos_a_validar)){
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

elseif(validarBoton("btnCambiarPasswort")){
    $campos_a_validar = array("txtpasswort");
    if(validarCamposTexto($campos_a_validar)){
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

else
{
    include_once("../shared/screenMensaje.php");
    $objMensaje = new screenMensaje();
    $objMensaje -> screenMensajeShow("ERROR: se esta tratando de<br>violar la seguridad del sistema",
                                     "<a href='../index.php'>Ir al inicio</a>");
}
?>