<?
function validarBoton($boton)
{
    return(isset($boton));    
}

function validarTexto($login,$password)
{
    if(strlen($login) > 3 and strlen($password) > 3)
        return true;
    else
        return false;    
}

$boton = $_POST["btnIngresar"];
if(!validarBoton($boton))
{
    include_once("../shared/screenMensaje.php");
    $objMensaje = new screenMensaje();
    $objMensaje -> screenMensajeShow("ERROR: se esta tratando de<br>violar la seguridad del sistema",
                                     "<a href='../index.php'>Ir al inicio</a>");
}
else
{
    $login = trim($_POST['txtLogin']);
    $password = trim($_POST['txtPassword']);
    if(!validarTexto($login,$password))
    {
        include_once("../shared/screenMensaje.php");
        $objMensaje = new screenMensaje();
        $objMensaje -> screenMensajeShow("ERROR: Ingrese datos adecuados para validarlos",
                                     "<a href='../index.php'>Ir al inicio</a>");

    }
    else
    {
        include_once("controlAutenticarUsuario.php");
        $objControl = new controlAutenticarUsuario();
        $objControl -> validarUsuario($login,$password);
    }
}
?>