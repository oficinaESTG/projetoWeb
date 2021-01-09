<?php namespace backend\tests\functional;
use backend\tests\FunctionalTester;
use common\fixtures\UserFixture;
use yii\rbac\Assignment;

class VendaCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amOnRoute('site/login');
    }

    //dados para login
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'login_data.php',

            ],
        ];
    }

    protected function formParamsLogin($login, $password)
    {
        return [
            'LoginForm[username]' => $login,
            'LoginForm[password]' => $password,
        ];
    }

    public function VendaTest(FunctionalTester $I)
    {
        //Fazer login
        $I->submitForm('#login-form', $this->formParamsLogin('rodrigo', 'password_0'));
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

        //vender carro
        $I->see('Vender');
        $I->click('Vender');

        //$I->dontSeeLink('carro');

        //preencher os campos
        $I->fillField('DataVenda', '2000-11-17');
        $I->fillField('DescricaoVenda', 'foi vendido');
        $I->click('Guardar', 'button');

        $I->see('Ver Venda :');
        $I->see('Id Venda');
        $I->see('Quantia Venda');
        $I->see('Data Venda');
        $I->see('Descricao Venda');
        $I->see('Fk Id Carro');

    }
}
