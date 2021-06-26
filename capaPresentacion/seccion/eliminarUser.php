<?php
require_once("../capaNegocio/tablaControlador.php");
require_once("../capaNegocio/userControlador.php");
$tabla = new Tabla("usuarios");
$usuario = $tabla->buscarEnTabla($_GET["usuario"]);
?>

<div class="container my-5">
<h1>Borrar usuario</h1>
<div class="container mt-5">
        <div class="row justify-content-center">
                <div class="card-body p-3 bloque">  
                <p> Usuario: <?= $usuario['nombre']; ?></p><br>
                <p> Email: <?= $usuario['email']; ?></p><br>
                <br>
      <form action="../capaNegocio/eliminarUsuario.php" method="post">                    
            <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary" name="borrar" id="borrar" value="<?= $usuario['id']; ?>">Sí</button>
                <button type="submit" class="btn btn-sm btn-danger" name="no_borrar" id="no_borrar">No</button>
        </form>
        </div>         
                        </div>
                        </div>