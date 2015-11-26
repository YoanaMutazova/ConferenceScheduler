<?php
session_start();
require_once '/../View.php';

class App {
    
    protected $controller = DEFAULT_CONTROLLER;
    
    protected $method = DEFAULT_ACTION;
    
    protected $params = array();


    public function __construct() {
        if (isset($_SESSION['userId'])) {
            $this->method = 'logged';
        }
        
        $url = $this->parseUrl();

        if (file_exists('../app/controllers/' . ucfirst($url[0]) . 'Controller.php'))
        {
            $this->controller = $url[0];
            View::$controllerName = $this->controller;
            unset($url[0]);
        }
        
        $this->controller = ucfirst($this->controller) . 'Controller';
        
        require_once '../app/controllers/' . $this->controller . '.php';
        
        $this->controller = new $this->controller;
        
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        View::$actionName = $this->method;
        $this->params = $url ? array_values($url) : array();
        
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url =  explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
