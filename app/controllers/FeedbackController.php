<?php

namespace app\controllers;

use app\models\Message;
use function MongoDB\BSON\toJSON;

class FeedbackController extends AppController{

    public function indexAction(){
        if (!empty($_POST)){
            $later = new Message($_POST);
            $later->sendMessage();
        }
//        $this->passData(compact(''));
        $this->setMeta('Отправка сообщения');
    }

    public function fetchAction(){
        if (!empty($_POST)){
            $later = new Message($_POST);
            $later->sendMessage();
        }
        $this->layout = false;
        $this->sendAjaxResponse(WIDGETS . '/send.php');
    }
}