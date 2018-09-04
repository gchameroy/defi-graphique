<?php
namespace App\Tests\functional;

use App\Tests\FunctionalTester;
use Codeception\Util\HttpCode;

class UserCest
{
    public function tryRegistration(FunctionalTester $I)
    {
        $I->goOnPage('/');
        $I->seeCurrentUrlEquals('/login');
        $I->click('Cliquez ici', 'a');
        $I->goOnPage('/registration');
        $I->seeCurrentUrlEquals('/registration');
        $I->seeResponseCodeIs(HttpCode::OK);

        $I->submitForm('form', [
            'user[email]' => 'user1@test.fr',
            'user[plainPassword][first]' => 'user1',
            'user[plainPassword][second]' => 'user1'
        ]);
        $I->seeCurrentUrlEquals('/login');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->submitForm('form', ['_username' => 'user1@test.fr', '_password' => 'user1']);
        $I->seeCurrentUrlEquals('/');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->canSee('Hello user1@test.fr', 'p');
    }

    public function tryInvalidForm(FunctionalTester $I)
    {
        $I->goOnPage('/registration');
        $I->submitForm('form', [
            'user[email]' => 'user1test.fr',
            'user[plainPassword][first]' => 'user1',
            'user[plainPassword][second]' => 'user2'
        ]);
        $I->canSee('Email invalide');
        $I->canSee('Mot de passe incorrect');
    }

    public function tryEmailExist(FunctionalTester $I)
    {
        $I->goOnPage('/registration');
        $I->submitForm('form', [
            'user[email]' => 'user@test.fr',
            'user[plainPassword][first]' => 'user',
            'user[plainPassword][second]' => 'user'
        ]);
        $I->canSee('Email déjà existant');
    }
}
