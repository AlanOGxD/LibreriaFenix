<?php

include_once '../db/headers.php';
include_once '../modelos/cliente.php';

$cliente = new Cliente();

// $data = json_decode(file_get_contents("php://input"));
$data = (object)$_POST;

if (
    isset($data->nombre) &&
    isset($data->paterno) &&
    isset($data->materno) &&
    isset($data->usuario) &&
    isset($data->contrasena)
) {

    $cliente->nombre = $data->nombre;
    $cliente->paterno = $data->paterno;
    $cliente->materno = $data->materno;
    $cliente->usuario = hash('ripemd160', $data->usuario);
    $cliente->contrasena = hash('ripemd160', $data->contrasena);

    $res = $cliente->NuevoCliente();
    if($res === TRUE){
        http_response_code(201);
        echo json_encode(array("success" => true, "status" => 201, "message" => "Registro creado con éxito.", "cliente" => $cliente));
    } else {
        http_response_code(503);
        echo json_encode(array("success" => false, "status" => 503, "message" => $res));
    }
} else  {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos"));
}


?>

