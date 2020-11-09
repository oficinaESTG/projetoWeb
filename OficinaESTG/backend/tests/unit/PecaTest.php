<?php namespace backend\tests;

use common\models\Peca;

class PecaTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
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
        $p->quantidadePeca = 2;
        $p->precoPeca = 3;


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