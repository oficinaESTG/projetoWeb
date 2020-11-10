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
        Pessoa::deleteAll();
    }

    protected function _after()
    {
    }

    private function getPessoa()
    {
        $pessoa = new Pessoa();

        $pessoa->nome = "Jose";
        $pessoa->dataNascimento = "2017/06/15";
        $pessoa->morada = "Fátima";
        $pessoa->nif = 123456789;
        $pessoa->tipoPessoa = "Mecanico";
        $pessoa->email = "asd@asd.com";

        return $pessoa;
    }

    //Validar campos pessoa
    public function testGetPessoa()
    {
        $p = $this->getPessoa();
        $this->assertTrue($p->validate());
    }

    //Adicionar pessoa
    public function testAdicionarPessoa()
    {
        $this->tester->cantSeeRecord(Pessoa::class, ['nome' => "Jose"]);

        $tester = $this->getPessoa();
        $tester->save();

        $this->tester->seeRecord(Pessoa::class, ['nome' => "Jose"]);
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

    //->Email
    public function testEmailVazia()
    {
        $p = $this->getPessoa();
        $p->email = "";
        $this->assertFalse($p->validate());
    }

    //Grande(s) -------------------------------------------------------------------------------------------

    //->Nome
    public function testNomeGrande()
    {
        $p = $this->getPessoa();
        $p->nome = "asdsadasdsadasdsadasdsadsadsadsadsadsadsadsadsasdsadasdsadasdsadasdsadsadsadsadsadsadsadsadsadasdsadsadasdasdasdasdasdasdasdasdsadsadsadsadasdsadasdsadasdsadasdsadasdsadsadsadsadsadsadsadsadsadasdsadsadasdasdasdasdasdasdasdasdsadsadsadsadasdsadasdsadasdsadasdsadasdsadsadsadsadsadsadsadsadsadasdsadsadasdasdasdasdasdasdasdasdsadsadsadsadasdsadadasdsadsadasdasdasdasdasdasdasdasdsadsadsadsadasdsad";
        $this->assertFalse($p->validate());
    }

    //->Morada
    public function testMoradaGrande()
    {
        $p = $this->getPessoa();
        $p->morada = "asdsadasdsadasdsadasdsadsadsadsadsadsadsadsadsasdsadasdsadasdsadasdsadsadsadsadsadsadsadsadsadasdsadsadasdasdasdasdasdasdasdasdsadsadsadsadasdsadasdsadasdsadasdsadasdsadsadsadsadsadsadsadsadsadasdsadsadasdasdasdasdasdasdasdasdsadsadsadsadasdsadasdsadasdsadasdsadasdsadsadsadsadsadsadsadsadsadasdsadsadasdasdasdasdasdasdasdasdsadsadsadsadasdsadadasdsadsadasdasdasdasdasdasdasdasdsadsadsadsadasdsad";
        $this->assertFalse($p->validate());
    }

    //Introdução errada(s) -------------------------------------------------------------------------------------------

    //->Data Nascimento
    public function testDataNascimentoErrada()
    {
        $p = $this->getPessoa();

        $p->dataNascimento = "2017-12-12";
        $this->assertFalse($p->validate());

        $p->dataNascimento = "12-12-2000";
        $this->assertFalse($p->validate());

        $p->dataNascimento = "12/12/2000";
        $this->assertFalse($p->validate());

        $p->dataNascimento = "1234";
        $this->assertFalse($p->validate());
    }

    //->Nif
    public function testNifErrado()
    {
        $p = $this->getPessoa();

        $p->nif = "asd";
        $this->assertFalse($p->validate());

        $p->nif = 123456789012312312312312312;
        $this->assertFalse($p->validate());

        $p->nif = 12345678;
        $this->assertFalse($p->validate());
    }

    //->Email
    public function testEmailErrado()
    {
        $p = $this->getPessoa();

        $p->email = "asd";
        $this->assertFalse($p->validate());

        $p->email = "asd@";
        $this->assertFalse($p->validate());

        $p->email = "asd@asd";
        $this->assertFalse($p->validate());

        $p->email = "asd@asd.";
        $this->assertFalse($p->validate());
    }
}