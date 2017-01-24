<?php

class Mail
{

    public $messages;
    public $mailer;
    private $errors;

    public function __construct()
    {
        //$transport = Swift_SmtpTransport::newInstance('127.0.0.1', 25);
        $transport = Swift_SmtpTransport::newInstance('smtp.orange.fr', 25);

        $this->mailer = Swift_Mailer::newInstance($transport);
        $this->message = Swift_Message::newInstance();
    }

    public function setDatas($subject, $fromTo, $from, $to, $body, $reply)
    {
        $this->message
              ->setSubject($subject)
              ->setFrom(array($from => $fromTo))
              ->setTo(array($to => 'Crédit Agricole Sud Rhône Alpes'))
              ->setReplyTo($reply)
              ->setBody($body, 'text/html');
    }

    public function sendMail()
    {
        $this->mailer->send($this->message);
    }

    public function setErrors($errors)
    {
        $this->errors = $errors;

        return $this;
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
