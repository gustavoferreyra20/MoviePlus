<?php 
require_once("../capaNegocio/tablaControlador.php");
require_once("../capaNegocio/userControlador.php");

        if (isset($_POST["borrar"])){

            $tabla = new Tabla("usuarios");
            $usuario = $tabla->buscarEnTabla($_POST["borrar"]);
            $borrarUsuario = new Usuario($usuario["email"], $usuario["pswd"]);
            $borrarUsuario->eliminarUsuario($_POST["borrar"]);
         }
          
         
         header("Location: ../capaPresentacion/index.php?seccion=usuarios");
         
       
         


?>