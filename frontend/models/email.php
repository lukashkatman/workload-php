<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Email extends Model
{
    public $name = "Workload AB";
    public $email = "katmanlukash@gmail.com";
    public $subject ="Your pay slip";
    public $body;
    


 

   

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    
    public function setBody($param) {
     $this->body=$param;    
    }
  
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
