<?php namespace common\models;
use yii\helpers\Url;
use \Codeception\Specify;
use frontend\tests\UnitTester;



class UnityTest extends \Codeception\Test\Unit
{
    
/** @specify */
    private $user;
    /**
     * @var \frontend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    public function testFistName(){
        $user = new User;
        $user->setFirstName('valter');
        $this->assertEquals($user->getFistName(), 'valter');
    }

    // public function testUsername(){
    //     // $user = new User;
    // }

    function testSavingUser()
    {
    $user = new User();
    $user->setName('Miles');
    $user->setSurname('Davis');
    $user->save();
    $this->assertEquals('Miles Davis', $user->getFullName());
    $this->tester->seeInDatabase('users', ['name' => 'Miles', 'surname' => 'Davis']);
}



    public function testValidation()
    {
        $this->user = User::create();

        $this->specify("username is required", function() {
            $this->user->username = null;
            $this->assertFalse($this->user->validate(['username']));
        });

        $this->specify("username is too long", function() {
            $this->user->username = 'toolooooongnaaaaaaameeee';
            $this->assertFalse($this->user->validate(['username']));
        });

        $this->specify("username is ok", function() {
            $this->user->username = 'davert';
            $this->assertTrue($this->user->validate(['username']));
        });
    }
}