<?php

include_once '../db/headers.php';
include_once '../modelos/cliente.php';

$cliente = new Cliente();

$data = ( count($_POST) > 0) ? (object)$_POST : json_decode(file_get_contents("php://input"));

if(isset($data->usuario) && isset($data->contrasena)) {
    $cliente->usuario = hash('ripemd160', $data->usuario);
    $cliente->contrasena = hash('ripemd160', $data->contrasena);

    $res = $cliente->Login();
    if($res === TRUE) {
        http_response_code(200);
        echo json_encode(array("success" => true, "status" => 200, "cliente" => $cliente));
    } else {
        http_response_code(404);
        echo json_encode(array("success" => false, "status" => 404, "message" => "No se encontro un usuario que coincida con los datos proporcionados"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos"));
}

?>