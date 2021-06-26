<?php
require_once("../capaNegocio/tablaControlador.php");
require_once("../capaNegocio/pelControlador.php");
$tabla = new Tabla("peliculas");
$pelicula = $tabla->buscarEnTabla($_GET["pelicula"]);
?>

<div class="container my-5">
<h1>Borrar usuario</h1>
<div class="container mt-5">
        <div class="row justify-content-center">
                <div class="card-body p-3 bloque">  
                <p> Titulo: <?= $pelicula['titulo']; ?></p><br>
                <p> Año de estreno: <?= $pelicula['anio_estreno']; ?></p><br>
                <br>
      <form action="../capaNegocio/eliminarPel.php" method="post">                    
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary" name="borrar" id="borrar" value="<?= $pelicula['id']; ?>">Sí</button>
                <button type="submit" class="btn btn-sm btn-danger" name="no_borrar" id="no_borrar">No</button>
        </form>
        </div>         
                        </div>
                        </div>