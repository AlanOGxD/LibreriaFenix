<?php

include_once '../db/headers.php';
include_once '../modelos/usuario.php';

$usuario = new Usuario();

// $data = json_decode(file_get_contents("php://input"));
$data = (object)$_POST;

if (
    isset($data->nombre) &&
    isset($data->tipo) &&
    isset($data->usuario) &&
    isset($data->contrasena)
) {
    $usuario->nombre = $data->nombre;
    $usuario->tipo = $data->tipo;
    $usuario->usuario = hash('ripemd160', $data->usuario);
    $usuario->contrasena = hash('ripemd160', $data->contrasena);

    $res = $usuario->NuevoUsuario();
    if($res === TRUE){
        http_response_code(201);
        echo json_encode(array("success" => true, "status" => 201, "message" => "Registro creado con éxito.", "usuario" => $usuario));
    } else {
        http_response_code(503);
        echo json_encode(array("success" => false, "status" => 503, "message" => $res));
    }
} else  {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos"));
}


?>

