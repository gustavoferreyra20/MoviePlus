<?php
require_once("../capaNegocio/tablaControlador.php");
$tabla = new Tabla("generos");
$generosTabla = $tabla->devolverTabla();
$tabla = new Tabla("planes");
$planesTabla = $tabla->devolverTabla();
?>

<div class="row justify-content-center">
            <div class="col-12 col-lg-4">
                <div class="card p-3 bloque">
                    <div class="card-body ">
                         <form action="../capaNegocio/agregarPel.php" method="POST">
                			<h1 class="text-center pb-4" id="white">Registrar película</h1>

                            <div class="form-group">
                                <label for="titulo">Título:</label>
                                <input type="text" class="form-control" name="titulo" id="titulo"
                                    placeholder="Ingrese Título" value="" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="genero_id">Género:</label>
                                <SELECT name="genero_id">
                                <?php
                                    while  ($generos = mysqli_fetch_array($generosTabla)){
                                ?> 
                                    <option value="<?= $generos['id']; ?>"><?= ucfirst($generos['genero']); ?></option>
                                <?php    
                                    }
                                ?>                  
                                </SELECT>
                            </div>

                            <div class="form-group">
                                <label for="director">Director:</label>
                                <input type="text" class="form-control" name="director" id="director"
                                    placeholder="Ingrese el director" value="" required>
                            </div>

                            <div class="form-group">
                                <label for="plan_id">Plan:</label>
                                <SELECT name="plan_id">
                                <?php
                                    while  ($planes = mysqli_fetch_array($planesTabla)){
                                ?> 
                                    <option value="<?= $planes['id']; ?>"><?= ucfirst($planes['plan']); ?></option>
                                <?php    
                                    }
                                ?>                  
                                </SELECT>
                            </div>
                            

                            <div class="form-group">
                                <label for="anio_estreno">Año de estreno:</label>
                                <SELECT name="anio_estreno">
                                <?php
                                    for  ($año = 1895; $año < date("Y"); ++$año){
                                ?> 
                                    <option value="<?= $año ?>"><?= $año ?></option>
                                <?php    
                                    }
                                ?>
                                    <option value="<?= date("Y") ?>" selected><?= date("Y") ?></option>                  
                                </SELECT>
                            </div>

                            <button type="submit" class="btn btn-block btn-primary">Registrar</button>
                            </form>
                            </div>
                        </div>
                        </div>
                        