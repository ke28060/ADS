<?php
    include_once("../model/Productos.php");
    include_once("formMenuProductos.php");
    include_once("../securityModule/controlAutenticarUsuario.php");
    include_once("../model/proforma.php");
    include_once("../model/usuarioPrivilegio.php");
    include_once("formCrearBoleta.php");
    include_once("formGuardarBoleta.php");
    include_once("../model/ProductosBoleta.php");
    include_once("formImprimirBoleta.php");
    include_once("../model/cliente.php");
    include_once("../model/boleta.php");
    class controlCrearBoleta
    {
        public function ListarProformas()
        {
            session_start();
            $login=$_SESSION['login']; 
            $objUsuarioPrivilegio = new UsuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $Proforma = new Proforma();
            $ListaProformas= $Proforma->listarProformas();
            $objFromCrearBoleta = new formCrearBoleta;
            $objFromCrearBoleta->formCrearBoletaShow($ListaProformas, $listaPrivilegios); 
        }

        public function BuscarProforma($Busqueda)
        {
            session_start();
            $login=$_SESSION['login']; 
            $objUsuarioPrivilegio = new UsuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $Proforma = new Proforma();
            $ListaProformas= $Proforma->BuscarCodigo($Busqueda);
            $objFromCrearBoleta = new formCrearBoleta;
            $objFromCrearBoleta->formCrearBoletaShow($ListaProformas, $listaPrivilegios); 
        }

        public function GenerarBoleta($Codigo)
        {
            session_start();
            $login=$_SESSION['login']; 
            $objUsuarioPrivilegio = new UsuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $Proforma = new Proforma();
            $DestallesProformas = $Proforma -> obtenerProformas($Codigo);
            $_SESSION['codigo']=$Codigo;
            if (!$DestallesProformas) {
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje->screenMensajeShow("ERROR: No se logro listarProformas",
                                "<a href='../index.php'>Ir al inicio</a>");
                } else {
                    $objFromMenuProductos = new formGuardarBoleta;
                    $objFromMenuProductos->formGuardarBoletaShow($DestallesProformas, $listaPrivilegios); // Pasar los datos de los productos a la función
                }
        }

        public function CrearBoleta($nombres, $apellidos, $dni, $telefono){
            session_start();
            $login=$_SESSION['login'];
            $Codigo=$_SESSION['codigo'];
            $objUsuarioPrivilegio = new UsuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $crearCliente = new  Cliente();
            $Cliente = $crearCliente->cliente($nombres, $apellidos, $dni, $telefono);
            $ProductosBoleta = new ProductosBoleta();
            $codigonuevo = $ProductosBoleta -> generarCodigoUnico();
            if (!$Cliente) {
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje->screenMensajeShow("ERROR:No se logro incresar el cliente",
                                "<a href='../index.php'>Ir al inicio</a>");
            } else {
                
                $DuplicaraBoleta = $ProductosBoleta->DuplicarProductosBoleta($Codigo, $codigonuevo);
                $eliminarProforma = new Proforma();
                $eliminar = $eliminarProforma -> Eliminar($Codigo);
                $boleta = new boleta();
                $total = $boleta -> obtenerTotalBoleta($codigonuevo);
                $CrearBoleta = $boleta->CrearBoleta($total,$Cliente,$codigonuevo);

                $listarboleta= $boleta->obtenerDetallesBoleta($codigonuevo);
                $datoscliente=$boleta -> obtenerDatosCliente($codigonuevo);

                $objFromMenuProductos = new formImprimirBoleta;
                $objFromMenuProductos->formImprimirBoletaShow($listarboleta, $listaPrivilegios, $datoscliente);
            }

        }
    }

?>