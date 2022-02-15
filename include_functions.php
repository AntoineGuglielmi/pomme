<?php
function include_functions($rootDir = ROOT.'functions')
{
    $rootDir = realpath($rootDir);
    $scandir = scandir($rootDir);
    foreach($scandir as $dir)
    {
        if(in_array($dir,['.','..']))
        {
            continue;
        }
        $dir = "$rootDir/$dir";
        if(!is_dir($dir))
        {
            include $dir;
        }
        else
        {
            include_functions($dir);
        }
    }
}

include_functions();