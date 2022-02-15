<?php
include 'config.php';
include ROOT.'include_functions.php';

$request_uri = uri();
$request_method = method();

include ROOT.'core/Routes.php';
$r = new Routes();
include ROOT.'routes.php';
$routes = $r->get_routes();

route($routes,$request_method,$request_uri);