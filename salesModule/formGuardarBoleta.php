<?php
include_once("../shared/formulario.php");

class formGuardarBoleta extends formulario
{
    public function formGuardarBoletaShow($DestallesProformas, $listaPrivilegios)
    {
        $title = "Menu Proformas";
        $this->getHead($title, $listaPrivilegios);
        $total = 0;
        ?>

        <div class="container">
            <h2>Crear Boleta</h2>
            <div class="row">
                <!-- Columna para el formulario -->
                <div class="col-lg-6">
                    <form action="getCrearBoleta.php" method="POST">
                        <div class="form-group">
                            <label for="NombresCliente">Nombres:</label>
                            <input type="text" class="form-control" id="NombresCliente" name="NombresCliente" required>
                        </div>
                        <div class="form-group">
                            <label for="ApellidosCliente">Apellidos:</label>
                            <input type="text" class="form-control" id="ApellidosCliente" name="ApellidosCliente" required>
                        </div>
                        <div class="form-group">
                            <label for="DNICliente">DNI:</label>
                            <input type="text" class="form-control" id="DNICliente" name="DNICliente" required>
                        </div>
                        <div class="form-group">
                            <label for="TelefonoCliente">Teléfono:</label>
                            <input type="text" class="form-control" id="TelefonoCliente" name="TelefonoCliente" required>
                        </div>

                        <input type="submit" value="Generar Boleta" name="btnGenerarBoleta" >
                    </form>
                </div>
        
                <div class="col-lg-6">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                        <tr>
                            <th>ID Producto</th>
                            <th>Nombre Producto</th>
                            <th>Cantidad en Proforma</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if ($DestallesProformas) {
                            foreach ($DestallesProformas as $fila) {
                                ?>
                                <tr>
                                    <td><?php echo $fila['idproductos']; ?></td>
                                    <td><?php echo $fila['nameproductos']; ?></td>
                                    <td><?php echo $fila['cantidad_en_proforma']; ?></td>
                                    <td><?php echo $fila['precio']; ?></td>
                                </tr>
                                <?php
                                $precioTotalProducto = $fila['precio'] * $fila['cantidad_en_proforma'];
                                ?>
                            </tr>
                            <?php
                            // Suma el precio total del producto al precio total general
                            $total += $precioTotalProducto;
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="4">No se encontraron productos para la proforma 'ABC123'</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td class="text-right">Total a Pagar :</td>
                            <td><input class="form-control" value="<?php echo $total; ?>" readonly></td>
                        </tr>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
        $this->getFoot();
    }
}
?>
