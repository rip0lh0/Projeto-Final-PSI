<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;
use yii\helpers\Url;

class FunctionalCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function tryToCreateUser(FunctionalTester $I){
        $I->amOnPage('index');
        $I->click(['id' => 'signupButton']);
        $I->amOnPage('menu');
        $I->click('Registar');
        $I->submitForm('form#signup-form', ['SignupForm[username]' => 'suspect','SignupForm[name]' => 'suspect','SignupForm[email]' => 'suspect@gmail.com', 'SignupForm[password]' => '123456789']);
    }

    public function tryToLoginUser(FunctionalTester $I){
        $I->amOnPage('index');
            $I->click(['id' => 'loginButton']);   
            $I->submitForm('form#login-form', ['LoginForm[username]' => 'valter', 'LoginForm[password]' => 'Pacheco5991']);          
            $I->amLoggedInAs(12);
            // $I->see('Logout');
    }

    public function tryToCreateKennel(FunctionalTester $I){
        $I->amOnPage('index');
        $I->click(['id' => 'signupButton']);
        $I->amOnPage('menu');
        $I->click('Registar');
        $I->submitForm('form#signup-form', ['SignupForm[username]' => 'suspect','SignupForm[name]' => 'suspect','SignupForm[email]' => 'suspect@gmail.com', 'SignupForm[password]' => '123456', 'SignupForm[phone]' => '123456789', 'SignupForm[address]' => 'rua','SignupForm[nif]' => '987654321','SignupForm[local]' => 'vila do bispo']);
    }

    // public function tryToAdoptAnimal(FunctionalTester $I){
    //     $I->amLoggedInAs(12);
    //     // $I->click('Animal'); falta colocar o botão no header para ir pra pagina Animal
    //     $I->seeCurrentUrlEquals('localhost/animal');

    // }

    // public function test(){

    // }
    
}
