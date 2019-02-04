<?php 

namespace frontend\models;

use yii\base\Model;
use common\models\User;




class ProfileForm extends Model
{
    public $id_user;
    public $id_adopter;

    public $username;
    public $email;
    public $name;
    public $phone;

    public function rules()
    {
        return [
            [
                ['id_user', 'id_adopter', 'username', 'name', 'email'],
                'required',
                'message' => '{attribute} não pode ficar em branco'
            ],
            /* User */
            [
                ['username', 'name', 'email'],
                'string'
            ],
            /* Contacts */
            [
                ['phone'],
                'number',
                'min' => 100000000,
                'max' => 999999999
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id_user' => 'ID User',
            'id_kennel' => 'ID Canil',
            'name' => 'Nome',
            'email' => 'Email',
            'username' => 'Nome de Utilizador',
            'phone' => 'Telefone'
        ];
    }


    public function update()
    {
        $user = User::find()->where(['id' => $this->id_user])->one();
        if (!$user) return ['error' => 'Faild To Save Changes'];

        $user->email = $this->email;
        if (!$user->validate()) return ['error' => 'Faild To Save Changes'];

        $adopter = $user->adopter;
        if (!$adopter) return ['error' => 'Faild To Save Changes'];

        $adopter->name = $this->name;
        $adopter->cellphone = $this->phone;

        if (!$adopter->validate()) return ['error' => 'Faild To Save Changes'];

        $adopter->update();
        $user->update();

        return ['success' => 'All Changes Saved'];

    }



}

