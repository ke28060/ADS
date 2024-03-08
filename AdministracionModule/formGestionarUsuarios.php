<?php
include_once("../shared/formulario.php");

class formGestionarUsuarios extends formulario
{
    public function formGestionarUsuariosShow($Usuarios, $listaPrivilegios)
    {
        $title = "GestionarUsuarios";
        $this->getHead($title, $listaPrivilegios);
        ?>
        <div class="container">
            <h1>Listado de Usuarios</h1>
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Acciones</th> <!-- Nueva columna para botones de acciones -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Usuarios as $Usuario) : ?>
                        <tr>
                            <td><?php echo $Usuario['login']; ?></td>
                            <td>
                                <?php if ($Usuario['estado'] == 1) : ?>
                                    <form method="post" action="./getGestionUsuarios.php">
                                        <!-- Otros campos del formulario -->
                                        <input type="hidden" name="idusuarios" value="<?php echo $Usuario['idusuarios']; ?>">
                                        <input type="submit" value="Desabilitar" name="btnDesabilitar">
                                    </form>
                                <?php else : ?>
                                    <!-- Si el estado es 0, el botón estará habilitado -->
                                    <form method="post" action="./getGestionUsuarios.php">
                                        <!-- Otros campos del formulario -->
                                        <input type="hidden" name="idusuarios" value="<?php echo $Usuario['idusuarios']; ?>">
                                        <input type="submit" value="Habilitar" name="btnHabilitar">
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form method="post" action="./getGestionUsuarios.php" name="btnInsertarUsuario">
                <input type="submit" name="btnInsertarUsuario" value="Agregar Usuario">
            </form>
        </div>
        <?php
        $this->getFoot();
    }
}
?>

