<?php namespace backend\tests;

use common\models\Carro;
use common\models\Marcacao;
use common\models\Pessoa;
use common\models\User;
use common\models\Venda;

class VendaTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    protected function _before()
    {
        Venda::deleteAll();
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

    private function getCarro(){

        $carro = new Carro();

        $carro->modeloCarro = "Passat";
        $carro->marcaCarro = "Volkswagen";
        $carro->ano = 1999;
        $carro->matricula = "AA-11-CC";
        $carro->tipoCarro = "Reparacao";
        $carro->quilometros = "100";
        $carro->combustivel = "Diesel";

        $pessoa = $this->getPessoa();
        $carro->fk_idPessoa = $pessoa->idPessoa;

        $carro->save();


        return $carro;
    }

    private function getVenda(){

        $venda = new Venda();

        $venda->quantiaVenda = 124;
        $venda->dataVenda = "2020/11/17";
        $venda->descricaoVenda = "Venda de um passat 1.9 tdi de 1999";
        $carro = $this->getCarro();
        $venda->fk_idCarro = $carro->idCarro;

        return $venda;

    }

    // tests
    public function testVendaValido()
    {
        $v = $this->getVenda();
        $this->assertTrue($v->validate());

    }

    public function testQuantiaVendaVazio()
    {
        $v = $this->getVenda();
        $v->quantiaVenda = "";
        $this->assertFalse($v->validate());
    }

    public function testDataVendaVazio()
    {
        $v = $this->getVenda();
        $v->dataVenda = "";
        $this->assertFalse($v->validate());
    }

    //Adicionar venda
    public function testAdicionarVenda()
    {
        $this->tester->cantSeeRecord(Venda::class, ['quantiaVenda' => 124]);

        $tester = $this->getVenda();
        $tester->save();

        $this->tester->seeRecord(Venda::class, ['quantiaVenda' => 124]);
    }

    //Atualizar venda
    public function testAtualizarVenda()
    {
        $venda_adicionar = $this->testAdicionarVenda();

        $venda=Venda::find()->where(['quantiaVenda'=>124])->one();
        $venda->quantiaVenda = 200;
        $venda->update();

        $this->tester->seeRecord(Venda::class, ['quantiaVenda' => 200]);
        $this->tester->cantSeeRecord(Venda::class, ['quantiaVenda' => 124]);
    }

    //Eliminar venda
    public function testApagarPessoa()
    {
        $venda_adicionar = $this->testAdicionarVenda();

        $venda=Venda::find()->where(['quantiaVenda'=>124])->one();
        $venda->delete();

        $this->tester->cantSeeRecord(Venda::class, ['quantiaVenda' => 124]);
    }

}