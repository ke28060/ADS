<?
    class formulario
    {
        protected function getHead($titulo)
        {
            ?>
            <html>
                <head>
                    <title><? echo $titulo; ?></title>
                </head>
                <body>
            <?
        }

        protected function getFoot()
        {
            ?>
                <hr>
                <marquee>UNTELS 2023 - ANALISIS Y DISEÑO DE SISTEMAS</marquee>
                </body>
            </html>
            <?
        }
    }
?>