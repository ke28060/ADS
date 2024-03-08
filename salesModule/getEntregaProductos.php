<?php
function validarBoton($Boton)
{
    if (isset($_POST[$Boton])) {
        return true; // Devuelve verdadero si se ha enviado el botón con el nombre especificado
    } else {
        return false; // Devuelve falso si no se ha enviado el botón con el nombre especificado
    }
}

if (validarBoton("EntregaProductos")) {
    include_once("controlEntregaProductos.php");
    $producto = new controlEntregaProductos();
    $producto->boletas();
}

elseif (validarBoton("btnPorAtender")) {
        $codigo=$_POST['codigo'];
        include_once("controlEntregaProductos.php");
        $producto = new controlEntregaProductos();
        $producto->ModificarBoleta($codigo);
} 

else {
    include_once("../shared/screenMensaje.php");
    $objMensaje = new screenMensaje();
    $objMensaje->screenMensajeShow("ERROR: Acción no válida",
        "<a href='../index.php'>Ir al inicio</a>");
}
?>