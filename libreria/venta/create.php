<?php

include_once '../db/headers.php';
include_once '../modelos/venta.php';
include_once '../modelos/detalleVenta.php';

$venta = new Venta();

// $data = json_decode(file_get_contents("php://input"));
$data = ( count($_POST) > 0) ? (object)$_POST : json_decode(file_get_contents("php://input"));

if (
    isset($data->cliente) &&
    isset($data->fecha) &&
    isset($data->cantidad) &&
    isset($data->totalVenta) &&
    isset($data->detalle)
) {
    $venta->cliente = $data->cliente;
    $venta->fecha = $data->fecha;
    $venta->cantidad = $data->cantidad;
    $venta->totalVenta = $data->totalVenta;
    $venta->detalle = $data->detalle;

    $res = $venta->NuevaVenta();
    if ($res === TRUE) {
        $detalleResult = array();
        foreach ($venta->detalle as $key => $d) {
            $detalleVenta = new DetalleVenta();
            // $d = json_decode($d);
            $detalleVenta->producto = $d->producto;
            $detalleVenta->cantidad = $d->cantidad;
            $detalleVenta->precio = $d->precio;
            $detalleVenta->total = $d->total;
            $detalleVenta->productoId = $d->productoId;
            $detalleVenta->venta = $venta->idVenta;

            $result = $detalleVenta->NuevoDetalle();
            $detalleResult[] = array("detalle" => $d, "message" => $result);
        }

        http_response_code(201);
        echo json_encode(array("success" => true, "status" => 201, "message" => "La venta se registro correctamente.", "venta" => $venta, "detalles" => $detalleResult));
    } else {
        http_response_code(503);
        echo json_encode(array("success" => false, "status" => 503, "message" => $res));
    }
} else  {
    http_response_code(400);
    echo json_encode(array("success" => false, "status" => 400, "message" => "No se puede procesar la solicitud, los datos estan incompletos", "data" => $data));
}

?>
