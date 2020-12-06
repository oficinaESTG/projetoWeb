<?php namespace frontend\tests\functional;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class CarroCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    //Fazer login na pagina
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

    public function TestCarro(FunctionalTester $I)
    {
        //Fazer login
        $I->submitForm('#login-form', $this->formParams('rodrigo', 'password_0'));
        $I->see('Logout (rodrigo)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Registar');

        //Criar Carro
        $I->see('Veiculos');
        $I->click('Veiculos');

        //Botão criar carro
        $I->see('Adicionar Veículo');
        $I->click('Adicionar Veículo');

        //Criar carro
        $I->fillField('Marca', 'Renault');
        $I->fillField('Modelo', 'Megane');
        $I->fillField('Ano', '2020');
        $I->fillField('Matrícula', 'AA-00-AA');
        $I->fillField('Quilómetros', '0');
        $I->selectOption('#combustivel','Diesel');
        $I->click('Guardar', 'button');

        //Verificar se guardou
        $I->see('Marca: Renault');
        $I->see('Modelo: Megane');
        $I->see('Ano: 2020');
        $I->see('Km(s): 0');
        $I->see('Combustível: Diesel');
        $I->see('Matrícula: AA-00-AA');
        $I->see('Status: Reparacao');

        //Botão alterar carro
        $I->see('Alterar');
        $I->click('Alterar');

        //Atualizar carro
        $I->fillField('Marca', 'Renault');
        $I->fillField('Modelo', 'Laguna');
        $I->fillField('Ano', '2019');
        $I->fillField('Matrícula', 'AA-00-AA');
        $I->fillField('Quilómetros', '0');
        $I->selectOption('#combustivel','Diesel');
        $I->click('Guardar', 'button');

        //Verificar se guardou
        $I->see('Marca: Renault');
        $I->see('Modelo: Laguna');
        $I->see('Ano: 2019');
        $I->see('Km(s): 0');
        $I->see('Combustível: Diesel');
        $I->see('Matrícula: AA-00-AA');
        $I->see('Status: Reparacao');

    }
}
