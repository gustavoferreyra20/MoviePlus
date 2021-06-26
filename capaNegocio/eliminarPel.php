<?php 
require_once("../capaNegocio/tablaControlador.php");
require_once("../capaNegocio/pelControlador.php");

        if (isset($_POST["borrar"])){
            $tabla = new Tabla("peliculas");
            $pelicula = $tabla->buscarEnTabla($_POST["borrar"]);
            $borrarPelicula = new Pelicula($pelicula["titulo"], $pelicula["anio_estreno"], $pelicula["genero"], $pelicula["plan"]);
            $borrarPelicula->eliminarPelicula($_POST["borrar"]);
         }
          
         
         header("Location: ../capaPresentacion/index.php?seccion=peliculas");
         
       
         


?>