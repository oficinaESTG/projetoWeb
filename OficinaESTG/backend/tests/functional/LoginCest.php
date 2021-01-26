<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class LoginCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');

    }

    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',

            ],
        ];
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
        $I->submitForm('#login-form', $this->formParams('rodrigo', 'password_0'));
        $I->see('Logout (rodrigo)', 'form button[type=submit]');
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
