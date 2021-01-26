<?php namespace frontend\tests\functional;
use common\fixtures\UserFixture;
use frontend\tests\FunctionalTester;

class MarcacaoCest
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

    public function TestInserirMarcacao(FunctionalTester $I)
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

        //Ver detalhes
        $I->see('Alterar');
        $I->see('Eliminar');

        //Ir para página marcação
        $I->see('Marcações');
        $I->click('Marcações');

        //Botão criar marcação
        $I->see('Criar Marcação');
        $I->click('Criar Marcação');

        //Criar marcação
        $I->fillField('Data', '2020-12-12');
        $I->fillField('Descrição', 'descricao');
        $I->selectOption('#fkcarro','Megane');

        $I->click('Guardar', 'button');

        //Verificar se guardou
        $I->see('Reparacao');
        $I->see('2020-12-12');
        $I->see('descricao');
        $I->see('Espera');
    }
}
