<?php namespace frontend\tests\functional;
use frontend\tests\FunctionalTester;

class RegistarCest
{
    protected $formId = '#form-signup';

    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }

    // tests
    public function Registar(FunctionalTester $I)
    {

        $I->submitForm($this->formId, [
            'SignupForm[username]' => 'jose',
            'SignupForm[email]' => 'jose@gmail.com',
            'SignupForm[password]' => '1234567890',
            'SignupForm[nome]' => 'jose',
            'SignupForm[dataNascimento]' => '2000-12-12',
            'SignupForm[morada]' => 'terra',
            'SignupForm[nif]' => '123456789',
        ]);

        $I->seeRecord('common\models\User', [
            'username' => 'jose',
            'email' => 'jose@gmail.com',
            'status' => \common\models\User::STATUS_INACTIVE
        ]);

        $I->seeEmailIsSent();
        $I->see('Marcações');
    }
}
