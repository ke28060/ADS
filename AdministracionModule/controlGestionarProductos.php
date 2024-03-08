<?php
    include_once("../model/Productos.php");
    include_once("FormStockProductos.php");
    include_once("formModificarProducto.php");
    include_once("formDeleteProducto.php");
    include_once("../securityModule/controlAutenticarUsuario.php");
    class controlGestionarProductos
    {
        
        public function ListarProductos()
        {   
            session_start();         
            
                $login = $_SESSION['login']; 
                $objUsuarioPrivilegio = new usuarioPrivilegio();
                $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);

                $producto = new Producto();
                $productos = $producto->listarProductos();
                
                if (!$productos) {
                    include_once("../shared/screenMensaje.php");
                    $objMensaje = new screenMensaje();
                    $objMensaje->screenMensajeShow("ERROR: No se pudieron listar los productos.",
                        "<a href='../index.php'>Ir al inicio</a>");
                } else {
                    $objFromStockProductos = new formStockProductos();
                    $objFromStockProductos->formStockProductosShow($productos, $listaPrivilegios); 
                }
            
        
        }
        public function InsertarProductos($nombre, $imagen, $cantidad, $precio, $idCategoria)
        {
            session_start();  
            $producto = new Producto();
            $login = $_SESSION['login']; // Obtener el login de la sesión
            $objUsuarioPrivilegio = new usuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $resultadoInsercion = $producto->InsertarProducto($nombre, $imagen, $cantidad, $precio, $idCategoria);
            if (!$resultadoInsercion) {
                // Si la inserción falla, muestra un mensaje de error
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje->screenMensajeShow("ERROR: La inserción del producto ha fallado",
                    "<a href='../index.php'>Ir al inicio</a>");
            } else {
                $productos = $producto->listarProductos();
                $objFromStockProductos = new formStockProductos();
                $objFromStockProductos->formStockProductosShow($productos, $listaPrivilegios); 
            }
    
        }
        public function ModificarProducto($idProducto, $nuevaCantidad, $nuevoPrecio)
        {
            session_start();  
            $login = $_SESSION['login']; // Obtener el login de la sesión
            $objUsuarioPrivilegio = new usuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $producto = new Producto();
            $exitoModificacion = $producto->ModificarProducto($idProducto, $nuevaCantidad, $nuevoPrecio);
            
            if (!$exitoModificacion) {
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje->screenMensajeShow("ERROR: La modificación del producto ha fallado",
                            "<a href='../index.php'>Ir al inicio</a>");
            } else {
                $productos = $producto->listarProductos();
                $objFromStockProductos = new formStockProductos();
                $objFromStockProductos->formStockProductosShow($productos, $listaPrivilegios); 
                
            }
        }
        public function DatosdelProducto($idProducto){
            session_start();  
            $login = $_SESSION['login']; // Obtener el login de la sesión
            $objUsuarioPrivilegio = new usuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $producto = new Producto();
            $detallesProducto = $producto->obtenerDetallesProducto($idProducto);
            if (!$detallesProducto) {
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje->screenMensajeShow("ERROR: La peticion de datos del producto ha fallado",
                            "<a href='../index.php'>Ir al inicio</a>");
            } else {
                $objformModificarProducto = new formModificarProducto();
                $objformModificarProducto->formModificarProductoShow($detallesProducto, $listaPrivilegios);
            }
        }

        public function DatosDeletedelProducto($idProducto)
        {
            session_start();  
            $login = $_SESSION['login']; // Obtener el login de la sesión
            $objUsuarioPrivilegio = new usuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $producto = new Producto();
            $detallesProducto = $producto->obtenerDetallesProducto($idProducto);
            if (!$detallesProducto) {
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje->screenMensajeShow("ERROR: La peticion de datos del producto ha fallado",
                            "<a href='../index.php'>Ir al inicio</a>");
            } else {
                $objformDeleteProducto = new formEliminarProducto();
                $objformDeleteProducto->formEliminarProductoShow($detallesProducto, $listaPrivilegios);
            }
        }

        public function DeleteProducto($idProducto)
        {
            session_start();  
            $login = $_SESSION['login']; // Obtener el login de la sesión
            $objUsuarioPrivilegio = new usuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $producto = new Producto();
            $EliminarProducto = $producto->EliminarProducto($idProducto);
            $productos = $producto->listarProductos();
            if (!$EliminarProducto) {
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje->screenMensajeShow("ERROR: La eliminacion del producto ha fallado",
                            "<a href='../index.php'>Ir al inicio</a>");
            } else {
                $objFromStockProductos = new formStockProductos();
                $objFromStockProductos->formStockProductosShow($productos, $listaPrivilegios); 
            }
        }
}
?>