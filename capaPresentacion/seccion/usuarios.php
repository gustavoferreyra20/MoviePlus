<?php
require_once("../capaNegocio/tablaControlador.php");
if($_SESSION["usuario"]["permisos"] != "admin" ){
    header("Location: ../capaPresentacion/index.php");
    die();
}
$tabla = new Tabla("usuarios");
$pagina = $_GET["pagina"] ?? 1;
$cantFilas = 5;
$paginas = $tabla->getCantFilas();
$tabla->limitarTabla($cantFilas, ($pagina - 1 )*$cantFilas);
$resultado = $tabla->devolverTabla();
?>
<a href="index.php?seccion=login&registrarse=true"><button type="submit"  class="btn btn-sm btn-secondary float-right">Agregar usuario</button></a> 
<table class="table bloque">
    <thead>
        <tr>
            <th>Nombres</th>
            <th>Email</th>
            <th>Plan</th>
            <th>Permisos</th>
            <th>Vencimiento subscripción</th>
            <th>Acción</th>
        </tr>
    </thead>
<tbody>

<?php
    while($filatabla = mysqli_fetch_array($resultado)){
        $idp =  $filatabla['plan_id'];
?>
    <tr>
      <td><?php echo ucwords($filatabla['nombre']); ?></td>
      <td><?php echo $filatabla['email'];?></td>
      <td><?php echo $tabla->mostrarPlan($idp);?></td>
      <td><?php echo $filatabla['permisos'];?></td>
      <td><?php echo $filatabla['vencimiento_subscripcion'];?></td>
      <td> 
        <div class="btn-group-vertical">
        <a href="index.php?seccion=editarAdmin&usuario=<?= $filatabla['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                                    <form action="index.php?seccion=eliminarUser&usuario=<?= $filatabla['id']; ?>" method="post">
                                    <input type="hidden" value="<?= $filatabla['email']; ?>" name="id">
                                        <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                                    </form>
                                </div>
            </td>
    </tr>
              <?php  }
echo "<br>";
?>
</tbody>
  </table>
  <div class="container my-5 text-center">
<?php
    if($pagina != 1){
        echo "<tr><td><a href=index.php?seccion=usuarios&pagina=".$tabla->cambiarPagina($pagina, -1)."><button type=submit class=btn btn-sm btn-primary>Atras</button></a></td>";
    }

    for ($i = 0; $i < $paginas / $cantFilas; $i++) { 
        echo "<tr><td><a href=index.php?seccion=usuarios&pagina=".($i + 1)."><button type=submit class=btn btn-sm btn-primary>".($i + 1)."</button></a></td>";
    }

    if($pagina < $paginas / $cantFilas){
    echo "<td><a href=index.php?seccion=usuarios&pagina=".$tabla->cambiarPagina($pagina, 1)."><button type=submit class=btn btn-sm btn-primary>Siguiente</button></a></td></tr>";
    }

    ?>
  </div>