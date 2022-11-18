<?php

namespace core;

class Router{

    protected $routes = [];
    protected $route = [];

    protected function __construct($rules = []){
        $this->pullRules($rules);
    }

    use TSingletone;

    public function dispatch($url){
        $url = $this->removeQueryString($url);//separate uri ? parameter
        if ($this->matchRoute($url)){
            $controller = 'app\controllers\\' . $this->route['prefix'] . $this->route['controller'] . 'Controller';

//            debug($controller, 1);

            if (class_exists($controller)){
                $controllerObject = new $controller($this->route);
                $action = $this->lowerCamelCase($this->route['action']) . 'Action';
                if (method_exists($controllerObject, $action)){
                    $controllerObject->$action();
                    $controllerObject->displayView();//every controller inherits this method from Controller
                }else{
                    throw new \Exception("Метод {$controller}::{$action} не найден.", 404);
                }
            }else{
                throw new \Exception("Контроллер {$controller} не найден.", 404);
            }
        }else{
            throw new \Exception("Страница не найдена", 404);
        }
    }

    public function matchRoute($url){ //looks for a match in the $this->$routes
        foreach ($this->routes as $pattern => $route){
            if (preg_match("#{$pattern}#i", $url, $matches)){
                foreach ($matches as $k => $match){
                    if (is_string($k)){
                        $route[$k] = $match;//add to route array
                    }
                }
                if (empty($route['action'])){
                    $route['action'] = 'index'; //default action
                }
                if (empty($route['prefix'])){
                    $route['prefix'] = ''; //default prefix
                }else{
                    $route['prefix'] .= '\\';
                }

                $route['controller'] = $this->upperCamelCase($route['controller']);
                $this->route = $route;
                return true;
            }
        }
        return false;
    }

    //CamelCase - for controllers
    protected function upperCamelCase($name){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    }

    //camelCase - for actions
    protected function lowerCamelCase($name){
        return lcfirst($this->upperCamelCase($name));
    }

    //в результате переадресации .htaccess http://metrology:8080/view/page?id=1 /view/page - не явные get параметры, после ? - явные get параметры
    //кромсание url не влияет на $_GET массив
    protected function removeQueryString($url){
        if ($url){ //по запросу http://metrology:8080/metrology?id=1 приходит metrology&id=1
            $partsURL = explode('&', $url, 2);
            if (false === strpos($partsURL[0], '=')){
                return rtrim($partsURL[0], '/');
            }else{
                return '';
            }
        }
    }












    public function add($regexp, $route = []){
        $this->routes[$regexp] = $route;
    }

    public function getRoutes(){
        return $this->routes;
    }

    public function getRoute(){
        return $this->route;
    }

    protected function pullRules($rules){
        if (!empty($rules)){
            foreach ($rules as $regexp => $rule){
                $this->routes[$regexp] = $rule;
            }
        }else{
            throw new \Exception('Установите правила маршрутизации', 500);
        }
    }
}