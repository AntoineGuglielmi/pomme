<?php
function load_functions($dirRoot = null)
{
    if(is_null($dirRoot))
    {
        $dirRoot = dirname(__FILE__);
    }
    $thisFile = basename(__FILE__);
    $scandir = scandir($dirRoot);
    foreach($scandir as $dir)
    {
        if(in_array($dir,['.','..',$thisFile]))
        {
            continue;
        }
        $dirRealpath = "$dirRoot/$dir";
        if(is_dir($dirRealpath))
        {
            load_functions($dirRealpath);
        }
        else
        {
            require $dirRealpath;
        }
    }
}
load_functions();