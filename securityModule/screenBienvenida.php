<?php

include_once("../shared/formulario.php");

class screenBienvenida extends formulario
{
    public function screenBienvenidaShow($listaPrivilegios)
    {
        $title = "BIENVENIDO " . $_SESSION['login'];
        $this->getHead($title, $listaPrivilegios);
        
        // Mostrar título
        echo "<h1>$title</h1>";
        date_default_timezone_set('America/Lima');

        // Mostrar formularios de privilegios
        $horaActual = date("H:i:s");    
        ?>
        <p>Hora de ingreso actual: <?php echo $horaActual ?></p>
        <?php

        $this->getFoot();
    }
}
?>
