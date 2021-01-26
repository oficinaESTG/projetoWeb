<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;

class CarroCest
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


    // tests
    public function CarroTest(FunctionalTester $I)
    {
        //Fazer login
        $I->submitForm('#login-form', $this->formParams('rodrigo', 'password_0'));
        $I->see('Logout (rodrigo)', 'form button[type=submit]');
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

        //verificar se guardou
        $I->see('Vender');
        $I->see('Alterar Carro');
        $I->see('Eliminar');

        //Botão alterar carro
        $I->see('Alterar Carro');
        $I->click('Alterar Carro');

        //atualizar o carro
        $I->fillField('Marca Carro', 'marcacarro1');
        $I->fillField('Modelo Carro', 'modelocarro1');
        $I->fillField('Ano', '2020');
        $I->fillField('Matricula', 'AA-11-CC');
        $I->fillField('Quilometros', '12000');
        $I->selectOption('#combustivel','Diesel');
        $I->fillField('Preco Carro', '12000');

        $I->click('Guardar', 'button');

        //Verificar se guardou
        $I->see('Marca: marcacarro1');
        $I->see('Modelo: modelocarro1');
        $I->see('Ano: 2020');
        $I->see('Km(s): 12000');
        $I->see('Combustível: Diesel');
        $I->see('Matrícula: AA-11-CC');
        $I->see('Status: Venda');


    }
}
