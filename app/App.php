<?php
session_start();

class App {
    
    protected $controller = DEFAULT_CONTROLLER;
    
    protected $method = DEFAULT_ACTION;
    
    protected $params = array();

    public function __construct() {
        if (isset($_SESSION['userId'])) {
            $this->method = 'logged';
        }
        
        $url = $this->parseUrl();
        if (file_exists('app/controllers/' . ucfirst($url[0]) . 'Controller.php'))
        {
            $this->controller = $url[0];
            unset($url[0]);
        }
        
        require_once 'app/controllers/' . ucfirst($this->controller) . 'Controller.php';
        
        $this->controller = new ucfirst($this->controller) . 'Controller';
        
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        
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