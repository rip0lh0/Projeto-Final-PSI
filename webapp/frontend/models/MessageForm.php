<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * KennelContactForm is the model behind the contact form.
 */
class MessageForm extends Model
{
    public $name;
    public $email;
    public $body;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'body'], 'required'],
            ['email', 'email'],
            [['body'], 'string', 'max' => 255]
        ];
    }

}

