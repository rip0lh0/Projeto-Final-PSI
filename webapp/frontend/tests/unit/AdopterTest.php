<?php namespace frontend\tests;
use yii\helpers\Url;
use \Codeception\Specify;
use common\models\User;
use frontend\tests\UnitTester;
use frontend\models\SignupForm;

use common\models\Adopter;
use common\models\Kennel;
use common\models\PasswordResetRequestForm;
use common\models\ResetPasswordForm;

class AdopterTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    public $adopter;
    public $user;
    

    // tests
    public function testAdopterName()
    {
        $adopter = new adopter();
        $adopter->name = 'jose';
        $this->assertEquals($adopter->name, 'jose');
    }
    public function testAdopterPhone()
    {
        $adopter = new adopter();
        $adopter->cellphone = '969897973';
        $this->assertEquals($adopter->cellphone, '969897973');
    }
    public function testSavingAdopter(){

        $model = new SignupForm();
        $model->name = 'jose';
        $model->phone = '969897973';
        $model->user_type = User::TYPE_ADOPTER;
        $model->signup();
    }
}