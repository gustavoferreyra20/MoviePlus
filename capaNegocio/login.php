<?php
session_start();
require_once("userControlador.php");

$email = $_POST["email"];
$password = $_POST["password"];

$usuarioA = new Usuario($email, $password);
$usuarioA ->iniciarSesion();
