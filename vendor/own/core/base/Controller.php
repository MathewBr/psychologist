<?php
namespace core\base;

abstract class Controller{

    public $route; //array with all route data

    public $viewFolder; //separately
    public $viewfile;//corresponds to the action
    public $layout;
    public $prefix;//separately
    public $controller;
    public $model;
    public $data = []; //transmitted data in view
    public $meta = []; //data for tag <meta>

    public function __construct($route){
        $this->route = $route;
        $this->viewFolder = lcfirst($route['controller']); //at the same time is folder name with views for corresponding controller
        $this->viewfile = $route['action'];//file name corresponding to this action
        $this->prefix = $route['prefix'];
        $this->controller = $route['controller'];//each controller has its own default model
    }

    public function passData($data){
        $this->data = $data;
    }

    public function setMeta($title='', $description='',$keywords=''){
        $this->meta['title'] = h($title);
        $this->meta['description'] = h($description);
        $this->meta['keywords'] = h($keywords);
    }

    public function displayView(){
        $viewObject = new View($this->route, $this->layout, $this->viewfile, $this->meta);
        $viewObject->render($this->data);
    }

    //distinguishes a ajax-request from following a link
    public function isAjax(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function sendAjaxResponse($view, $vars = []){
        extract($vars);
        $model = strtolower($this->model);
//        require APP . "/views/{$this->prefix}{$model}/{$view}.php";
        require $view;
        die();
    }

}