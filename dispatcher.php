<?php
namespace mvc;

class Dispatcher
{

    private $request;

    public function dispatch()
    {
        $this->request = new Request();
        
        Router::parse($this->request->url, $this->request);
        
        $controller = $this->loadController();

        call_user_func_array([$controller, $this->request->action], $this->request->params);
    }

    public function loadController()
    {
        $controllerName = ucfirst($this->request->controller);
        $name = $controllerName . "Controller";
        $name = "mvc\Controllers\\".$name;
        $controller = new $name();
        return $controller;
    }

}