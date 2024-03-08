<?php
    include_once("formulario.php");
    class screenMensaje extends formulario
    {
        public function screenMensajeShow($mensaje,$enlace)
        {   
            $listarPrivilegios=[];
            $this->getHead("MENSAJE DEL SISTEMA",$listarPrivilegios);
            ?>
                <p align="center">
                    <strong>
                        <?php echo $mensaje;?>
                    </strong>
                </p>
                <p align="center">                    
                        <?php echo $enlace;?>                    
                </p>
            <?php
            $this->getFoot();
        }
    }
?>