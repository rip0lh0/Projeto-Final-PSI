<?php namespace frontend\tests;

class UnityTest extends \Codeception\Test\Unit
{
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

    public function testUsername(){
        $user = new User;
        $user->

    }


    // tests
    public function testSomeFeature()
    {

    }
}