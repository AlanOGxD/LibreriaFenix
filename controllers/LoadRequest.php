<?php

// First, include Requests
include_once('Requests/Requests.php');
// Next, make sure Requests can load internal classes
Requests::register_autoloader();
// define API URL
define('API_URL', 'http://localhost/libreria/');

?>