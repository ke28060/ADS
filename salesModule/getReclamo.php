<?php

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

if (validarBoton("EmitirReclamo")) {
    include_once("controlReclamo.php");
    $producto = new controlReclamo();
    $producto->reclamo();
} 

elseif (validarBoton("btnBuscarBoleta")) {
    $campos_a_validar = array("numBoleta");
    if (validarCamposTexto($campos_a_validar)) {
        $numBoleta = $_POST['numBoleta'];    
        include_once("controlReclamo.php");
        $producto = new controlReclamo();
        $producto->BuscarReclamo($numBoleta);
    } else {
        include_once("../shared/screenMensaje.php");
        $objMensaje = new screenMensaje();
        $objMensaje->screenMensajeShow("ERROR: Falta rellenar los campos",
            "<a href='../index.php'>Ir al inicio</a>");
    }
} 

elseif (validarBoton("btnGuardarReclamo")) {
    $campos_a_validar = array("comentarios");
    if (validarCamposTexto($campos_a_validar)) {
        $comentarios = $_POST['comentarios'];    
        include_once("controlReclamo.php");
        $producto = new controlReclamo();
        $producto->GuardarReclamo($comentarios);
    } else {
        include_once("../shared/screenMensaje.php");
        $objMensaje = new screenMensaje();
        $objMensaje->screenMensajeShow("ERROR: Falta rellenar los campos",
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