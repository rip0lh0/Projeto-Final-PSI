<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\Kennel;
use common\models\Adopter;

/**
 * Signup form
 */
class SignupForm extends Model
{
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
                return ($this->user_type == User::TYPE_KENNEL);
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
        $kennel->id_local = $this->local;

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
            $user = new User();

            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            if (!$user->save()) return null;

            switch ($this->user_type) {
                case User::TYPE_KENNEL:
                    $this->signupKennel($user);
                    return $user;
                case USER::TYPE_ADOPTER:
                    $this->signupAdopter($user);
                    return $user;
                default:
                    $user->delete();
            }
        }

        return null;
    }
}
