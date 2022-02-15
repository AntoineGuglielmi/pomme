<?php
class Route
{
    private $routesDeclaration;
    private $method;
    private $uri;
    private $name;
    private $file;
    private $function;
    public function __construct($method,$uri,$routesDeclaration)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->routesDeclaration = $routesDeclaration;
        return $this;
    }
    public function name($name)
    {
        $this->name = $name;
        return $this;
    }
    public function file($file)
    {
        if(!realpath("$file.php"))
        {
            $file = ROOT.'api/'.$this->method."/$file.php";
        }
        $this->file = $file;
        return $this;
    }
    public function func($function)
    {
        $this->function = $function;
        return $this;
    }
    public function __destruct()
    {
        $this->routesDeclaration->set_route($this->method,$this->uri,[
            'name' => $this->name,
            'file' => $this->file,
            'function' => $this->function
        ]);
    }
}