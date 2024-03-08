<?
    class conexion
    {
        protected function conectarBD()
        {
            mysql_connect("localhost","root","12345");
            mysql_select_db("sistema");            
        }        
        protected function desConectarBD()
        {
            mysql_close();
        }
    }
?>