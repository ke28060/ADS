<?php
include_once("../shared/formulario.php");

class formMenuProductos extends formulario
{
    public function formMenuProductosShow($productos, $listaPrivilegios)
    {
        $title = "Menu Productos";
        $this->getHead($title, $listaPrivilegios);
        ?>
        <div class="container">
            <h1>Menú de Productos</h1>

            <div class="search-bar">
                <form method="post" action="./getProforma.php" name="formBusqueda">
                    <input type="text" name="txtBusqueda" placeholder="Buscar producto...">
                    <input type="submit" name="btnBuscar" value="Buscar">
                </form>
            </div>
            <div class="search-bar">
                <form method="post" action="./getProforma.php" name="proforma">
                    <input type="submit" name="btnCrearProforma" value="Crear Proforma">
                </form>
            </div>
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
                            <td><img src="<?php echo $producto['imagen']; ?>" alt="Imagen del producto" width="100"></td>
                            <td><?php echo $producto['cantidad']; ?></td>
                            <td><?php echo $producto['precio']; ?></td>
                            <td>
                                <!-- Formulario para agregar a proforma -->
                                <form method="post" action="./getProforma.php" >
                                <input type="hidden" name="idproductos" value="<?php echo $producto['idproductos']; ?>">
                                <input type="submit" value="Agregar a Proforma" name="btnAgregarProforma">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php
        $this->getFoot();
    }
}
?>
