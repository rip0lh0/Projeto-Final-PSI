<?php

namespace backend\models;

use yii\base\Model;

use common\models\User;


class ProfileForm extends Model
{

    public $id_user;
    public $id_kennel;

    /* User */
    public $email;
    public $username;
    public $name;
    
    /* Location */
    public $id_local;
    public $id_sublocal;
    public $address;

    /* Social */
    public $facebook;
    public $instagram;
    public $youtube;

    /* Contacts */
    public $phone;
    public $cell_phone;


    public function rules()
    {
        return [
            [
                ['id_user', 'id_kennel', 'email', 'username', 'name', 'id_local', 'id_sublocal', 'address'],
                'required',
                'message' => '{attribute} não pode ficar em branco'
            ],
            /* User */
            [
                ['email', 'name', 'username', 'address'],
                'string'
            ],
            /* Location */
            [
                ['id_local', 'id_sublocal'],
                'integer'
            ],
            /* Social */
            [
                ['facebook', 'instagram', 'youtube'],
                'string'
            ],
            /* Contacts */
            [
                ['phone', 'cell_phone'],
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
            'id_local' => 'Distrito',
            'id_sublocal' => 'Conselho',
            'address' => 'Morada',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'youtube' => 'Youtube',
            'phone' => 'Telefone',
            'cell_phone' => 'Telemóvel'
        ];
    }

    public function update()
    {
        $user = User::find()->where(['id' => $this->id_user])->one();

        $user->email = $this->email;

        if (!$user->validate()) return ['error' => 'Faild To Save Changes'];

        $kennel = $user->kennel;

        $kennel->name = $this->name;
        $kennel->id_local = $this->id_sublocal;
        $kennel->address = $this->address;

        $kennel->facebook = $this->facebook;
        $kennel->instagram = $this->instagram;
        $kennel->youtube = $this->youtube;
        $kennel->phone = $this->phone;
        $kennel->cell_phone = $this->cell_phone;

        if (!$kennel->validate()) return ['error' => 'Faild To Save Changes'];


        $kennel->update();
        $user->update();

        return ['success' => 'All Changes Saved'];

    }

}




