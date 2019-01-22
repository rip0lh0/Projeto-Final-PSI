<?php namespace frontend\tests;
use \Codeception\Specify;
use common\models\User;
use frontend\tests\UnitTester;
use frontend\models\SignupForm;
use common\models\Adopter;
use common\models\Kennel;
use common\models\PasswordResetRequestForm;
use common\models\ResetPasswordForm;

class KennelTest extends \Codeception\Test\Unit
{
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    public $kennel;
    public $user;
 
    public function testKennelName()
    {
        $Kennel = new Kennel();
        $Kennel->name = 'animalia';
        $this->assertEquals($Kennel->name, 'animalia');
    }
    public function testKennelNif()
    {
        $Kennel = new Kennel();
        $Kennel->nif = '321654987';
        $this->assertEquals($Kennel->nif, '321654987');
    }
    public function testKennelAddress()
    {
        $Kennel = new Kennel();
        $Kennel->address = 'vale das almas';
        $this->assertEquals($Kennel->address, 'vale das almas');
    }
    public function testKennel()
    {
        $model = new SignupForm();
        $model->name = 'animalia';
        $model->nif = '321654987';
        $model->address = 'vale das almas';
        $model->id_local = '5';
        $model->user_type = User::TYPE_KENNEL;
        $model->signup();       
    }
}