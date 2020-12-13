<?php

include_once '../db/headers.php';
include_once '../modelos/usuario.php';

$usuario = new Usuario();

$data = $usuario->GetUsuarios();
if(count($data)){
    http_response_code(200);
    echo json_encode(array("success" => true, "status" => 200, "usuarios" => $data));
} else {
    http_response_code(404);
    echo json_encode(array("success" => false, "status" => 404, "message" => "No se encontraron registros"));
}

?>

