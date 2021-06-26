<?php
require_once("userControlador.php");
$email = $_POST["email"];
$password = $_POST["password"];
$nombre = $_POST["nombre"];
$plan = $_POST["plan"];

$usuario = new Usuario($email, $password);
$usuario ->setNombrePlan($nombre, $plan);
$usuario ->registrarUsuario();
if($_SESSION["usuario"]["permisos"] != "admin"){
    $usuario ->iniciarSesion();
}else{
    header("Location: ../capaPresentacion/index.php?seccion=usuarios");
}
