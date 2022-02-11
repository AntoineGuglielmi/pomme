<?php
foreach($_SERVER as $k => $v)
{
    $kLower = strtolower($k);
    $functionName = "get_$kLower";
    $$functionName = function() {
        return $v;
    };
    // echo '<pre>';
    // var_dump($kLower,$functionName);
    // echo '</pre>';
}