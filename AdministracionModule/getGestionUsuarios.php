<?php

function validarBoton($Boton)
{
    if (isset($_POST[$Boton])) {
        return true; // Devuelve verdadero si se ha enviado el botón con el nombre especificado
    } else {
        return false; // Devuelve falso si no se ha enviado el botón con el nombre especificado
    }
}

if (validarBoton("GestionarUsuarios")) {
    include_once("controlGestionarUsuarios.php");
    $producto = new controlGestionarUsuarios();
    $producto->ListarUsuarios();
} 

elseif (validarBoton("btnDesabilitar")) {

        $idusuarios = $_POST["idusuarios"];
        include_once("controlGestionarUsuarios.php");
        $producto = new controlGestionarUsuarios();
        $producto->Modificara0($idusuarios);
        
} 

elseif (isset($_POST["btnHabilitar"])) {
    if(isset($_POST["idusuarios"])){
        $idusuarios = $_POST["idusuarios"];
        include_once("controlGestionarUsuarios.php");
        $producto = new controlGestionarUsuarios();
        $producto->Modificara1($idusuarios);
    }else{
        include_once("../shared/screenMensaje.php");
    $objMensaje = new screenMensaje();
    $objMensaje->screenMensajeShow("ERROR: Acción no válida",
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