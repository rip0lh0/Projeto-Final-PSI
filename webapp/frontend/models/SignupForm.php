<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use app\models\TipoPerfil;
use common\models\Kennel;

/**
 * Signup form
 */
class SignupForm extends Model
{
    /* User */
    public $username;
    public $email;
    public $password;

    /* Common Information */
    public $name;
    public $phone;

    /* Kennel Infromation */
    public $nif;
    public $local;
    public $address;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'trim'],
            [['username', 'email', 'password'], 'required', 'message' => '{attribute} não pode ficar em branco.'],

            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            [['name'], 'required'],
            ['name', 'string', 'max' => 255],

            ['nif', 'unique', 'targetClass' => '\common\models\kennel', 'message' => 'This nif address has already been taken.'],
            ['nif', 'string', 'min' => 9, 'max' => 9],

            [['local', 'address'], 'string', 'max' => 255],
            ['phone', 'string', 'min' => 11, 'max' => 11],
        ];
    }


    public function signupAdopter($user)
    {


        
        /* Creates Adopters */
        $auth = \Yii::$app->authManager;
        $adopterRole = $auth->getRole('adopter');
        $auth->assign($adopterRole, $user->getId());


    }

    public function signupKennel($user)
    {
        $kennel = new Kennel();

        $kennel->id_user = $user->id;
        $kennel->name = $this->name;
        $kennel->nif = $this->nif;
        $kennel->address = $this->address;

        if ($kennel->save() == null) return null;


        $auth = \Yii::$app->authManager;
        $kennelRole = $auth->getRole('kennel');
        $auth->assign($kennelRole, $user->getId());
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
            $user->local = $this->local;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            if ($user->save() == null) return null;

            return $user;
        }

        return null;
    }
}
