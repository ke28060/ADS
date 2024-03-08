<?php
include_once("./shared/formulario.php");

class formAutenticarUsuario extends Formulario // Asegúrate de usar "Formulario" en lugar de "formulario"
{
    public function formAutenticarUsuarioShow()
    {
        $privilegios = []; // Aquí deberías obtener los privilegios del usuario si los tienes
        $titulo = "Autenticar Usuario";

        $this->getHead($titulo, $privilegios);
        ?>
        <form method="POST" action="./securityModule/getUsuario.php">
            <table align="center" border="0">
                <tr>
                    <td colspan="2" align="center">
                        AUTENTICACION DE USUARIO
                    </td>
                </tr>
                <tr>
                    <td>LOGIN</td>
                    <td>
                        <input type="text" name="txtLogin" id="txtLogin">
                    </td>
                </tr>
                <tr>
                    <td>PASSWORD</td>
                    <td>
                        <input type="password" name="txtPassword" id="txtPassword">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btnIngresar" value="Ingresar">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="btnRecupera" value="recuperar">
                    </td>
                </tr>
            </table>
        </form>
        
            
        
        <?php
        $this->getFoot();
    }
}
?>
