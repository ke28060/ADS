<?
    include_once("formulario.php");
    class screenMensaje extends formulario
    {
        public function screenMensajeShow($mensaje,$enlace)
        {
            $this->getHead("MENSAJE DEL SISTEMA");
            ?>
                <p align="center">
                    <strong>
                        <? echo $mensaje;?>
                    </strong>
                </p>
                <p align="center">                    
                        <? echo $enlace;?>                    
                </p>
            <?
            $this->getFoot();
        }
    }
?>