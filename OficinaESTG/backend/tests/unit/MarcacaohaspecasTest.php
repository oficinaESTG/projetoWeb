<?php namespace backend\tests;

use common\models\Carro;
use common\models\Marcacao;
use common\models\MarcacaoHaspecas;
use common\models\Pessoa;
use common\models\User;
use common\models\Venda;

class MarcacaohaspecasTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        Venda::deleteAll();
        MarcacaoHaspecas::deleteAll();
        Marcacao::deleteAll();
        Carro::deleteAll();
        Pessoa::deleteAll();
        User::deleteAll();
    }

    protected function _after()
    {
    }

    private function getUser()
    {
        $user = new User();

        $user->username = 'Jose';
        $user->auth_key = 's-pP6Nay6ZmGWhW89YbAIZAHO-R9iper';
        $user->password_hash = '$2y$13$M4TDIVbZXyoesjIoJHuMM.5iJE1QJRGme4YocS5bfg10UwlFqmNrK';
        $user->email = "asd@asd.com";
        $user->status = 10;
        $user->created_at = 1606161383;
        $user->updated_at = 1606161383;
        $user->save();

        return $user;
    }

    private function getPessoa(){
        $pessoa = new Pessoa();

        $pessoa->nome = "Jose";
        $pessoa->dataNascimento = "2017-06-15";
        $pessoa->morada = "Fátima";
        $pessoa->nif = 123456789;
        $pessoa->tipoPessoa = "Mecanico";
        $pessoa->email = "asd@asd.com";

        $user = $this->getUser();
        $pessoa->fk_IdUser = $user->id;

        $pessoa->save();

        return $pessoa;
    }


    // tests
    public function testSomeFeature()
    {

    }
}