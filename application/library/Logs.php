<?php

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;

class Logs
{

    public $ip;
    public $browser;
    public $referrer;

    public function __construct()
    {
        $logger = new Logger('user_logger');
        $logger->pushHandler(new StreamHandler('../logs/agence.log', Logger::INFO));
        $logger->pushHandler(new FirePHPHandler());

        $logger->addInfo('New connection', $info);

    }

    public function getReferrer()
    {

        if (!isset($_SERVER['HTTP_REFERER'])) {
            $this->referrer = "This page was accessed directly";
        } else {
            $this->referrer = $_SERVER['HTTP_REFERER'];
        }

        return $this->referrer;
    }

    public function getUserInfo()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $referrer = $this->getReferrer();

        $info = ['ip' => $ip, 'browser' => $browser, 'referrer' => $referrer];

        return $info;
    }

}
