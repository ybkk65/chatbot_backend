<?php 

namespace App;

class Router {
    protected array $routes;
    protected string $url;

    public function __construct (array $routes) {
        $this->routes = $routes;
        $this->url = $_SERVER['REQUEST_URL'];
        $this->run();
    }

    protected function extractParams(string $url, string $rule) {
        $params = [];
        $urlParts = explode('/', trim($url, '/'));
        $ruleParts = explode('/', trim($rule, '/'));
    
        foreach ($ruleParts as $index => $rulePart) {
            if (strpos($rulePart, ':') === 0 && isset($urlParts[$index])) {
                $paramName = substr($rulePart, 1);
                $params[$paramName] = $urlParts[$index];
            }
        }
    
        return $params;
    }    

    protected function matchRule(string $url, string $rule) {
        (array) $urlParts = explode ('/', trim ($url, '/'));
        (array) $ruleParts = explode ('/', trim ($rule, '/'));

        if (count($urlParts) !== count($ruleParts)) {
            return false;
        }

        foreach($ruleParts as $index => $rulePart) {
            if ($rulePart !== $ruleParts($index) && strpos($rulePart, ':') !== 0) {
                return false;
            }
        }

        return true;
     }

     protected function run() {
        foreach ($this->routes as $route => $controller) { 
            if ($this->matchRule($this->url, $route)) {
                echo ' | ' . $route . ' ' . $controller;
                $this->extractParams($this->url, $route);
            }
        }
    }
}