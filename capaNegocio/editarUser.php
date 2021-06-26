<?php
require_once("userControlador.php");

$id=$_POST["id"];
$email = $_POST["email"];
$password = $_POST["password"];
$password2 = $_POST["password2"];
$nombre = $_POST["nombre"];
$plan = $_POST['plan'];

$usuario = new Usuario($email, $password);

$usuario->editUsuario($nombre, $email, $password, $password2, $plan, $id);

header("Location: ../capaPresentacion/index.php");
