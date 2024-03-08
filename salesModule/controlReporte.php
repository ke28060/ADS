<?php
    include_once("../model/Productos.php");
    include_once("formGuardarReclamo.php");
    include_once("../securityModule/controlAutenticarUsuario.php");
    include_once("../model/proforma.php");
    include_once("../model/usuarioPrivilegio.php");
    include_once("../model/ProductosBoleta.php");
    include_once("formReclamo.php");
    include_once("../model/cliente.php");
    include_once("../model/boleta.php");
    include_once("formGenerarReporte.php");
    include_once("../model/reporte.php");
    include_once("../model/productosReportados.php");
    include_once("formMensajedeGuardado.php");
    class controlReporte
    {
        public function Reporte()
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
                    $objFromStockProductos = new formGenerarReporte();
                    $objFromStockProductos->formGenerarReporteShow($productos, $listaPrivilegios); 
                }
            
        }
        public function VerificarReporte($ganancia)
        {
            session_start();         
            
                $login = $_SESSION['login']; 
                $objUsuarioPrivilegio = new usuarioPrivilegio();
                $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
                

                $reporte = new reporte();
                $idReporte= $reporte->obteneridreporte();
                $calculoganacia = $reporte->calcularganacia();
                $guardarreporte = $reporte->Guardarreporte($idReporte, $ganancia, $calculoganacia, $login);
                $productosReportados=new ProductosReportados();
                $Reportados = $productosReportados->GuardarProductosCero($idReporte);
                
                if (!$guardarreporte) {
                    include_once("../shared/screenMensaje.php");
                    $objMensaje = new screenMensaje();
                    $objMensaje->screenMensajeShow("ERROR: No se pudieron listar los productos.",
                        "<a href='../index.php'>Ir al inicio</a>");
                } else {
                    $objFromStockProductos = new formMensajeGuardado();
                    $objFromStockProductos->formMensajeGuardadoShow($listaPrivilegios); 
                }
            
        }

    }

?>