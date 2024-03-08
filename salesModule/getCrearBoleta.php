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


if (validarBoton("btnBuscarProforma")) {
    $campos_a_validar = array("txtBusquedaProforma");
    if (validarCamposTexto($campos_a_validar)) {
        $Busqueda = $_POST['txtBusquedaProforma'];
        include_once("controlCrearBoleta.php");
        $producto = new controlCrearBoleta();
        $producto->BuscarProforma($Busqueda);
    } else {
        include_once("../shared/screenMensaje.php");
        $objMensaje = new screenMensaje();
        $objMensaje->screenMensajeShow("ERROR: Falta rellenar los campos",
            "<a href='../index.php'>Ir al inicio</a>");
    }
} 

elseif (validarBoton("btnBoleta")) {
    $Codigo = $_POST['codigo'];
    include_once("controlCrearBoleta.php");
    $producto = new controlCrearBoleta();
    $producto->GenerarBoleta($Codigo);
} 

elseif (validarBoton("btnGenerarBoleta")) {
    $campos_a_validar = array("NombresCliente", "ApellidosCliente", "DNICliente", "TelefonoCliente");
    if (validarCamposTexto($campos_a_validar)){
        $nombres = $_POST['NombresCliente'];
        $apellidos = $_POST['ApellidosCliente'];
        $dni = $_POST['DNICliente'];
        $telefono = $_POST['TelefonoCliente'];
    
        include_once("controlCrearBoleta.php");
        $producto = new controlCrearBoleta();
        $producto->CrearBoleta($nombres, $apellidos, $dni, $telefono);
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