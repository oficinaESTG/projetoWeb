<?php namespace backend\tests;

use common\models\Pessoa;

class PessoaTest extends \Codeception\Test\Unit
{
    /**
     * @var \backend\tests\UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    private function getPessoa()
    {
        $pessoa = new Pessoa();

        $pessoa->nome = "José";
        $pessoa->dataNascimento = "2017-06-15";
        $pessoa->morada = "Fátima";
        $pessoa->nif = 12345678988;
        $pessoa->tipoPessoa = "Mecanico";

        return $pessoa;
    }

    //Testar a adicionar pessoa
    public function testGetPessoa()
    {
        $p = $this->getPessoa();
        $this->assertTrue($p->validate());
    }

    //Testar a adicionar pessoa
    public function testAdicionarPessoa()
    {
        $this->tester->cantSeeRecord(Pessoa::class, ['nome' => 'José']);

        $p = $this->getPessoa();
        $p->save();

        $this->tester->seeRecord(Pessoa::class, ['nome' => 'José']);
    }

    //VAZIO(s) -------------------------------------------------------------------------------------------
    //->Nome
    public function testNomeVazia()
    {
        $p = $this->getPessoa();
        $p->nome = "";
        $this->assertFalse($p->validate());
    }

    //->Data Nascimento
    public function testDataNascimentoVazia()
    {
        $p = $this->getPessoa();
        $p->dataNascimento = "";
        $this->assertFalse($p->validate());
    }

    //->Morada
    public function testMoradaVazia()
    {
        $p = $this->getPessoa();
        $p->morada = "";
        $this->assertFalse($p->validate());
    }

    //->Nif
    public function testNifVazia()
    {
        $p = $this->getPessoa();
        $p->nif = "";
        $this->assertFalse($p->validate());
    }

    //->Tipo Pessoa
    public function testTipoPessoaVazia()
    {
        $p = $this->getPessoa();
        $p->tipoPessoa = "";
        $this->assertFalse($p->validate());
    }

    //Introdução(s) -------------------------------------------------------------------------------------------


}