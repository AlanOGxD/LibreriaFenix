<?php

include_once '../db/headers.php';
include_once '../modelos/cliente.php';

$cliente = new Cliente();

$data = $cliente->GetClientes();
if(count($data)){
    http_response_code(200);
    echo json_encode(array("success" => true, "status" => 200, "clientes" => $data));
} else {
    http_response_code(404);
    echo json_encode(array("success" => false, "status" => 404, "message" => "No se encontraron registros"));
}

?>

