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
            'SignupForm[username]' => 'rodrigoteste21asd212',
            'SignupForm[email]' => 'rodrigoteste212asd12@gmail.com',
            'SignupForm[password]' => '1234567890',
            'SignupForm[nome]' => 'rodrigoteste21212asd12',
            'SignupForm[dataNascimento]' => '2000-11-17',
            'SignupForm[morada]' => 'terra',
            'SignupForm[nif]' => '123456789',
        ]);

        $I->see('Login');
        $I->see('Registar');
    }

}
