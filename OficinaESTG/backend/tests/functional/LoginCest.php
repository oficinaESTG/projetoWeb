<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;

class LoginCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    protected function formParams($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }


    public function checkValidLogin(FunctionalTester $I)
    {
        //user com permissões
        $I->submitForm('#login-form', $this->formParams('rodrigo', 'password_0'));
        $I->see('Logout (rodrigo)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Registar');
    }


    public function checkInvalidLogin(FunctionalTester $I)
    {
        //user sem permissões
        $I->submitForm('#login-form', $this->formParams('rodrigo', 'password_0'));
        $I->see('Logout (rodrigo)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Registar');
    }
}
