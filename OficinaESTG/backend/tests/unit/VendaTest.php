<?php namespace backend\tests;

use common\models\Carro;
use common\models\Pessoa;
use common\models\Venda;

class VendaTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;

    private function getPessoa(){
        $pessoa = new Pessoa();

        //$pessoa->idPessoa = 1;
        $pessoa->nome = "Rodrigo";
        $pessoa->dataNascimento = "2000/11/17";
        $pessoa->morada = "Leiria";
        $pessoa->nif = 123456789;
        $pessoa->tipoPessoa = "Mecanico";
        $pessoa->email = "asbajsb@dksndnsd.pt";
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
        $pessoa = $this->getPessoa();
        $c->fk_idPessoa = $pessoa->idPessoa;

        $c->save();


        return $c;
    }

    protected function _before()
    {
        $pessoa = $this->getPessoa();
        $pessoa->save();
        $c = $this->getCarro();
        $c->save();
    }

    protected function _after()
    {
    }

    private function getVenda(){

        $v = new Venda();

        $v->quantiaVenda = 124;
        $v->dataVenda = "2020/11/17";
        $v->descricaoVenda = "Venda de um passat 1.9 tdi de 1999";
        $c = $this->getCarro();
        $v->fk_idCarro = $c->idCarro;

        return $v;

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

   /* public function testAdicionarCarro()
    {
        $this->tester->cantSeeRecord(Carro::class, ['modeloCarro' => 'Passat']);

        $c = $this->getCarroValido();
        $c->save();

        $this->tester->seeRecord(Carro::class, ['modeloCarro' => 'Passat']);
    }

    public function testAtualizarRegisto()
    {
        // pré-condicoes
        $c = $this->getCarroValido();
        $c->save();

        // fazer trabalho...
        $alvo = Carro::find()->where(['modeloCarro' => 'Passat'])->one();
        $alvo->modeloCarro = "Civic";
        $alvo->update();

        // confirmar mudanças...
        $this->tester->seeRecord(Carro::class, ['modeloCarro' => 'Civic']);
        $this->tester->cantSeeRecord(Carro::class, ['modeloCarro' => 'Passat']);
    }

    public function testApagarRegisto()
    {
        // pré-condicoes
        $c = $this->getCarroValido();
        $c->save();

        // fazer trabalho...
        $alvo= Carro::find()->where(['modeloCarro' => 'Passat'])->one();
        $alvo->delete();

        // confirmar mudanças...
        $this->tester->cantSeeRecord(Carro::class, ['modeloCarro' => 'Passat']);
    }
   */
}