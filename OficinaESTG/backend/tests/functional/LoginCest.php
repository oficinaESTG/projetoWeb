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
        //user com permissões (gestor)
        $I->submitForm('#login-form', $this->formParams('gestordepecas', '1234567890'));
        $I->see('Logout (gestordepecas)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Registar');
    }


    public function checkInvalidLogin(FunctionalTester $I)
    {
        //user sem permissões (clientes)
        $I->submitForm('#login-form', $this->formParams('cliente', '1234567890'));
        $I->see('Username');
        $I->see('Password');
        $I->dontSeeLink('Logout (cliente)', 'form button[type=submit]');

    }
}
