<?php
include_once("../shared/formulario.php");

class formGenerarReporte extends formulario
{
    public function formGenerarReporteShow($productos, $listaPrivilegios)
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

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto) : ?>
                        <tr>
                            <td><?php echo $producto['nameproductos']; ?></td>
                            <td><img src="<?php echo $producto['imagen']; ?>" alt="Imagen del producto" width="100"></td>
                            <td><?php echo $producto['cantidad']; ?></td>
                            <td><?php echo $producto['precio']; ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="container mt-5">
                <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                    <div class="card-body">
                        <form action="getReporte.php" method="POST">
                        <div class="form-group">
                            <label for="caja">Cantidad Ganada:</label>
                            <input type="text" class="form-control" name="ganancia" placeholder="Ingresa la ganancia del dia" required>
                        </div>
                        <input type="submit" class="btn btn-primary" name="btnReporte" value="Verificar Reporte">
                        </form>
                    </div>
                    </div>
                </div>
                </div>
            </div>

        </div>
        <?php
        $this->getFoot();
    }
}
?>

