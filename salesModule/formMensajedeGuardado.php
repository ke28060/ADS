<?php
include_once("../shared/formulario.php");

class formMensajeGuardado extends formulario
{
    public function formMensajeGuardadoShow($listaPrivilegios)
    {
        $this->getHead("MENSAJE DEL SISTEMA", $listaPrivilegios);
        $mensaje = "Se ha guardado el reporte"; // Mensaje que se mostrará

        ?>
        <p align="center">
            <strong>
                <?php echo $mensaje; ?>
            </strong>
        </p>
        <?php

        $this->getFoot();
    }
}
?>
