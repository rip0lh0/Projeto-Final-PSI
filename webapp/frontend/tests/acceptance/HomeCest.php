<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->see('ADOTAR');
        $I->click('Adotar');
        $I->wait(2);
        $I->moveMouseOver('.product-img');
        $I->wait(2);
        $I->see('ADOTAR');
        $I->click('Adotar');
        $I->wait(3);
        $I->fillField(['id'=>'loginform-username'],"Matheus");
            $I->fillField(['id'=>'loginform-password'],"Matheus");
        $I->see('Login');
        $I->click('Login');
        $I->wait(3);
        $I->see('Contactar');
        $I->click('Contactar');
        $I->wait(2);
        $I->fillField(['id'=>'messageform-message'],"QUERO O GORDO");
        $I->click(['name'=>'submit-button']);
        // $I->see('index');
        // $I->seeLink('index');
        // $I->wait(5); // wait for page to be opened

        // $I->see('This is the Main page.');
    }
    // public function checkMenu(AcceptanceTester $I)
    // {
    //     $I->amOnPage(Url::toRoute('/site/signupmenu'));
    //     $I->see('Utilizador');
    //     $I->seeLink('menu');
    //     $I->click('');
    //     $I->wait(5); // wait for page to be opened

    //     $I->see('This is the Menu page.');
    // }
}

