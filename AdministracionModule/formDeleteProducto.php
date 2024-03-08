<?php
include_once("../shared/formulario.php");

class formEliminarProducto extends formulario
{
    public function formEliminarProductoShow($producto, $listaPrivilegios)
    {
        $title = "Estos datos se borrarán";
        $this->getHead($title, $listaPrivilegios);
?>
        <div class="container">
            <h1>Estos datos se borrarán</h1>
            <form method="post" action="./getProductos.php">
                <!-- Campo oculto para enviar el ID del producto -->
                <input type="hidden" name="id_producto" value="<?php echo $producto['idproductos']; ?>">

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nameproductos']; ?>" readonly><br><br>

                <label for="imagen">Imagen:</label>
                <input type="text" id="imagen" name="imagen" value="<?php echo $producto['imagen']; ?>" readonly><br><br>

                <label for="categoria">Categoría:</label>
                <input type="text" id="categoria" name="categoria" value="<?php echo $producto['idcategoria']; ?>" readonly><br><br>

                <label for="cantidad">Cantidad:</label>
                <input type="text" id="cantidad" name="cantidad" value="<?php echo $producto['cantidad']; ?>" readonly><br><br>

                <label for="precio">Precio:</label>
                <input type="text" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" readonly><br><br>

                <input type="submit" name="btnEliminar" value="Eliminar Definitivamente">
            </form>
        </div>
<?php
        $this->getFoot();
    }
}
?>

