<?php
include_once("../shared/formulario.php");

class formRecuperarClave extends formulario
{
    public function formRecuperarClaveShow()
    {
        $privilegios = []; // Aquí deberías obtener los privilegios del usuario si los tienes
        $title = "Recuperar Clave";
        $this->getHead($title,$privilegios);
?>
        <div class="container">
            <h1>Recuperar Clave</h1>
            <form method="post" action="getClave.php">
                <label for="login">Login:</label>
                <input type="text" id="login" name="txtlogin" required><br><br>
                <input type="submit" name="btnUsuario" value="Enviar">
            </form>

        </div>
<?php
        $this->getFoot();
    }
}
?>
