<?php
    include_once("../model/Productos.php");
    include_once("formMenuProductos.php");
    include_once("../securityModule/controlAutenticarUsuario.php");
    include_once("../model/carrito.php");
    include_once("formCrearProforma.php");
    class controlCrearProforma
    {
        public function ListarProductos()
        {
            session_start();
            $login=$_SESSION['login']; 
            $objUsuarioPrivilegio = new usuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $producto = new Producto();
            $productos = $producto->listarProductos();
            
            $objFromMenuProductos = new formMenuProductos;
            $objFromMenuProductos->formMenuProductosShow($productos, $listaPrivilegios); // Pasar los datos de los productos a la función
        
        }

        public function ListarCarrito()
        {
            session_start();
            $login=$_SESSION['login']; 
            $objUsuarioPrivilegio = new usuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $carrito = new carrito();
            $ListaCarrito = $carrito -> listarProductosEnCarrito();
            $objFromMenuProductos = new formCrearProforma;
            $objFromMenuProductos->formCrearProformaShow($ListaCarrito, $listaPrivilegios); // Pasar los datos de los productos a la función

        }


        public function buscarProductos($terminoBusqueda)
    {   
        session_start();
        $login=$_SESSION['login']; 
        $objUsuarioPrivilegio = new usuarioPrivilegio();
        $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
        $producto = new Producto();
        $productos = $producto->buscarYActualizarDatos($terminoBusqueda);

        $objFromMenuProductos = new formMenuProductos;
        $objFromMenuProductos->formMenuProductosShow($productos, $listaPrivilegios);
    }



    public function agregarProductos($idProducto)
    {   
        session_start();
        $login=$_SESSION['login']; 
        $objUsuarioPrivilegio = new usuarioPrivilegio();
        $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
        $producto = new Producto();
        $carrito = new carrito();
        $AgregarCarr = $carrito -> agregarProductoAlCarrito($idProducto);

        if (!$AgregarCarr) {
            
            echo "El producto no tiene cantidad para vender";
            
        } else {
            $ModificarPro = $producto -> reducirCantidadProducto($idProducto);
            $productos = $producto->listarProductos();
            $objFromMenuProductos = new formMenuProductos;
            $objFromMenuProductos->formMenuProductosShow($productos, $listaPrivilegios);

        }

    }
    public function Eliminar($idProducto)
    {
        session_start();
        $login=$_SESSION['login']; 
        $objUsuarioPrivilegio = new usuarioPrivilegio();
        $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
        $producto = new Producto();
        $carrito = new carrito();
        $AgregarCantidad= $carrito-> aumentarCantidadProductoEnCarrito($idProducto);
        $EliminadeCarrito = $carrito -> eliminarProductoDelCarrito($idProducto);
        $ListaCarrito = $carrito -> listarProductosEnCarrito();
        $objFromMenuProductos = new formCrearProforma;
        $objFromMenuProductos->formCrearProformaShow($ListaCarrito, $listaPrivilegios);
        

    }
    public function Cancelar()
    {
        session_start();
        $login=$_SESSION['login']; 
        $objUsuarioPrivilegio = new usuarioPrivilegio();
        $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
        $carrito = new carrito();
        $ListaCarrito = $carrito -> devolverCantidadProductoATablaProductos();
        $objFromMenuProductos = new formCrearProforma;
        $objFromMenuProductos->formCrearProformaShow($ListaCarrito, $listaPrivilegios); // Pasar los datos de los productos a la función
        
    }

    public function GenerarProforma()
    {
        session_start();
        $login=$_SESSION['login']; 
        $objUsuarioPrivilegio = new usuarioPrivilegio();
        $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
        $carrito = new carrito();
        $ListaCarrito = $carrito -> copiarDatosACarrito();
        $objFromMenuProductos = new formCrearProforma;
        $objFromMenuProductos->formCrearProformaShow($ListaCarrito, $listaPrivilegios); // Pasar los datos de los productos a la función

    }

    }
?>