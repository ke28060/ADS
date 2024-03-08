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
    include_once("../model/reclamo.php");
    class controlReclamo
    {
        public function reclamo()
        {
            session_start();
            $login=$_SESSION['login']; 
            $objUsuarioPrivilegio = new UsuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $objFromCrearBoleta = new formReclamo;
            $objFromCrearBoleta->formReclamoShow($listaPrivilegios); 
                
        }

        public function BuscarReclamo($numBoleta){
            session_start();
            $login=$_SESSION['login']; 
            $_SESSION ['numBoleta'] = $numBoleta;
            $objUsuarioPrivilegio = new UsuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $boleta = new boleta();
            $detallesBoleta = $boleta->obtenerDetallesBoleta($numBoleta);
            $clienteBoleta = $boleta -> obtenerDatosCliente($numBoleta);

            if(!$detallesBoleta){
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje->screenMensajeShow("ERROR: No se encontro la boleta deseada",
                                "<a href='../index.php'>Ir al inicio</a>");
            }else{
                $objFromMenuProductos = new formGuardarReclamo;
                $objFromMenuProductos->formGuardarBoletaShow($detallesBoleta, $listaPrivilegios, $clienteBoleta);
            }

            
        }

        public function GuardarReclamo($comentarios){
            session_start();
            $login=$_SESSION['login'];
            $numBoleta = $_SESSION['numBoleta'];
            $objUsuarioPrivilegio = new UsuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $boleta = new reclamo();
            $guardarReclamo= $boleta->InsertarReclamo($comentarios, $numBoleta);
            if (!$guardarReclamo) {
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje->screenMensajeShow("ERROR: No se puedo Guardar",
                                "<a href='../index.php'>Ir al inicio</a>");
                
                } else {
                    $objFromMenuProductos = new formReclamo;
                    $objFromMenuProductos->formReclamoShow($listaPrivilegios);
                }
        }
    }

?>