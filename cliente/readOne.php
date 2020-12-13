<?php

include_once '../db/headers.php';
include_once '../modelos/cliente.php';

$cliente = new Cliente();

if(isset($_GET['idCliente'])) {
    $cliente->idCliente = $_GET['idCliente'];

    $res = $cliente->GetCliente();
    if($res === TRUE) {
        http_response_code(200);
        echo json_encode(array("success" => true, "status" => 200, "cliente" => $cliente));
    } else {
        http_response_code(503);
        echo json_encode(array("success" => false, "status" => 503, "message" => $res));
    }
} else {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos"));
}

?>