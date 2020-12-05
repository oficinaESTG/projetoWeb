<?php namespace backend\tests;

use common\models\Carro;
use common\models\Marcacao;
use common\models\Pessoa;
use common\models\User;

class MarcacaoTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;


    protected function _before()
    {
        Marcacao::deleteAll();
        Carro::deleteAll();
        Pessoa::deleteAll();
        User::deleteAll();
    }

    protected function _after()
    {
    }

    private function getUser(){

        $user = new User();

        $user->username = 'rodrigo';
        $user->auth_key = 'ZYEE7Zm76FfE971aQvgjhntfJEgkG4WQ';
        $user->password_hash = '$2y$13$M4TDIVbZXyoesjIoJHuMM.5iJE1QJRGme4YocS5bfg10UwlFqmNrK';
        $user->email = "rodrigo@oleole.pt";
        $user->status = 10;
        $user->created_at = 1606161389;
        $user->updated_at = 1606161389;
        $user->save();

        return $user;

    }

    private function getPessoa(){
        $pessoa = new Pessoa();


        $pessoa->nome = "Rodrigo";
        $pessoa->dataNascimento = "2000-11-17";
        $pessoa->morada = "Leiria";
        $pessoa->nif = 123456789;
        $pessoa->tipoPessoa = "Mecanico";
        $pessoa->email = "asbajsb@dksndnsd.pt";
        $user = $this->getUser();
        $pessoa->fk_IdUser =  $user->id;
        $pessoa->save();

        return $pessoa;
    }

    private function getCarro(){

        $c = new Carro();

        $c->modeloCarro = "Passat";
        $c->marcaCarro = "Volkswagen";
        $c->ano = 1999;
        $c->matricula = "AA-11-CC";
        $c->tipoCarro = "Reparacao";
        $c->combustivel = "Diesel";
        $c->quilometros = "100000";
        $pessoa = $this->getPessoa();
        $c->fk_idPessoa = $pessoa->idPessoa;
        $c->save();


        return $c;
    }

    private function getMarcacaoValida(){

        $marcacao = new Marcacao();

        $marcacao->tipoMarcacao = 'Reparacao';
        $marcacao->dataMarcacao = '2020-11-17';
        $marcacao->descricaoMarcacao = 'ola';
        $marcacao->estadoMarcacao = 'Espera';
        $c = $this->getCarro();
        $marcacao->fk_idCarro = $c->idCarro;
        $pessoa = $this->getPessoa();
        $marcacao->fk_idPessoa = $pessoa->idPessoa;

        return $marcacao;
    }

    // tests

    public function testMarcacaoValido()
    {
        $marcacao = $this->getMarcacaoValida();
        $this->assertTrue($marcacao->validate());

        $marcacao->descricaoMarcacao = "ola";
        $this->assertTrue($marcacao->validate());
    }


    public function tipoMarcacaoVazio(){
        $marcacao = $this->getMarcacaoValida();
        $marcacao->tipoMarcacao = "";
        $this->assertFalse($marcacao->validate());
    }

    public function dataMarcacaoVazio(){
        $marcacao = $this->getMarcacaoValida();
        $marcacao->dataMarcacao = "";
        $this->assertFalse($marcacao->validate());
    }

    public function dataMarcacaoInvalida(){
        $marcacao = $this->getMarcacaoValida();
        $marcacao->dataMarcacao = "17-11-2000";
        $this->assertFalse($marcacao->validate());
    }

    public function descricaoMarcacaoVazio(){
        $marcacao = $this->getMarcacaoValida();
        $marcacao->descricaoMarcacao = "";
        $this->assertFalse($marcacao->validate());
    }

    public function descricaoMarcacaoInvalida(){
        $marcacao = $this->getMarcacaoValida();
        //+255 carateres
        $marcacao->descricaoMarcacao = "1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890
        1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901";
        $this->assertFalse($marcacao->validate());
    }
}