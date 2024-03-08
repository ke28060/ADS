<?php
include_once("../shared/formulario.php");

class formGuardarReclamo extends formulario
{
    public function formGuardarBoletaShow($detallesBoleta, $listaPrivilegios, $clienteBoleta)
    {
        $title = "Menu Proformas";
        $this->getHead($title, $listaPrivilegios);
        $total = 0; 
        ?>
        <div class="container">
        <h2>Detalles de la Boleta</h2>

            <div class="cliente-details">
                
                <p>Cliente: <?php echo $clienteBoleta['NombresCliente']; ?></p>
                <p>DNI: <?php echo $clienteBoleta['DNICliente']; ?></p>
                <p>Teléfono: <?php echo $clienteBoleta['TelefonoCliente']; ?></p>
            </div>
        
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <!-- Encabezados de la tabla -->
                        <thead class="thead-dark">
                            <tr>
                                <th>Nombre Producto</th>
                                <th>Cantidad en Proforma</th>
                                <th>Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($detallesBoleta as $producto) :
                                ?>
                                <tr>
                                    <td><?php echo $producto['nameproductos']; ?></td>
                                    <td><?php echo $producto['cantidad']; ?></td>
                                    <td><?php echo $producto['precio']; ?></td>
                                </tr>
                                <?php
                                $precioTotalProducto = $producto['precio'] * $producto['cantidad'];
                                $total += $precioTotalProducto;
                                ?>
                                <?php endforeach; ?>
                            
                        </tbody>
                    </table>
                </div>
        
                <!-- Mostrar el total -->
                <div class="total-container">
                    <p>Total a Pagar: <?php echo $total; ?></p>
                </div>
        
                <!-- Mostrar mensaje -->
                <div class="mensaje-container">
                    <p>¡Gracias por tu compra!</p>
                </div>
                <form method="post" action="./getReclamo.php">
                <div class="form-group">
                    <label for="comentarios">Comentarios:</label>
                    <textarea class="form-control" id="comentarios" name="comentarios" rows="4" placeholder="Escribe tus comentarios aquí"></textarea>
                    <input type="submit" value="Guardar Reclamo" name="btnGuardarReclamo" >
                </div>
                </form>

        

    </div>
            

<?php
        
        $this->getFoot();
    }
}
?>