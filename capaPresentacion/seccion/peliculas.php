<?php

require_once("../capaNegocio/tablaControlador.php");
        $tabla = new Tabla("peliculas");
        $pagina = $_GET["pagina"] ?? 1;
        $cantFilas = 5;
        $url = "index.php?seccion=peliculas";
        if (isset($_GET["buscar"])){
          $tabla->mostrarBusqueda($_GET["buscar"], $_GET["filtro"]);
          $url = $url."&buscar=$_GET[buscar]&filtro=$_GET[filtro]";
        }
        if (isset($_GET["ordenar"])){
          $tabla->ordenar($_GET["ordenar"], $_GET["orientacion"]);
          $url = $url."&ordenar=$_GET[ordenar]&orientacion=$_GET[orientacion]";
        }
        $tabla->limitarTabla($cantFilas, ($pagina - 1 )*$cantFilas);
        
        $resultado = $tabla->devolverTabla();
        $paginas = $tabla->getCantFilas();
        
?>

<ul class="navbar-nav ml-0">
                  <li class="nav-item">
                <div class="search-container">
                  <form action="index.php">
                    <input required type="text" placeholder="Buscar.." name="buscar">
                    <SELECT name="filtro">
                      <option value="titulo">Buscar por titulo</option>;
                      <option value="genero_id">Buscar por genero</option>;
                      <option value="anio_estreno">Buscar por año</option>;
                      <option value="plan_id">Buscar por plan</option>;
                    </SELECT>
                    <button type="submit">Buscar</button>
                  </form>
                </div>
                </li>
                  </ul>
                  <?php
        if (!isset($_GET["buscar"])){
          ?>
                  <ul class="navbar-nav ml-0">
                  <li class="nav-item">
                <div class="search-container">
                  <form action="index.php">
                  <SELECT name="ordenar">
                      <option value="titulo">Ordenar por titulo</option>;
                      <option value="genero_id">Ordenar por genero</option>;
                      <option value="anio_estreno">Ordenar por año</option>;
                      <option value="plan_id">Ordenar por plan</option>;
                    </SELECT>
                    <SELECT name="orientacion">
                      <option value="ASC">↑</option>;
                      <option value="DESC">↓</option>;
                    </SELECT>
                    <button type="submit">Ordenar</button>
                  </form>
                </div>
                </li>
                  </ul>
                  <?php
                }else{
                  ?>

        <a href="../capaNegocio/imprimir.php?buscar=<?=$_GET['buscar']?>&filtro=<?=$_GET['filtro']?>"><button type="submit"  class="btn btn-sm btn-secondary float-left">Imprimir tabla</button></a>
        <?php
                }
                  ?> 
        <a href="index.php?seccion=agregarPel"><button type="submit"  class="btn btn-sm btn-secondary float-right">Agregar pelicula</button></a> 
        <?php
        if ($paginas <= 0){
          ?>
        <h1>No se encontraron coincidencias</h1>
        <?php
                }else{
                  ?>

<table class="table bloque">

    <thead>
        <tr>
            <th>Título</th>
            <th>Género</th>
            <th>Director</th>
            <th>Año de estreno</th>
            <th>Plan</th>
            <?php
      if($_SESSION["usuario"]["permisos"] == "admin" ){
        ?>
        <th>Acción</th>
        <?php
      }
        ?>
        </tr>
    </thead>
<tbody>
<p>Se han encontrado <?= $paginas ?> resultados.</p>
<?php
    while($filatabla = mysqli_fetch_array($resultado)){
        $idp =  $filatabla['plan_id'];
        $idg =  $filatabla['genero_id'];
?>
    <tr>
      <td><?php echo ucwords($filatabla['titulo']); ?></td>
      <td><?php echo ucwords($tabla->mostrarGenero($idg));?></td>
      <td><?php echo ucwords($filatabla['director']); ?></td>
      <td><?php echo $filatabla['anio_estreno']; ?></td>
      <td><?php echo ucwords($tabla->mostrarPlan($idp));?></td>
      <?php
      if($_SESSION["usuario"]["permisos"] == "admin" ){
        ?>
        <td><div class="btn-group-vertical">
        <a href="index.php?seccion=editarPel&pelicula=<?= $filatabla['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                                    <form action="index.php?seccion=eliminarPel&pelicula=<?= $filatabla['id']; ?>" method="post">
                                    <input type="hidden" value="<?= $filatabla['id']; ?>" name="id">
                                        <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                                    </form>
                                </div></td>
        <?php
      }
        ?>
      
    </tr>
              <?php  }
echo "<br>";
?>
</tbody>
  </table>
  <div class="container my-5 text-center">
<?php
    if($pagina != 1){
        echo "<tr><td><a href=$url&pagina=".$tabla->cambiarPagina($pagina, -1)."><button type=submit class=btn btn-sm btn-primary>Atras</button></a></td>";
    }

    for ($i = 0; $i < $paginas / $cantFilas; $i++) { 
        echo "<tr><td><a href=$url&pagina=".($i + 1)."><button type=submit class=btn btn-sm btn-primary>".($i + 1)."</button></a></td>";
    }

    if($pagina < $paginas / $cantFilas){
    echo "<td><a href=$url&pagina=".$tabla->cambiarPagina($pagina, 1)."><button type=submit class=btn btn-sm btn-primary>Siguiente</button></a></td></tr>";
    }
  
    ?>
    <?php
                }
                  ?>
  </div>