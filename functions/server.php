<?php

function server($key)
{
    return $_SERVER[strtoupper($key)];
}

function method()
{
    return server('request_method');
}

function uri()
{
    return server('request_uri');
}