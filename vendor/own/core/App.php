<?php
namespace core;

class App{

    public $registry;

    public function __construct(){
        new ErrorHandler();
        $query = trim($_SERVER['QUERY_STRING'], '/');
        session_start();
        $this->registry = Registry::instance();
        $this->pullParameters();
        $router = Router::instance(require_once CONF . '/routes.php');
        $router->dispatch($query);
    }


    protected function pullParameters(){
        $params = require_once CONF . '/parameters.php';
        if (!empty($params)){
            foreach ($params as $k => $v){
                $this->registry->writeParameters($k, $v);
            }
        }
    }
}