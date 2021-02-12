<?php

namespace IvansWeb\Init;

abstract class Bootstrap {
    protected $route;

    public function __construct()  {
        $this->initRoutes();
        $this->run($this->getUrl());
    }

    abstract protected function initRoutes();

    protected function run($url)    {
        
        $controller = $action = '';
        

            $lista = list($void, $module, $controller) = explode('/', $url);

            //echo "<pre>";
            //print_r($lista);
            //die();
            
            if(count($lista) == 3){
                $lista = list($void, $module, $controller) = explode('/', $url);
                $controller = $lista[2];
            }else if (count($lista) == 4){
                $lista = list($void, $module, $controller, $action) = explode('/', $url);
                $controller =  $lista[2];
                $action =  $lista[3];
            }

            if($controller == ''){
                $controller = "index";
            }
            if($action == ""){
                $action = "index";
            }
            

            //echo "<br>Controller: ".$controller;
            //echo "<br>action: ".$action;
            //die();

            if($action == ''){
                $action = 'index';
            }
        
        $class = "App\Controllers\\".ucfirst($controller)."Controller";
        $controller = new $class;
        $action .= "Action";
        $controller->$action();
        return;
    }

    protected function setRoute(array $routes) {
        $this->route = $routes;
    }

    protected function getUrl(){
       return  parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    }
}