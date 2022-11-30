<?php

namespace app\models;

use core\App;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;

class Message extends AppModel{
    public $email;
    public $name;
    public $phone;
    public $topic;
    public $typesession;
    private $smtp_host;
    private $smtp_port;
    private $smtp_protocol;
    private $smtp_login;
    private $smtp_password;

    public function __construct($formData = []){
        if (isset($formData['email'])) $this->email = $formData['email'];
        if (isset($formData['name'])) $this->name = $formData['name'];
        if (isset($formData['phone'])) $this->phone = $formData['phone'];
        if (isset($formData['topic'])) $this->topic = $formData['topic'];
        if (isset($formData['typesession'])) $this->typesession = $formData['typesession'];
        $config = require_once CONF . '/config_smtp.php';
        $this->smtp_host = $config['smtp_host'];
        $this->smtp_port = $config['smtp_port'];
        $this->smtp_protocol = $config['smtp_protocol'];
        $this->smtp_login = $config['smtp_login'];
        $this->smtp_password = $config['smtp_password'];
    }

    public function sendMessage(){
        $transport = Transport::fromDsn("smtp://{$this->smtp_login}:{$this->smtp_password}@{$this->smtp_host}:{$this->smtp_port}");
        $mailer = new Mailer($transport);
        $message = (new Email());
        if ($this->email){
            $message->from($this->email);
        } else {
            $message->from(App::$registry->getParameter('admin_email'));
        }
        $message->to(App::$registry->getParameter('admin_email'));
        $message->subject("Обращение от {$this->name}");
        $html = "<p>Обращение от <b>{$this->name}<b /><p/>
                 <p>Контактные данные: </p>
                 <ul>
                     <li>Адрес: {$this->email}</li>
                     <li>Телефон: {$this->phone}</li>
                 </ul>
                 <p>Тема обращения:<br/> 
                 <span style='font-size: small'>{$this->topic}</span><p/>
                 <p>Тип запроса: {$this->typesession}</p>";
        $message->html($html);
        $mailer->send($message);

        if ($this->email){
            $message = (new Email());
            $message->from(App::$registry->getParameter('admin_email'));
            $message->to($this->email);
            $message->subject("Ирина Шипилова");
            $html = "<p>Здравствуте, <b>{$this->name}.<b /><p/>
                 <p>Вы обратились к психологу Ирине Шипиловой.<br/>
                  В ближайшее время мы с Вами свяжемся по указанным данным: </p>
                 <ul>
                     <li>Адрес: {$this->email}</li>
                     <li>Телефон: {$this->phone}</li>
                 </ul>";
            $message->html($html);
            $mailer->send($message);
        }
    }

    public function getProperties(){
        return ['email' => $this->email, 'name' => $this->name,'phone' => $this->phone,'topic' => $this->topic,'typesession' => $this->typesession];
    }
}