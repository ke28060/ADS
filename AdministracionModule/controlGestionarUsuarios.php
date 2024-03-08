<?php
    include_once("../model/usuario.php");
    include_once("../securityModule/controlAutenticarUsuario.php");
    include_once("formGestionarUsuarios.php");
    include_once("formAgregarUsuarios.php");
    class controlGestionarUsuarios
    {
        
        public function ListarUsuarios()
        {   
            session_start();         
            
                $login = $_SESSION['login']; 
                $objUsuarioPrivilegio = new usuarioPrivilegio();
                $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);

                $Usuario = new Usuario();
                $Usuarios = $Usuario->listarUsuarios();
                
                if (!$Usuarios) {
                    include_once("../shared/screenMensaje.php");
                    $objMensaje = new screenMensaje();
                    $objMensaje->screenMensajeShow("ERROR: No se pudieron listar los Usuarios",
                        "<a href='../index.php'>Ir al inicio</a>");
                } else {
                    $objFromStockProductos = new formGestionarUsuarios();
                    $objFromStockProductos->formGestionarUsuariosShow($Usuarios, $listaPrivilegios); 
                }
            
        
    }

        public function Modificara0($idusuarios)
        {   
            session_start();         
            
                $login = $_SESSION['login']; 
                $objUsuarioPrivilegio = new usuarioPrivilegio();
                $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);

                $Usuario = new Usuario();
                
                $estado = $Usuario->ModificarDesabilitar($idusuarios);
                
                if (!$estado) {
                    include_once("../shared/screenMensaje.php");
                    $objMensaje = new screenMensaje();
                    $objMensaje->screenMensajeShow("ERROR: No se pudieron modificar los Usuarios",
                        "<a href='../index.php'>Ir al inicio</a>");
                } else {
                    $Usuarios = $Usuario->listarUsuarios();
                    $objFromStockProductos = new formGestionarUsuarios();
                    $objFromStockProductos->formGestionarUsuariosShow($Usuarios, $listaPrivilegios); 
                }
            
        
    }

        public function Modificara1($idusuarios)
        {   
            session_start();         
            
                $login = $_SESSION['login']; 
                $objUsuarioPrivilegio = new usuarioPrivilegio();
                $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);

                $Usuario = new Usuario();
                
                $estado = $Usuario->ModificarHabilitar($idusuarios);
                
                if (!$estado) {
                    include_once("../shared/screenMensaje.php");
                    $objMensaje = new screenMensaje();
                    $objMensaje->screenMensajeShow("ERROR: No se pudieron modificar los Usuarios",
                        "<a href='../index.php'>Ir al inicio</a>");
                } else {
                    $Usuarios = $Usuario->listarUsuarios();
                    $objFromStockProductos = new formGestionarUsuarios();
                    $objFromStockProductos->formGestionarUsuariosShow($Usuarios, $listaPrivilegios); 
                }
            
        
    }

       

        public function InsertarUsuario(){
            session_start();         
            
                $login = $_SESSION['login']; 
                $objUsuarioPrivilegio = new usuarioPrivilegio();
                $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);

                
        }
}
?>