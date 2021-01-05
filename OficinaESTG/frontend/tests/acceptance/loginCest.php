<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;
use frontend\tests\FunctionalTester;
use yii\helpers\Url;

class loginCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/login'));
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
        $I->submitForm('#login-form', $this->formParams('rodrigo', 'password_0'));
        $I->see('Logout (rodrigo)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Registar');
        $I->see('Marcações');
    }
}
