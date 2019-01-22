<?php

namespace backend\tests\functional;

use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

/**
 * Class LoginCest
 */
class LoginCest
{
    /**
     * Load fixtures before db transaction begin
     * Called in _before()
     * @see \Codeception\Module\Yii2::_before()
     * @see \Codeception\Module\Yii2::loadFixtures()
     * @return array
     */
    public function _fixtures()
    {
        return [
        ];
    }
    
    /**
     * @param FunctionalTester $I
     */
    public function tryToLoginBackOffice(FunctionalTester $I){
        $I->amOnPage('http://localhost/admin');
        $I->fillField(["id"=>"loginform-username"],"canilteste");
        $I->fillField(["id"=>"loginform-password"],"canilteste");
        $I->click(['name' => 'login-button']);
        $I->amLoggedInAs('11');

    }

    
}
