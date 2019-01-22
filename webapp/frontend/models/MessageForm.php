<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Adoption;
use common\models\Message;

/**
 * KennelContactForm is the model behind the contact form.
 */
class MessageForm extends Model
{
    public $id_adopter;
    public $id_animal;
    public $id_adoption;
    public $message;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_adopter','id_adoption','id_animal', 'message'], 'required']
        ];
    }

    public function saveMessage(){
        $adoption = new Adoption();
        $message = new Message();

        $adoption->id_adopter = $this->id_adopter;
        $adoption->id_animal = $this->id_animal;
        $adoption->state = 0;

        $adoption->save();

        $message->id_adoption = $adoption->id;
        $message->message = $this->message;
        $message->satus=0;

        $message->save();


    }


}

