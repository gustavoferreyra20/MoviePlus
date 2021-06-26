<!doctype html>
<?php

include_once("../capaNegocio/pelControlador.php");
session_start();
?>
<html lang="es">
  <head>
    <title>Movie Plus</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/styles.css">
    <link href="img/logo.png" rel="icon" type="image/ico" />
  </head>
  <body>
  <header>
  <nav class="navbar navbar-expand-sm  navbar-custom navbar-dark fixed-top">
          <!-- Botón colapsable -->
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?seccion=peliculas">Películas</a>
                </li>
                <?php
                if(isset($_SESSION["usuario"])):
                  if( $_SESSION["usuario"]["permisos"]=="admin"):
            ?>
                <li class="nav-item">
                <a class="nav-link" href="index.php?seccion=usuarios">Usuarios</a>
                </li> 
                <?php
                    endif;
            ?>
            </ul>
                <ul class="navbar-nav mr-0">
                <li class="nav-item">
                <a class="nav-link" href="index.php?seccion=editarUsuario&usuario=<?= $_SESSION["usuario"]["id"]; ?>"><?= $_SESSION["usuario"]["nombre"]; ?></a>
                 </li> 
                <li class="nav-item">
                    <a class="nav-link" href="../capaNegocio/logout.php">Salir</a>
                </li> 
                <?php
                    else:
                ?>
            </ul>
                <ul class="navbar-nav mr-0">
                
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?seccion=login">Login</a>
                        </li> 
                <?php
                endif;
                ?>
            </ul>
               
            </div> 
        </nav>
        </header>
        <main>
        <div class="container my-5">
        <?php
          
            $seccion = $_GET["seccion"] ?? "peliculas";
            
            if(!isset($_SESSION["usuario"]) && $seccion != "login"):
              ?>
              <h1>Debes iniciar sesión para ver el contenido</h1>
          
              <?php
              else:
                if (isset($_GET["estado"])):
                  ?> 
                  <div class="card p-3 bloque bg-danger text-white">
                  <h3><?= ucfirst (str_replace("_", " ",$_GET["estado"])) ;?></h3>     
                  </div>
              <?php
              endif;
           
                require_once("seccion/$seccion.php");
              
          endif;
        ?> 
        </div>
        </main>
        <footer>
     <div class="container-fluid mb-0">
      <div class="row">
       <div class="col-xl-8 col-lg-8 col-md-8 col-xs-6">
        <p>Posted by: Ferreyra Gustavo - 2020</p>
     </div>
     </div>
     </div>
 </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>