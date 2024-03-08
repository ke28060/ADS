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

if (validarBoton("EmitirReporte")) {
    include_once("controlReporte.php");
    $producto = new controlReporte();
    $producto->Reporte();
} 

elseif (validarBoton("btnReporte")) {
    $campos_a_validar = array("ganacia");
    if (validarCamposTexto($campos_a_validar)) {
        $ganancia = $_POST['ganancia'];    
        include_once("controlReporte.php");
        $producto = new controlReporte();
        $producto->VerificarReporte($ganancia);
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