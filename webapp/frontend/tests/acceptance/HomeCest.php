<?php
namespace frontend\tests\acceptance;

use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class HomeCest
{
    public function checkHome(AcceptanceTester $I)
    {
        $I->amOnPage('/');
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

