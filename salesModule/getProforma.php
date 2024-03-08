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


if (validarBoton("btnCrearProforma")) {
    include_once("controlCrearProforma.php");
    $producto = new controlCrearProforma();
    $producto->ListarCarrito();
} 

elseif (validarBoton('btnBuscar') ) {
    $campos_a_validar = array("txtBusqueda");
    if (validarCamposTexto($campos_a_validar)) {
        $terminoBusqueda = $_POST['txtBusqueda'];
        include_once('controlCrearProforma.php');
        $texto=new controlCrearProforma();
        $texto->buscarProductos($terminoBusqueda);
    } else {
        include_once("../shared/screenMensaje.php");
        $objMensaje = new screenMensaje();
        $objMensaje->screenMensajeShow("ERROR: Falta rellenar los campos",
            "<a href='../index.php'>Ir al inicio</a>");
    }
    
}

elseif (validarBoton('btnAgregarProforma')) {
    $idProducto = $_POST['idproductos'];
    include_once('controlCrearProforma.php');
    $producto = new controlCrearProforma();
    $producto->agregarProductos($idProducto);

}

elseif (validarBoton('btnEliminar')) {
    $idProducto = $_POST['idproductos'];
    include_once('controlCrearProforma.php');
    $producto = new controlCrearProforma();
    $producto->Eliminar($idProducto);

}

elseif (validarBoton('btnCancelar')) {
    include_once('controlCrearProforma.php');
    $producto = new controlCrearProforma();
    $producto->Cancelar();

}

elseif (validarBoton('btnproforma')) {
    include_once('controlCrearProforma.php');
    $producto = new controlCrearProforma();
    $producto->GenerarProforma();

}

else {
    include_once("../shared/screenMensaje.php");
    $objMensaje = new screenMensaje();
    $objMensaje->screenMensajeShow("ERROR: Se esta tratando de vulnerar el sistema",
        "<a href='../index.php'>Ir al inicio</a>");
}
?>