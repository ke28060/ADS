<?php
include_once("../shared/formulario.php");

class formCrearProforma extends formulario
{
    public function formCrearProformaShow($ListaCarrito, $listaPrivilegios)
    {
        $title = "Productos en la Proforma";
        $this->getHead($title, $listaPrivilegios);
        $total = 0; 
        ?>
        <div class="container">
            <h1>Productos en la Proforma</h1>
            <?php if (is_array($ListaCarrito) && count($ListaCarrito) > 0) : ?>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>IdCarrito</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ListaCarrito as $producto) : ?>
                        <tr>
                            <td><?php echo $producto['idcarrito']; ?></td>
                            <td><?php echo $producto['nameproductos']; ?></td>
                            <td><?php echo $producto['precio']; ?></td>
                            <td><?php echo $producto['cantidadCarrito']; ?></td>
                            <td>
                                <!-- Formulario para agregar a proforma -->
                                <form method="post" action="./getProforma.php">
                                <input type="hidden" name="idproductos" value="<?php echo $producto['idProducto']?>">
                                <input type="submit" value="Eliminar" name="btnEliminar">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form method="post" action="./getProforma.php">
                <input type="submit" value="Cancelar" name="btnCancelar">
                <input type="submit" value="Proforma" name="btnproforma">
            </form>
            <?php else : ?>
                <p>No hay productos disponibles.</p>
            <?php endif; ?>
            
        </div>
            

<?php
        
        $this->getFoot();
    }
}
?>