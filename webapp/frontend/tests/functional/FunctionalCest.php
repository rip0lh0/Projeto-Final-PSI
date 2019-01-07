<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;
use yii\helpers\Url;

class FunctionalCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
            //   tryToLoginUser();
    }
    public function tryToLoginUser(FunctionalTester $I){
        $I->amOnPage('index');
            $I->click(['id' => 'loginButton']);   
            $I->submitForm('form#login-form', ['LoginForm[username]' => 'valter', 'LoginForm[password]' => 'Pacheco5991']);          
            $I->see('Logout');
    }
    // public function tryToLogout(FunctionalTester $I){
    //     $I->amOnPage();
    //     $I->click();
    //     $I->submitForm();
    //     $I->see();
           
    // }
    public function tryToCreateUser(FunctionalTester $I){
        $I->amOnPage('index');
        $I->click(['id' => 'signupButton']);
        $I->amOnPage('menu');
        // $I->click(['id' => 'signupAdopterButton']); 
        
        //$I->submitForm('form#signup-form',['SignupForm[username]' => 'supect', 'SignupForm[password]' => 'suspect1234']);
        //$I->see('Logout');

    }


    
}
