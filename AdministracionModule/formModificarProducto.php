<?php
include_once("../shared/formulario.php");

class formModificarProducto extends formulario
{
    public function formModificarProductoShow($producto,$listaPrivilegios)
    {
        $title = "Modificar Producto";
        $this->getHead($title,$listaPrivilegios);
?>
        <div class="container">
            <h1>Modificar Producto</h1>
            <form method="post" action="./getProductos.php">
                <!-- Campo oculto para enviar el ID del producto -->
                <input type="hidden" name="id_producto" value="<?php echo $producto['idproductos']; ?>">

                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nameproductos']; ?>" readonly><br><br>

                <label for="imagen">Imagen:</label>
                <img src="<?php echo $producto['imagen_base64']; ?>" alt="Imagen del producto" width="100" readonly><br><br>

                <label for="categoria">Categoría:</label>
                <input type="text" id="categoria" name="categoria" value="<?php echo $producto['idcategoria']; ?>" readonly><br><br>

                <label for="cantidad">Cantidad:</label>
                <input type="number" id="cantidad" name="nueva_cantidad" value="<?php echo $producto['cantidad']; ?>" required><br><br>

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="nuevo_precio" step="0.01" value="<?php echo $producto['precio']; ?>" required><br><br>

                <input type="submit" name="btnModificar" value="Modificar">
            </form>
        </div>
<?php
        $this->getFoot();
    }
}
?>
