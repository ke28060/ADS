<?php
include_once("../shared/formulario.php");

class formCrearBoleta extends formulario
{
    public function formCrearBoletaShow($ListaProformas, $listaPrivilegios)
    {
        $title = "Menu Proformas";
        $this->getHead($title, $listaPrivilegios);

        ?>

        <div class="container">
            <h2>Listado de Proformas</h2>
                <div class="search-bar">
                    <form method="post" action="./getCrearBoleta.php" name="formBusqueda">
                        <input type="text" name="txtBusquedaProforma" placeholder="Buscar producto...">
                        <input type="submit" name="btnBuscarProforma" value="Buscar">
                    </form>
                </div>
            <div class="table-responsive">
            
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Proformas</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($ListaProformas) && !empty($ListaProformas)) {
                            foreach ($ListaProformas as $proforma) { ?>
                                <tr>
                                    <td>Proforma N. <?php echo $proforma['codigo']; ?></td>
                                    <td>
                                        <form method="post" action="./getCrearBoleta.php">
                                            <input type="hidden" name="codigo" value="<?php echo $proforma['codigo']; ?>">
                                            <input type="submit" value="Boleta" name="btnBoleta" class="btn btn-primary">
                                        </form>
                                    </td>
                                </tr>
                        <?php }
                        } else { ?>
                            <tr>
                                <td colspan="2">No hay proformas disponibles</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

<?php
        $this->getFoot();
    }
}
?>

