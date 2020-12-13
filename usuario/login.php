<?php

include_once '../db/headers.php';
include_once '../modelos/usuario.php';

$usuario = new Usuario();

if(isset($_GET['usuario']) && isset($_GET['contrasena'])) {
    $usuario->usuario = hash('ripemd160', $_GET['usuario']);
    $usuario->contrasena = hash('ripemd160', $_GET['contrasena']);

    $res = $usuario->Login();
    if($res === TRUE) {
        http_response_code(200);
        echo json_encode(array("success" => true, "status" => 200, "usuario" => $usuario));
    } else {
        http_response_code(404);
        echo json_encode(array("success" => false, "status" => 404, "message" => "No se encontro un usuario que coincida con los datos proporcionados"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos"));
}

?>