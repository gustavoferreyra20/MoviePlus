<?php
require_once("../capaNegocio/tablaControlador.php");
$tabla = new Tabla("peliculas");
$pelicula = $tabla->buscarEnTabla($_GET["pelicula"]);
$tabla = new Tabla("generos");
$generosTabla = $tabla->devolverTabla();
$tabla = new Tabla("planes");
$planesTabla = $tabla->devolverTabla();
?>

<div class="row justify-content-center">
            <div class="col-12 col-lg-4">
                <div class="card p-3 bloque">
                    <div class="card-body ">
                         <form action="../capaNegocio/editarPel.php" method="POST">
                            <h1 class="text-center pb-4" id="white">Editar película</h1>
                            
                            <input type="hidden" value="<?= $pelicula['id']; ?>" name="id"> 

                            <div class="form-group">
                                <label for="titulo">Título:</label>
                                <input type="text" class="form-control" name="titulo" id="titulo"
                                    placeholder="Ingrese Título" value="<?= ucfirst($pelicula['titulo']) ?>" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="genero_id">Género:</label>
                                <SELECT name="genero_id">
                                <?php
                                    while  ($generos = mysqli_fetch_array($generosTabla)){
                                ?> 
                                    <option value="<?= $generos['id']; ?>" <?php if ($generos['id'] == $pelicula["genero_id"]) { echo "selected"; }; ?>><?= ucfirst($generos['genero']); ?></option>
                                <?php    
                                    }
                                ?>                  
                                </SELECT>
                            </div>

                            <div class="form-group">
                                <label for="director">Director:</label>
                                <input type="text" class="form-control" name="director" id="director"
                                    placeholder="Ingrese Director" value="<?= ucwords($pelicula['director']) ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="plan_id">Plan:</label>
                                <SELECT name="plan_id">
                                <?php
                                    while  ($planes = mysqli_fetch_array($planesTabla)){
                                ?> 
                                    <option value="<?= $planes['id']; ?>" <?php if ($planes['id'] == $pelicula["plan_id"]) { echo "selected"; }; ?>><?= ucfirst($planes['plan']); ?></option>
                                <?php    
                                    }
                                ?>                  
                                </SELECT>
                            </div>

                            <div class="form-group">
                                <label for="anio_estreno">Año de estreno:</label>
                                <SELECT name="anio_estreno">
                                <?php
                                    for  ($año = 1895; $año <= date("Y"); ++$año){
                                ?> 
                                    <option value="<?= $año ?>" <?php if ($año == $pelicula["anio_estreno"]) { echo "selected"; }; ?>><?= $año ?></option>
                                <?php    
                                    }
                                ?>                  
                                </SELECT>
                            </div>

                            <button type="submit" class="btn btn-block btn-primary">Editar</button>
                            </form>
                            </div>
                        </div>
                        </div>
                        