<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo 'allo ?';
// $server = require 'server.php';

echo '<pre>';
var_dump('nts',get_request_method());
echo '</pre>';
// require 'functions/load_functions.php';
// $request_uri = $server->request_uri;
// $request_method = $server->request_method;
// if($request_uri === '/index.php')
// {
//     header('Location: /');
// }
// echo $request_uri;
// echo '<br>';
// echo $request_method;