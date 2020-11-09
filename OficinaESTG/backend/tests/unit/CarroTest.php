<?php namespace backend\tests;

use common\models\Carro;

class CarroTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
        Carro::deleteAll();
    }

    protected function _after()
    {
    }

    private function getCarroValido(){

        $c = new Carro();

        $c->modeloCarro = "Passat";
        $c->marcaCarro = "Volkswagen";
        $c->ano = 1999;
        $c->matricula = "AA-11-CC";
        $c->tipoCarro = "Reparacao";
        $c->fk_idPessoa = 1;


        return $c;
    }

    // tests
    public function testCarroValido()
    {
        $c = $this->getCarroValido();
        $this->assertTrue($c->validate());

        $c->modeloCarro = "A3";
        $this->assertTrue($c->validate());
    }

    public function testModeloCarroVazio()
    {
        $c = $this->getCarroValido();
        $c->modeloCarro = "";
        $this->assertFalse($c->validate());
    }

    public function testMarcaCarroVazio()
    {
        $c = $this->getCarroValido();
        $c->marcaCarro = "";
        $this->assertFalse($c->validate());
    }

    public function testAnoCarroVazio()
    {
        $c = $this->getCarroValido();
        $c->ano = "";
        $this->assertFalse($c->validate());
    }

    //Verificar com o stor os erros
   /* public function testAnoCarroInvalido()
    {
        $c = $this->getCarroValido();
        $c->ano = "23500";
        $this->assertFalse($c->validate());
    } */

    public function testTipoCarroVazio()
    {
        $c = $this->getCarroValido();
        $c->tipoCarro = "";
        $this->assertFalse($c->validate());
    }

    public function testFkIdPessoaVazio()
    {
        $c = $this->getCarroValido();
        $c->fk_idPessoa = "";
        $this->assertFalse($c->validate());
    }

    public function testAdicionarCarro()
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

}