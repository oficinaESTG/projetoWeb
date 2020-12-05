<?php namespace backend\tests;

use common\models\Carro;
use common\models\Marcacao;
use common\models\MarcacaoHaspecas;
use common\models\Peca;
use common\models\Pessoa;
use common\models\User;

class PecaTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    private function getUser(){
        $user = new User();

        $user->username = 'Rodrigo2';
        $user->auth_key = 's-pP6Nay6ZmGWhW89YbAIZAHO-R9iper';
        $user->password_hash = '$2y$13$M4TDIVbZXyoesjIoJHuMM.5iJE1QJRGme4YocS5bfg10UwlFqmNrK';
        $user->email = "rodrigo@ole.pt";
        $user->status = 10;
        $user->created_at = 1606161383;
        $user->updated_at = 1606161383;
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


        return $c;
    }

    private function getMarcacao(){

        $marcacao = new Marcacao();

        $marcacao->tipoMarcacao = 'Reparacao';
        $marcacao->dataMarcacao = '2020-11-17';
        $marcacao->descricaoMarcacao = 'ola';
        $marcacao->estadoMarcacao = 'Espera';
        $c = $this->getCarro();
        $marcacao->fk_idCarro = $c->idCarro;
        $pessoa = $this->getPessoa();
        $marcacao->fk_idPessoa = $pessoa->idPessoa;
        $marcacao->save();

        return $marcacao;
    }


    
    protected function _before()
    {
        Peca::deleteAll();
    }

    protected function _after()
    {
    }

    private function getPecaValida(){

        $p = new Peca();

        $p->nomePeca = "peca1";
        $p->quantidadePeca = "3";
        $p->precoPeca = "3";
        $p->referenciaPeca ="dkaskdmsadm";


        return $p;
    }

    // tests
    public function testPecaValida()
    {
        $p = $this->getPecaValida();
        $this->assertTrue($p->validate());

        $p->nomePeca = "peca1";
        $this->assertTrue($p->validate());
    }

    public function testNomePecaVazio()
    {
        $p = $this->getPecaValida();
        $p->nomePeca = "";
        $this->assertFalse($p->validate());
    }

    public function testQuantidadePecaVazio()
    {
        $p = $this->getPecaValida();
        $p->quantidadePeca = "";
        $this->assertFalse($p->validate());
    }

    public function testPrecoPecaVazio()
    {
        $p = $this->getPecaValida();
        $p->precoPeca = "";
        $this->assertFalse($p->validate());
    }

    public function testAdicionarCarro()
    {
        $this->tester->cantSeeRecord(Peca::class, ['nomePeca' => 'peca1']);

        $p = $this->getPecaValida();
        $p->save();

        $this->tester->seeRecord(Peca::class, ['nomePeca' => 'peca1']);
    }

    public function testAtualizarRegisto()
    {
        // pré-condicoes
        $p = $this->getPecaValida();
        $p->save();

        // fazer trabalho...
        $alvo = Peca::find()->where(['nomePeca' => 'peca1'])->one();
        $alvo->nomePeca = "peca2";
        $alvo->update();

        // confirmar mudanças...
        $this->tester->seeRecord(Peca::class, ['nomePeca' => 'peca2']);
        $this->tester->cantSeeRecord(Peca::class, ['nomePeca' => 'peca1']);
    }

    public function testApagarRegisto()
    {
        // pré-condicoes
        $p = $this->getPecaValida();
        $p->save();

        // fazer trabalho...
        $alvo= Peca::find()->where(['nomePeca' => 'peca1'])->one();
        $alvo->delete(); //erro aqui perguntar ao stor

        // confirmar mudanças...
        $this->tester->cantSeeRecord(Peca::class, ['nomePeca' => 'peca1']);
    }
}