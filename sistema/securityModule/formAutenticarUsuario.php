<?
    include_once("./shared/formulario.php");
    class formAutenticarUsuario extends formulario
    {
        public function formAutenticarUsuarioShow()
        {
            $this->getHead("Autenticar Usuario")
            ?>
                    <form method="POST" action="./securityModule/getUsuario.php">
                        <table  align="center" border = "0">
                        <tr>
                            <td coldspan="2" align="center">
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
                            <td coldspan="2">
                                <input type="submit" name="btnIngresar" value="Ingresar">
                            </td>
                        </table>
                    </form>                                    
            <?
            $this->getFoot();
        }
    }
?>