<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class CarroCest
{


    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    protected function formParamsLogin($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }


    // tests
    public function CriarCarroTest(FunctionalTester $I)
    {
        //Fazer login
        $I->submitForm('#login-form', $this->formParamsLogin('secretaria', '1234567890'));
        $I->see('Logout (secretaria)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Registar');

        //Ir para página gestão de Carros
        $I->see('Gestão de Carros');
        $I->click('Gestão de Carros');

        //Botão criar um carro
        $I->see('Adicionar Um Carro');
        $I->click('Adicionar Um Carro');

        //Criar um carro
        $I->fillField('Marca Carro', 'marcacarro');
        $I->fillField('Modelo Carro', 'modelocarro');
        $I->fillField('Ano', '2015');
        $I->fillField('Matricula', 'AA-11-BB');
        $I->fillField('Quilometros', '300000');
        $I->selectOption('#combustivel', 'Diesel');
        $I->fillField('Preco Carro', '14000');

        $I->click('Guardar', 'button');

        $I->see('Vender');
        $I->see('Alterar Carro');
        $I->see('Eliminar');


    }
}
