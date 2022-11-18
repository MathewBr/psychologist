<?php

namespace app\controllers;

use core\base\Controller;

class MainController extends AppController {

    public function indexAction(){
        $this->setMeta('Главная', 'Метрология', 'Метрология');
    }

}