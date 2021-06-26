<?php
require("../capaNegocio/pdfControler.php");
require_once("../capaNegocio/tablaControlador.php");


$tabla = new Tabla("peliculas");
$tabla->mostrarBusqueda($_GET["buscar"], $_GET["filtro"]);
$resultado = $tabla->devolverTabla();


$pdf = new PDF("peliculas", $resultado);
$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->generarTabla();
$pdf->Output();


