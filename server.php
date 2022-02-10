<?php
$server = new stdClass();
foreach($_SERVER as $k => $v)
{
    $kLower = strtolower($k);
    $server->$kLower = $v;
}
return $server;