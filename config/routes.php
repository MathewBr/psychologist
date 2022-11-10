<?php
//специальные правила должны быть выше общих (дефолтных)
return [
    '^product/(?P<alias>[a-z0-9-]+)/?$' => ['controller' => 'Product', 'action' => 'view'],
    '^category/(?P<alias>[a-z0-9-]+)/?$' => ['controller' => 'Category', 'action' => 'view'],
    '^admin$' => ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin'],
    '^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$' => ['prefix' => 'admin'],
    '^$' => ['controller' => 'Main', 'action' => 'index'],
    '^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$' => [],
];

//use core\Router;
//$router = Router::instance();
//$router->add('^product/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'view']);
//$router->add('^category/(?P<alias>[a-z0-9-]+)/?$', ['controller' => 'Category', 'action' => 'view']);
//$router->add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
//$router->add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);
//$router->add('^$', ['controller' => 'Main', 'action' => 'index']);
//$router->add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');