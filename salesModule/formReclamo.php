<?php
include_once("../shared/formulario.php");

class formReclamo extends formulario
{
    public function formReclamoShow($listaPrivilegios)
    {   
        $title = "Reporte";
        $this->getHead($title, $listaPrivilegios);
        ?>
            <div class="container mt-5">
                <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Buscar Boleta</h4>
                        <form action="getReclamo.php" method="POST">
                        <div class="form-group">
                            <label for="numBoleta">Número de Boleta:</label>
                            <input type="text" class="form-control" id="numBoleta" name="numBoleta" placeholder="Ingrese el número de boleta" required>
                        </div>
                        <input type="submit" class="btn btn-primary" name="btnBuscarBoleta" value="Buscar Boleta">
                        </form>
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