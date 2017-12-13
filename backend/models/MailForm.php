<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * MailForm is the model behind the mail user form.
 */
class MailForm extends Model
{
    public $subject;
    public $body;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['subject', 'body'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
}
