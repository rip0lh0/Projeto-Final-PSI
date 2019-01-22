<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;
use yii\helpers\Url;

class FunctionalCest
{
    public function tryToLoginUser(FunctionalTester $I){
        $I->amOnPage('index');
        $I->click(['id' => 'btn-login']);
        $I->submitForm('form#login-form', ['LoginForm[username]' => 'valter', 'LoginForm[password]' => '123456789']);          
        $I->amLoggedInAs(7);
    }
    public function tryToCreateUser(FunctionalTester $I){
        $I->amOnPage('index');
        $I->click(['id' => 'btn-login']);
        $I->amOnPage('authentication'); 
        $I->click(['id' => 'btn-create-account']);                 
        $I->amOnPage('menu');
        $I->click(['id'=>'btn-create-user']);
        $I->submitForm('form#signup-form', ['SignupForm[username]' => 'suspect','SignupForm[name]' => 'suspect','SignupForm[email]' => 'suspect@gmail.com', 'SignupForm[password]' => '123456789']);
    }
    public function tryToCreateKennel(FunctionalTester $I){
        $I->amOnPage('index');
        $I->click(['id' => 'btn-login']);
        $I->amOnPage('authentication');
        $I->click(['id' => 'btn-create-account']); 
        $I->amOnPage('menu');
        $I->click(['id'=>'btn-create-kenel']);
        $I->submitForm('form#signup-form', ['SignupForm[username]' => 'suspect','SignupForm[name]' => 'suspect','SignupForm[email]' => 'suspect@gmail.com', 'SignupForm[password]' => '123456', 'SignupForm[phone]' => '123456789', 'SignupForm[address]' => 'rua','SignupForm[nif]' => '987654321','SignupForm[local]' => 'vila do bispo']);
    }

    public function tryToAdoptAnimal(FunctionalTester $I){
        $I->amOnPage('index'); 
        $I->amLoggedInAs(7);       
        $I->click(['id' => 'btn-adotar']);
        $I->amOnPage('animal/index'); 
        $I->click(['class' => 'btn essence-btn']);
    }

    
    // public function tryToLoginBackOffice(FunctionalTester $I){
    //     $I->amOnPage('admin/site/login');

    // }

    // // public function tryToInsertAnimal(FunctionalTester $I){
    // //     $I->amLoggedInAs(12);
    // //     // $I->click('Animal'); falta colocar o botão no header para ir pra pagina Animal
    // //     $I->seeCurrentUrlEquals('localhost/animal');

    // }
    
}
