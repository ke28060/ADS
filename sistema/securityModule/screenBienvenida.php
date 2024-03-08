<?
    include_once("../shared/formulario.php");
    class screenBienvenida extends formulario
    {
        public function screenBienvenidaShow($listaPrivilegios)
        {
            $title = "BIENVENIDO ".$_SESSION['login'];
            $this->getHead($title);
            for($i=0; $i < count($listaPrivilegios); $i++)
            {
            ?>
             <form name ="<? echo $listaPrivilegios[$i]['namePrivilegio']?>" method ="POST" action="<? echo $listaPrivilegios[$i]['pathPrivilegio']?>">
             <img src="../img/<? echo $listaPrivilegios[$i]['iconPrivilegio']?>" width= "40" height="40">       
             <input type = "submit" name = "<? echo $listaPrivilegios[$i]['namePrivilegio']?>" value = "<? echo $listaPrivilegios[$i]['labelPrivilegio']?>">
             </form> 
             <br> 
            <?
            }
            $this->getFoot();
        }
    }
?>