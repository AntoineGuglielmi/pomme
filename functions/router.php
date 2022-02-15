<?php
function route($routes,$method,$uri)
{
    $params = [];
    $methodRoutes = $routes[$method] ?? [];
    $file = ROOT.'api/ERROR/error.php';
    $function = 'error';
    foreach($methodRoutes as $routeUri => $routePack)
    {
        $routeUri = preg_replace('/\{[^\/]*\}/','(.*)',$routeUri);
        if(preg_match("#^$routeUri$#",$uri,$matches))
        {
            $params = array_slice($matches,1);
            extract($routePack);
            // if(!file_exists($file))
            // {
            //     $file = ROOT.'ERROR/error.php';
            //     $function = 'error';
            // }
            break;
        }
    }
    include $file;
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');
    call_user_func_array($function,$params);
}