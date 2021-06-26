<?php
require_once("pelControlador.php");
$titulo = $_POST["titulo"];
$genero_id = $_POST["genero_id"];
$director = $_POST["director"];
$plan_id = $_POST["plan_id"];
$anio_estreno = $_POST["anio_estreno"];

$pelicula = new Pelicula($titulo, $anio_estreno);
$pelicula ->setGeneroDirectorPlan($genero_id, $director, $plan_id);
$pelicula ->registrarPelicula();

header("Location: ../capaPresentacion/index.php?seccion=peliculas");
