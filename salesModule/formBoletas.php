<?php
include_once("../shared/formulario.php");

class formBoletas extends formulario
{
    public function formBoletasShow($boletas, $listaPrivilegios)
    {
        $title = "GestionarReclamos";
        $this->getHead($title, $listaPrivilegios);
        ?>
        <div class="container">
            <h1>Listado de Reclamos</h1>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Codigo de boleta</th>
                        <th>Fecha de Emision</th>
                        <th>Cliente</th> 
                        <th>total</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($boletas as $boleta) : ?>
                        <tr>
                            <td><?php echo $boleta['CodigoBoleta'] ?></td>
                            <td><?php echo $boleta['Fecha_Emision'] ?></td>
                            <td><?php echo $boleta['NombreCliente'] ?></td>
                            <td><?php echo $boleta['Total'] ?></td>
                            <td>
                            <?php if ($boleta['detalles'] == "Por atender") : ?>
                                    <form method="post" action="./getEntregaProductos.php">
                                        <input type="hidden" name="codigo" value="<?php echo $boleta['CodigoBoleta']; ?>">
                                        <input type="submit" value="Por Atender" name="btnPorAtender">
                                    </form>
                                <?php else : ?>
                                    <?php echo 'Atendido'?>
                                <?php endif; ?>
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