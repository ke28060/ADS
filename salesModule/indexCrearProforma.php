<?php
function validarBoton($Boton)
{
    if (isset($_POST[$Boton])) {
        return true; // Devuelve verdadero si se ha enviado el botón con el nombre especificado
    } else {
        return false; // Devuelve falso si no se ha enviado el botón con el nombre especificado
    }
}

if (validarBoton("CrearProforma")) {
    include_once("controlCrearProforma.php");
    $producto = new controlCrearProforma();
    $producto->listarProductos();
} 
else {
    include_once("../shared/screenMensaje.php");
    $objMensaje = new screenMensaje();
    $objMensaje->screenMensajeShow("ERROR: Se esta tratando de vulnerar el sistema",
        "<a href='../index.php'>Ir al inicio</a>");
}

?>