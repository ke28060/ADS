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

if (validarBoton("GestionarProductos")) {
    include_once("controlGestionarProductos.php");
    $producto = new controlGestionarProductos();
    $producto->listarProductos();
} 

elseif (validarBoton("btnAgregarProducto")) {
    include_once("controlGestionarCategorias.php");
    $categoria = new controlGestionarCategorias();
    $categoria->ListarCategorias();
} 

elseif (validarBoton("btnAgregar")) {

    $campos_a_validar = array("nombre", "cantidad", "precio", "categoria");

    if (validarCamposTexto($campos_a_validar)) {
        $nombre = $_POST["nombre"];
        $imagen = $_POST["imagen"];
        $cantidad = $_POST["cantidad"];
        $precio = $_POST["precio"];
        $idCategoria = $_POST["categoria"];
    
        include_once("controlGestionarProductos.php");
        $producto = new controlGestionarProductos();
        $producto->InsertarProductos($nombre, $imagen, $cantidad, $precio, $idCategoria);
    } else {
        // Mostrar mensaje de error si algún campo de texto está vacío o contiene solo espacios en blanco
        include_once("../shared/screenMensaje.php");
        $objMensaje = new screenMensaje();
        $objMensaje->screenMensajeShow("ERROR: Todos los campos de texto son obligatorios",
            "<a href='../index.php'>Ir al inicio</a>");
    }
} 

elseif (validarBoton("btnModificarProducto")) {
        $idProducto = $_POST['idproductos'];
        include_once("controlGestionarProductos.php");
        $Producto = new controlGestionarProductos();
        $Producto->DatosdelProducto($idProducto);
    
} 

elseif (validarBoton("btnModificar")) {
    $idProducto = $_POST['id_producto'];
    $campos_a_validar = array("nueva_cantidad", "nuevo_precio");
    if (validarCamposTexto($campos_a_validar)) {
        $nuevaCantidad = $_POST['nueva_cantidad']; 
        $nuevoPrecio = $_POST['nuevo_precio']; 
        include_once("controlGestionarProductos.php");
        $controlador = new controlGestionarProductos();
        $controlador->ModificarProducto($idProducto, $nuevaCantidad, $nuevoPrecio);
    }else{
        include_once("../shared/screenMensaje.php");
        $objMensaje = new screenMensaje();
        $objMensaje->screenMensajeShow("ERROR: Todos los campos de texto son obligatorios",
            "<a href='../index.php'>Ir al inicio</a>");
    }
}

elseif (validarBoton("btnEliminarProducto")) {
        $idProducto = $_POST['idproductos'];
        include_once("controlGestionarProductos.php");
        $Producto = new controlGestionarProductos();
        $Producto->DatosDeletedelProducto($idProducto);
} 

elseif (validarBoton("btnEliminar")) {
    $idProducto = $_POST['id_producto'];
    include_once("controlGestionarProductos.php");
    $controlador = new controlGestionarProductos();
    $controlador->DeleteProducto($idProducto);
}

else {
    include_once("../shared/screenMensaje.php");
    $objMensaje = new screenMensaje();
    $objMensaje->screenMensajeShow("ERROR: Acción no válida",
        "<a href='../index.php'>Ir al inicio</a>");
}
?>

