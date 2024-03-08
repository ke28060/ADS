<?php
    include_once("../model/Productos.php");
    include_once("formMenuProductos.php");
    include_once("../securityModule/controlAutenticarUsuario.php");
    include_once("../model/boleta.php");
    include_once("formBoletas.php");
    class controlEntregaProductos
    {
        public function boletas(){
            session_start();
            $login=$_SESSION['login']; 
            $objUsuarioPrivilegio = new UsuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $listarBoletas = new boleta();
            $boletas = $listarBoletas->listarboletas();
            if (!$boletas) {
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje->screenMensajeShow("ERROR: No se puede listar",
                                "<a href='../index.php'>Ir al inicio</a>");
               } else {
                   $objFromCrearBoleta = new formBoletas;
                   $objFromCrearBoleta->formBoletasShow($boletas, $listaPrivilegios); 
               }

        }

        public function ModificarBoleta($codigo){
            session_start();
            $login=$_SESSION['login']; 
            $objUsuarioPrivilegio = new UsuarioPrivilegio();
            $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
            $listarBoletas = new boleta();
            $boletas = $listarBoletas->modificarBoletaDetalles($codigo);
            if (!$boletas) {
                include_once("../shared/screenMensaje.php");
                $objMensaje = new screenMensaje();
                $objMensaje->screenMensajeShow("ERROR: No se puedo Modificar ",
                                "<a href='../index.php'>Ir al inicio</a>");
               } else {
                    $boletas = $listarBoletas->listarboletas();
                    $objFromCrearBoleta = new formBoletas;
                    $objFromCrearBoleta->formBoletasShow($boletas, $listaPrivilegios); 
               }
        }

    }
?>
