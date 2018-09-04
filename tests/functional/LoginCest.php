<?php

namespace App\Tests\functional;

use App\Tests\FunctionalTester;
use Codeception\Util\HttpCode;

class LoginCest
{
    public function tryLogin(FunctionalTester $I)
    {
        $I->goOnPage('/');
        $I->seeCurrentUrlEquals('/login');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->submitForm('form', ['_username' => 'user@test.fr', '_password' => 'user']);
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->canSee('Hello', 'p');
    }
    public function tryLoginFail(FunctionalTester $I)
    {
        $I->goOnPage('/login');
        $I->submitForm('form', ['_username' => 'user@test.fr', '_password' => 'mauvais']);
        $I->seeCurrentUrlEquals('/login');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->see('Invalid credentials', 'div');
    }
    public function tryLoginHelper(FunctionalTester $I)
    {
        $I->amLoggedAsUser();
        $I->goOnPage('/');
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->canSee('Hello', 'p');
    }
    public function tryReLogin(FunctionalTester $I)
    {
        $I->amLoggedAsUser();
        $I->goOnPage('/login');
        $I->seeCurrentUrlEquals('/');
    }
    public function tryLogout(FunctionalTester $I)
    {
        $I->amLoggedAsUser();
        $I->goOnPage('/');
        $I->see('Logout', 'a');
        $I->click('Logout', 'a');
        $I->seeCurrentUrlEquals('/login');
        $I->goOnPage('/');
        $I->seeCurrentUrlEquals('/login');
    }
}