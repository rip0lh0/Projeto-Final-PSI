<?php namespace common\models;
use yii\helpers\Url;
use \Codeception\Specify;
use frontend\tests\UnitTester;
use frontend\models\SignupForm;
use frontend\models\Adopter;
use frontend\models\Kennel;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;

class UnityTest extends \Codeception\Test\Unit
{
    
/** @specify */
    public $user;
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;

    public function testFistName(){
        $user = new User();
        $user->username = 'valter';
        $this->assertEquals($user->username, 'valter');
    }

    public function testPassword(){
        $user = new User();
        $user->password_hash = '123456789';
        $this->assertEquals($user->password_hash, '123456789');
    }

    function testSavingUser()
    {
    $model = new SignupForm();
    $model->username = 'test';
    $model->email = 'teste@gmail.com';
    $model->password = '123456789';
    $model->user_type = User::TYPE_KENNEL;
    $model->signup();

}

    // public function testValidation()
    // {
    //     $this->user = new User;

    //     $this->specify("username is required", function() {
    //         $this->user->username = null;
    //         $this->assertFalse($this->user->validate(['username']));
    //     });

    //     $this->specify("username is too long", function() {
    //         $this->user->username = 'toolooooongnaaaaaaameeee';
    //         $this->assertFalse($this->user->validate(['username']));
    //     });

    //     $this->specify("username is ok", function() {
    //         $this->user->username = 'davert';
    //         $this->assertTrue($this->user->validate(['username']));
    //     });
    // }
}