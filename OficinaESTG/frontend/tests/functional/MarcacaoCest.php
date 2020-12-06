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

    protected $formId = '#form-marcacao';

    public function TestNovaMarcacao(FunctionalTester $I)
    {
        //Fazer login
        $I->submitForm('#login-form', $this->formParams('rodrigo', 'password_0'));
        $I->see('Logout (rodrigo)', 'form button[type=submit]');
        $I->dontSeeLink('Login');
        $I->dontSeeLink('Registar');

        //Ir para página marcação
        $I->see('Marcações');
        $I->click('Marcações');

        //Botão criar marcação
        $I->see('Criar Marcação');
        $I->click('Criar Marcação');

        //Criar marcação
        $I->fillField('Data', '2020-12-12');
        $I->fillField('Descrição', 'descricao');
        $I->selectOption('#fkcarro','L200 (Strakar)');

        $I->click('Guardar', 'button');

        $I->see('Atualizar');
        $I->see('Eliminar');
    }

}
