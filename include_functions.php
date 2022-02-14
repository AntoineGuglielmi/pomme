<?php
function include_functions($rootDir = ROOT.'functions')
{
    $rootDir = realpath($rootDir);
    $scandir = scandir($rootDir);
    echo '<pre>';
    var_dump($scandir);
    echo '</pre>';
}

include_functions();