<?php

namespace IvansWeb\Controller;

use App\DataBase;

abstract class Action {

    protected $views;
    private $action;

    public function __construct() {
        $this->views = new \stdClass;
    }

    protected function render($action, $layout = true) {
        $this->action = $action;
        if ($layout == true && file_exists("App/Views/layout.phtml")) {
            include_once "App/Views/layout.phtml";
        } else {
            $this->content();
        }
    }
    
    public static function getModel($model){
        $class = "\\App\Models\\".ucfirst($model);
        return new $class();
    }

    public static function getController($controller){
        $class = "\\App\Controllers\\".ucfirst($controller);
        $class = $class.'Controller';
        return new $class();
    }

    protected function content() {
        $current = get_class($this);
        $singleClassName = strtolower(str_replace("Controller", "", str_replace("App\\Controllers\\", "", $current)));
        $include = "App/Views/" . $singleClassName . "/" . $this->action . ".phtml";
        // echo "<br>Controller:".$controller."<hr>";
        // echo "<br>Action:".$this->action."<hr>";
        include_once $include;
    }
}
