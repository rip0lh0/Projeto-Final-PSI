<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use app\models\TipoPerfil;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $nome;
    public $nif;
    public $morada;
    public $localidade;
    public $nacionalidade;
    public $contacto;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['nome', 'required'],

            ['nif', 'required'],
            ['nif', 'string', 'min' => 9, 'max' => 9],
            ['nif', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This nif is already being used.'],

            ['morada', 'required'],

            ['localidade', 'required'],

            ['nacionalidade', 'required'],

            ['contacto', 'required'],
            ['contacto', 'string', 'min' => 9, 'max' => 9],
            ['contacto', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This contact is already being used.'],

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            

            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save() == null) return null;
            var_dump($this);
            $perfil = new Perfil(); // teste
            $perfil->nome = $this->nome;    
            $perfil->nif = $this->nif;
            $perfil->morada = $this->morada;
            $perfil->localidade = $this->localidade;
            $perfil->nacionalidade = $this->nacionalidade;
            $perfil->contacto = $this->contacto;
            if ($perfil->save() == null) return null;

            /* Creates Kennel */
            $auth = \Yii::$app->authManager;
            $kennelRole = $auth->getRole('kennel');
            $auth->assign($kennelRole, $user->getId());

            /* Creates Adopters */
            // $auth = \Yii::$app->authManager;
            // $adopterRole = $auth->getRole('adopter');
            // $auth->assign($adopterRole, $user->getId());

            return $user;
        }

        return null;
    }
}
