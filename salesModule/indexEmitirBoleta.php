<?php
    function validarBoton($Boton){
    if (isset($_POST[$Boton])) {
        return true; 
    } else {
        return false;
    }
}

if (validarBoton("EmitirBoleta")) {
    include_once("controlCrearBoleta.php");
    $producto = new controlCrearBoleta();
    $producto->ListarProformas();
} 
else {
    include_once("../shared/screenMensaje.php");
    $objMensaje = new screenMensaje();
    $objMensaje->screenMensajeShow("ERROR: Acción no válida",
        "<a href='../index.php'>Ir al inicio</a>");
}

?>