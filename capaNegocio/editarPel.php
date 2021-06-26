<?php
require_once("pelControlador.php");

$id=$_POST["id"];
$titulo = $_POST["titulo"];
$genero_id = $_POST["genero_id"];
$director = $_POST["director"];
$anio_estreno = $_POST["anio_estreno"];
$plan_id = $_POST["plan_id"];

$pelicula = new Pelicula($titulo, $anio_estreno);
$pelicula->setGeneroDirectorPlan($genero_id, $director, $plan_id);
$pelicula->editPelicula($id);

header("Location: ../capaPresentacion/index.php?seccion=peliculas");