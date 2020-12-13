<?php

include_once('LoadRequest.php');

class LibroController
{
    public static function getAll() {
        // Now let's make a request!
        $request = Requests::get(API_URL.'libro/readAll');

        // Check what we received
        if ($request->status_code == 200){
            $data = json_decode($request->body);
            if($data) {
                return $data->libros;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    public static function getSuggestions() {
        // Now let's make a request!
        $request = Requests::get(API_URL.'libro/readRandom');

        // Check what we received
        if ($request->status_code == 200){
            $data = json_decode($request->body);
            if($data) {
                return $data->libros;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    public static function getLibro($libro) {
        // Now let's make a request!
        $request = Requests::get(API_URL.'libro/readOne?idLibro='.$libro);

        // Check what we received
        if ($request->status_code == 200){
            $data = json_decode($request->body);
            if($data) {
                return $data->libro;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}


?>