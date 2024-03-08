<?php
include_once("../shared/formulario.php");

class formCambiarClave extends formulario
{
    public function formCambiarClaveShow($login)
    {
        $privilegios = []; // Aquí deberías obtener los privilegios del usuario si los tienes
        $title = "Cambiar Clave";
        $this->getHead($title,$privilegios);
?>
        <div class="container">
            <h1>Cambiar Clave</h1>
            <form method="post" action="getClave.php">
                <!-- Muestra la pregunta -->
                <p>Login: <?php echo $login; ?></p>

                <!-- Campo para ingresar la respuesta -->
                <label for="Passwort">Passwort:</label>
                <input type="text" id="Passwort" name="txtpasswort" required><br><br>

                <!-- Botón para enviar la respuesta -->
                <input type="submit" name="btnCambiarPasswort" value="Cambiar Passwort">
            </form>
        </div>
<?php
        $this->getFoot();
    }
}
?>