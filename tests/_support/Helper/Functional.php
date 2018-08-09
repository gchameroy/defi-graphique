<?php

namespace App\Tests\Helper;

use Codeception\Module\Symfony;

class Functional extends \Codeception\Module
{
    public function amLoggedAsUser()
    {
        try {
            /** @var Symfony $I */
            $I = $this->getModule('Symfony');
            $I->amOnPage('/login');
            $I->submitForm('form', ['_username' => 'user@test.fr', '_password' => 'user']);
        } catch (\Exception $e) {
            $this->debug($e->getMessage());
        }
    }

    public function goOnPage(string $page)
    {
        try {
            /** @var Symfony $I */
            $I = $this->getModule('Symfony');
            $I->amOnPage($page);
        } catch (\Exception $e) {
            $this->debug($e->getMessage());
        }
    }
}
