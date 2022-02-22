<?php
include ROOT.'core/Route.php';
class Routes
{
    private $routes = [];

    public function __construct()
    {
        return $this;
    }

    public function get($uri)
    {
        return $this->create_route('GET',$uri);
    }

    public function post($uri)
    {
        return $this->create_route('POST',$uri);
    }

    private function create_route($method,$uri)
    {
        return new Route($method,$uri,$this);
    }

    public function set_route($method,$uri,$route)
    {
        $this->routes[$method][$uri] = $route;
    }

    public function get_routes()
    {
        return $this->routes;
    }
}