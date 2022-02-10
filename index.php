<?php
$server = require 'server.php';
$request_uri = $server->request_uri;
$request_method = $server->request_method;
if($request_uri === '/index.php')
{
    header('Location: /');
}
echo $request_uri;
echo '<br>';
echo $request_method;