<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Adoption;
use common\models\Message;
use common\models\Adopter;

/**
 * KennelContactForm is the model behind the contact form.
 */
class MessageForm extends Model
{
    public $id_user;
    public $id_animal;
    public $id_adoption;
    public $message;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_adopter', 'id_adoption', 'id_animal', 'message'], 'required']
        ];
    }

    public function saveMessage()
    {
        $adoption = new Adoption();
        $message = new Message();

        $adoption->id_adopter = $this->id_user;
        $adoption->id_kennelAnimal = $this->id_animal;

        if (!$adoption->save()) return ["error" => "Faild To Save Adoption"];

        $message->id_user = $this->id_user;
        $message->id_adoption = $adoption->id;
        $message->message = $this->message;

        if (!$message->save()) {
            $adoption->delete();
            return ["error" => "Sommeting gone wrong"];
        }

        return ["success" => $message];
    }


}

