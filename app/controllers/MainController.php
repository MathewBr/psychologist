<?php

namespace app\controllers;

use core\App;
use core\base\Controller;

class MainController extends AppController {

    public function indexAction(){
        $this->setMeta('Ваш психолог - Шипилова Ирина Константиновна', 'Метрология', 'Метрология');
    }

    public function showblogAction(){
        $url = App::$registry->getParameter('blog');
        $this->passData(compact('url'));
    }
}