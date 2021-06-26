<?php 

require_once("../capaNegocio/tablaControlador.php");
$tabla = new Tabla("usuarios");
$usuario = $tabla->buscarEnTabla($_GET["usuario"]);
$tabla = new Tabla("planes");
$planesTabla = $tabla->devolverTabla();
?>

<div class="container mt-5">
        <div class="row justify-content-center">
                <div class="card-body p-3 bloque">

<form action="../capaNegocio/editarAdmin.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" value="<?= $usuario['id']; ?>" name="id">                           
                            <div class="form-group">
                            <label for="nombre">Nombre</label>
                              <input type="nombre"
                                class="form-control" name="nombre" id="nombre" value=<?= $usuario['nombre']; ?>>
                            </div>
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email"
                                class="form-control" name="email" id="email" value=<?= $usuario['email']; ?>>
                            </div>
                            <div class="form-group">
                            <label for="plan">Plan</label>
                            <SELECT name="plan">
                                <?php
                                    while  ($planes = mysqli_fetch_array($planesTabla)){
                                ?> 
                                    <option value="<?= $planes['id']; ?>" <?php if ($planes['id'] == $usuario["plan_id"]) { echo "selected"; }; ?>><?= ucfirst($planes['plan']); ?></option>
                                <?php    
                                    }
                                ?>                  
                                </SELECT>
                            </div>
                            <div class="form-group">
                            <label for="permisos">Permisos</label>
                            <SELECT name="permisos">
                                <option value="usuario" <?php if ($usuario["permisos"] == "usuario") { echo "selected"; }; ?>>Usuario</option>;
                                <option value="admin" <?php if ($usuario["permisos"] == "admin") { echo "selected"; }; ?>>Admin</option>;
                            </SELECT>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Editar</button>
                        </form>

                        </div>
                </div>      
            </div>

            <div class="form-group">
                            <a href="index.php?seccion=eliminarUser&usuario=<?= $usuario['id']; ?>"><button type="submit" class="btn btn-sm btn-danger">Eliminar Usuario</button></a>
                            </div>