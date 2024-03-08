<?php
include_once("../model/Categoria.php"); // Asegúrate de que la ruta sea correcta
include_once("formAgregarProducto.php"); // Asegúrate de que la ruta sea correcta
include_once("../securityModule/controlAutenticarUsuario.php");
class controlGestionarCategorias
{
    public function ListarCategorias()
    {
        session_start();  
        $login = $_SESSION['login']; // Obtener el login de la sesión
        $objUsuarioPrivilegio = new usuarioPrivilegio();
        $listaPrivilegios = $objUsuarioPrivilegio->obtenerPrivilegios($login);
        $categoria = new Categoria();
        $categorias = $categoria->listarCategorias();
        $Subcategoria= new Categoria();
        $Subcategorias= $Subcategoria -> listarCategoriasConSubcategorias();
        if (!$categorias) {
            include_once("../shared/screenMensaje.php");
            $objMensaje = new screenMensaje();
            $objMensaje->screenMensajeShow("ERROR: No se encontraron categorías ",
                "<a href='../index.php'>Ir al inicio</a>");
        } else {
            $objFormStockCategorias = new FormAgregarProducto();
            $objFormStockCategorias->FormAgregarProductoShow($categorias,$listaPrivilegios, $Subcategorias);
        }
    }


}
?>
