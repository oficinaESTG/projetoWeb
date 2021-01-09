<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;

class RegistoCest
{
    protected $formId = '#form-signup';

    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('site/signup');
    }

    // tests
    public function RegistarTest(AcceptanceTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'rodrigoteste2',
            'SignupForm[email]' => 'rodrigoteste2@gmail.com',
            'SignupForm[password]' => '1234567890',
            'SignupForm[nome]' => 'rodrigo',
            'SignupForm[dataNascimento]' => '2000-11-17',
            'SignupForm[morada]' => 'terra',
            'SignupForm[nif]' => '123456789',
        ]);

        $I->see('Veiculos');
        $I->see('Perfil');
    }

}
