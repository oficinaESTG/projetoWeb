<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class RegistarCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    // tests
    public function tryToTest(FunctionalTester $I)
    {
        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'Jose',
            'SignupForm[email]' => 'jose@asd.com',
            'SignupForm[password]' => 'tester_password',
            'SignupForm[nome]' => 'tester_password',
            'SignupForm[dataNascimento]' => 'tester_password',
            'SignupForm[morada]' => 'tester_password',
            'SignupForm[nif]' => 'tester_password',
        ]);
    }
}
