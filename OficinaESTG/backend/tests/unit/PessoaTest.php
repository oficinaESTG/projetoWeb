<?php namespace backend\tests;

use common\models\Carro;
use common\models\Marcacao;
use common\models\Pessoa;
use common\models\User;
use common\models\Venda;

class PessoaTest extends \Codeception\Test\Unit
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

    private function getPessoa()
    {
        $pessoa = new Pessoa();

        $pessoa->nome = "Jose";
        $pessoa->dataNascimento = "2017-06-15";
        $pessoa->morada = "Fátima";
        $pessoa->nif = 123456789;
        $pessoa->tipoPessoa = "Mecanico";
        $pessoa->email = "asd@asd.com";

        $user = $this->getUser();
        $pessoa->fk_IdUser = $user->id;


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

    //Atualizar pessoa
    public function testAtualizarPessoa()
    {
        $pessoa_adicionar = $this->testAdicionarPessoa();

        $pessoa=Pessoa::find()->where(['nome'=>"Jose"])->one();
        $pessoa->nome = "Andre";
        $pessoa->update();

        $this->tester->seeRecord(Pessoa::class, ['nome' => "Andre"]);
        $this->tester->cantSeeRecord(Pessoa::class, ['nome' => "Jose"]);
    }

    //Apagar Pessoa
    public function testApagarPessoa()
    {
        $pessoa_adicionar = $this->testAdicionarPessoa();

        $pessoa=Pessoa::find()->where(['nome'=>"Jose"])->one();
        $pessoa->delete();

        $this->tester->cantSeeRecord(Pessoa::class, ['nome' => 'Jose']);
    }

    //VAZIO(s) -------------------------------------------------------------------------------------------------------

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

    //Grande(s) ------------------------------------------------------------------------------------------------------

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
        $this->assertTrue($p->validate()); //formato certo

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

        $p->nif = "123456789";
        $this->assertTrue($p->validate()); //formato correto

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

        $p->email = "asd@asd.com";
        $this->assertTrue($p->validate()); //formato correto

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