<?php

include_once '../db/headers.php';
include_once '../modelos/venta.php';

$venta = new Venta();

$data = $venta->GetVentas();
if(count($data)){
    http_response_code(200);
    echo json_encode(array("success" => true, "status" => 200, "ventas" => $data));
} else {
    http_response_code(404);
    echo json_encode(array("success" => false, "status" => 404, "message" => "No se encontraron registros"));
}

?>

