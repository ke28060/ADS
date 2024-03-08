<?php
include_once("../shared/formulario.php");

class formStockProductos extends formulario
{
    public function formStockProductosShow($productos, $listaPrivilegios)
    {
        $title = "GestionarProductos";
        $this->getHead($title, $listaPrivilegios);
        ?>
        <div class="container">
            <h1>Listado de Productos</h1>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Imagen</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Acciones</th> <!-- Nueva columna para botones de acciones -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) : ?>
                        <tr>
                            <td><?php echo $producto['nameproductos']; ?></td>
                            <td><img src="<?php echo $producto['imagen_base64']; ?>" alt="Imagen del producto" width="100"></td>
                            <td><?php echo $producto['cantidad']; ?></td>
                            <td><?php echo $producto['precio']; ?></td>
                            <td>
                            <form method="post" action="./getProductos.php">
                                <!-- Otros campos del formulario -->
                                <input type="hidden" name="idproductos" value="<?php echo $producto['idproductos']; ?>">
                                <input type="submit" value="Modificar" name="btnModificarProducto">
                            </form>
                            </td>
                            <td>
                                <form method="post" action="./getProductos.php">
                                    <!-- Otros campos del formulario -->
                                    <input type="hidden" name="idproductos" value="<?php echo $producto['idproductos']; ?>">
                                    <input type="submit" value="Eliminar" name="btnEliminarProducto">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <form method="post" action="./getProductos.php" name="btnAgregarProducto">
                <input type="submit" name="btnAgregarProducto" value="Agregar Producto">
            </form>
        </div>
        <?php
        $this->getFoot();
    }
}
?>

