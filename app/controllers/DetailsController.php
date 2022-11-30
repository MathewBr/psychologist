<?php

namespace app\controllers;

class DetailsController extends AppController{

    public function indexAction(){
        if (!empty($_GET) && isset($_GET['type'])){
            $type = $_GET['type'];
        }
        $this->passData(compact('type'));
        $this->setMeta('Подробнее');
    }

}