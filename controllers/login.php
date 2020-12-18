<?php

session_start();
$cliente = json_decode($_GET['data']);
$_SESSION["autorizado"] = true;
$_SESSION['usuario'] = $cliente->idCliente;
$_SESSION['nombre'] = $cliente->nombre . ' ' . $cliente->paterno . ' ' . $cliente->materno;
session_regenerate_id();

// El siguiente key se crea cuando se inicia sesión
$_SESSION["timeout"] = time();
header('location: ../index.php');
/** */

?>
