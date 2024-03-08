<?php

class Formulario
{
    protected function getHead($titulo, $privilegios = [])
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?php echo $titulo; ?></title>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        </head>
        <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" >Negocio</a>
                <?php if (!empty($privilegios)) : ?>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <form name="Home" method="POST" action="../securityModule/getUsuario.php">
                                    <input type="submit" class="btn btn-link" name="btnhome" value="Home">
                                </form>
                            </li>
                            <?php foreach ($privilegios as $privilegio) : ?>
                                <li class="nav-item">
                                    <form name="<?php echo $privilegio['namePrivilegio']?>" method="POST" action="<?php echo $privilegio['pathPrivilegio']?>">
                                        <input type="submit" class="btn btn-link" name="<?php echo $privilegio['namePrivilegio']?>" value="<?php echo $privilegio['labelPrivilegio']?>">
                                    </form>
                                </li>
                            <?php endforeach; ?>
                            <li class="nav-item">
                                <form name="Cerrar Session" method="POST" action="../securityModule/getUsuario.php">
                                    <input type="submit" class="btn btn-link" name="btnCerrarSession" value="Cerrar Session">
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </nav>

        <div class="container mt-4">
        <?php
    }

    protected function getFoot()
    {
        ?>
        </div> 
        <hr>
        <marquee>UNTELS 2023 - ANALISIS Y DISEÑO DE SISTEMAS</marquee>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </body>
        </html>
        <?php
    }

}
?>
