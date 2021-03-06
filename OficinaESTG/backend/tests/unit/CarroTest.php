<?php namespace backend\tests;

use common\models\Carro;
use common\models\Marcacao;
use common\models\Pessoa;
use common\models\User;

class CarroTest extends \Codeception\Test\Unit
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


    private function getCarroValido(){

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

    // tests
    public function testCarroValido()
    {
        $c = $this->getCarroValido();
        $this->assertTrue($c->validate());

        $c->modeloCarro = "Passat";
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
    public function testAnoCarroInvalido()
    {
        $c = $this->getCarroValido();
        $c->ano = 2350;
        $this->assertFalse($c->validate());
    }

    public function testTipoCarroVazio()
    {
        $c = $this->getCarroValido();
        $c->tipoCarro = "";
        $this->assertFalse($c->validate());
    }

    public function testCombustivelVazio()
    {
        $c = $this->getCarroValido();
        $c->combustivel = "";
        $this->assertFalse($c->validate());
    }

    public function testQuilometroVazio()
    {
        $c = $this->getCarroValido();
        $c->quilometros = "";
        $this->assertFalse($c->validate());
    }

    public function testFkIdPessoaVazio()
    {
        $c = $this->getCarroValido();
        $c->fk_idPessoa = "";
        $this->assertFalse($c->validate());
    }

    public function testQuilometrosInvalido()
    {
        $c = $this->getCarroValido();
        $c->ano = 1000000;
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