<?php

include_once '../db/headers.php';
include_once '../modelos/usuario.php';

$usuario = new Usuario();

if(isset($_GET['idUsuario'])) {
    $usuario->idUsuario = $_GET['idUsuario'];

    // delete the record
    $res = $usuario->delete();
    if($res === TRUE) {
        http_response_code(200);
        echo json_encode(array("success" => true, "status" => 200, "message" => "Registro eliminado con éxito."));
    } else {
        http_response_code(503);
        echo json_encode(array("success" => false, "status" => 503, "message" => $res));
    }
} else {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos"));
}

?>