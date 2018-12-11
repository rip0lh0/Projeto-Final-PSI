<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use app\models\TipoPerfil;
use common\models\Kennel;
use common\models\Adopter;

/**
 * Signup form
 */
class SignupForm extends Model
{

    const SELF_KENNEL = 0;
    const SELF_ADOPTER = 1;


    public $user_type = -1;

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
            [['username', 'email', 'password', 'name'], 'required', 'message' => '{attribute} não pode ficar em branco.'],

            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['name', 'string', 'max' => 255],

            ['nif', 'unique', 'targetClass' => '\common\models\kennel', 'message' => 'This nif address has already been taken.'],
            ['nif', 'string', 'min' => 9, 'max' => 9],

            [['local', 'address', 'nif'], 'required', 'when' => function ($model) {
                return ($this->user_type == SignupForm::SELF_KENNEL);
            }, 'message' => '{attribute} não pode ficar em branco.'],

            [['local', 'address'], 'string', 'max' => 255],
            ['phone', 'string', 'min' => 11, 'max' => 11],
        ];
    }


    public function signupAdopter($user)
    {
        $adopter = new Adopter();

        $adopter->id_user = $user->id;
        $adopter->name = $this->name;
        $adopter->cellphone = $this->phone;

        if ($adopter->save() == null) return false;

        /* Creates Adopters */
        $auth = \Yii::$app->authManager;
        $role = $auth->getRole('adopter');
        $auth->assign($role, $user->getId());

        return true;
    }

    public function signupKennel($user)
    {
        $kennel = new Kennel();

        $kennel->id_user = $user->id;
        $kennel->name = $this->name;
        $kennel->nif = $this->nif;
        $kennel->address = $this->address;

        if ($kennel->save() == null) return false;

        $auth = \Yii::$app->authManager;
        $role = $auth->getRole('kennel');
        $auth->assign($role, $user->getId());

        return true;
    }


    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $valid = true;

            $user = new User();

            $user->username = $this->username;
            $user->email = $this->email;
            $user->id_local = $this->local;
            $user->setPassword($this->password);
            $user->generateAuthKey();


            $valid = $valid && $user->save();

            switch ($this->user_type) {
                case SignupForm::SELF_KENNEL:
                    $valid = $valid && $this->signupKennel($user);
                    break;
                case SignupForm::SELF_ADOPTER:
                    $valid = $valid && $this->signupAdopter($user);
                    break;
                default:
                    $valid = $valid && false;
            }

            if ($valid) return $user;

            $user->delete();
        }

        return null;
    }
}
