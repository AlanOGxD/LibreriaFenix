<?php

session_start();
$usuario = json_decode($_GET['data']);
$_SESSION["autorizado"] = true;
$_SESSION['usuario'] = $usuario->idUsuario;
$_SESSION['nombre'] = $usuario->nombre;
//echo "Usuario".$usuario->idUsuario;
session_regenerate_id();
//header('location: http://127.0.0.1/fenix/indexAdmin.php');
// El siguiente key se crea cuando se inicia sesión
$_SESSION["timeout"] = time();
header('location: ../indexAdmin.php');

?>