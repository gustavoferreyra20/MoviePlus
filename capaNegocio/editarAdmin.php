<?php
require_once("../capaNegocio/userControlador.php");
require_once("../capaNegocio/tablaControlador.php");

$id=$_POST["id"];
$email = $_POST["email"];
$nombre = $_POST["nombre"];
$plan = $_POST['plan'];
$permisos = $_POST['permisos'];

$tabla = new Tabla("usuarios");
$usuario = $tabla->buscarEnTabla($id);
$usuario = new Usuario($usuario["email"], $usuario["pswd"]);
$usuario->editAdmin($nombre, $email, $plan, $permisos, $id);

header("Location: ../capaPresentacion/index.php?seccion=usuarios");