<?php
include_once('conexion.php');

class Categoria extends Conexion
{
    public function listarCategorias()
    {
        $this->conectarBD();

        $sql = "SELECT idcategoria, namecategoria FROM categoria";

        $resultado = $this->conexion->query($sql);
        
        if ($resultado && $resultado->num_rows > 0) {
            $this->desConectarBD();
            return $resultado;
        } else {
            $this->desConectarBD();
            return NULL;
        }
    }
    public function listarCategoriasConSubcategorias()
{
    $this->conectarBD();

    $sql = "SELECT c.idcategoria, c.namecategoria, s.idsubcategoria, s.namesubCategoria
            FROM categoria c
            LEFT JOIN subcategoria s ON c.idcategoria = s.idcategoria";

    $resultado = $this->conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        $this->desConectarBD();
        return $resultado;
    } else {
        $this->desConectarBD();
        return NULL;
    }
}

}
?>
