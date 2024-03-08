<?php
include_once("../shared/formulario.php");

class formPreguntaSecreta extends formulario
{
    public function formPruntaSecretaShow($resultado,$login)
    {
        $privilegios = []; // Aquí deberías obtener los privilegios del usuario si los tienes
        $title = "Pregunta Secreta";
        $this->getHead($title,$privilegios);
?>
        <div class="container">
            <h1>Pregunta Secreta</h1>
            <form method="post" action="getClave.php">
                <!-- Muestra la pregunta -->
                <p>Pregunta: <?php echo $resultado; ?></p>

                <!-- Campo para ingresar la respuesta -->
                <label for="respuesta">Respuesta:</label>
                <input type="text" id="respuesta" name="txtrespuesta" required><br><br>

                <!-- Botón para enviar la respuesta -->
                <input type="submit" name="btnEnviarRespuesta" value="Enviar Respuesta">
            </form>
        </div>
<?php
        $this->getFoot();
    }
}
?>