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

    private function getMarcacaoValida(){

        $marcacao = new Marcacao();

        $marcacao->tipoMarcacao = 'Reparacao';
        $marcacao->dataMarcacao = '2020-11-17';
        $marcacao->descricaoMarcacao = 'olaolaolaola';
        $marcacao->estadoMarcacao = 'Espera';
        $c = $this->getCarro();
        $marcacao->fk_idCarro = $c->idCarro;
        $marcacao->fk_idPessoa = $c->fk_idPessoa;

        return $marcacao;
    }

    // tests

    public function testMarcacaoValido()
    {
        $marcacao = $this->getMarcacaoValida();
        $this->assertTrue($marcacao->validate());

        $marcacao->descricaoMarcacao = 'ola';
        $this->assertTrue($marcacao->validate());
    }

    public function testtipoMarcacaoVazio(){
        $marcacao = $this->getMarcacaoValida();
        $marcacao->tipoMarcacao = '';
        $this->assertFalse($marcacao->validate());
    }

    public function testdataMarcacaoVazio(){
        $marcacao = $this->getMarcacaoValida();
        $marcacao->dataMarcacao = '';
        $this->assertFalse($marcacao->validate());
    }

    public function testdataMarcacaoInvalida(){
        $marcacao = $this->getMarcacaoValida();
        $marcacao->dataMarcacao = "17-11-2000";
        $this->assertFalse($marcacao->validate());
    }

    public function testdescricaoMarcacaoVazio(){
        $marcacao = $this->getMarcacaoValida();
        $marcacao->descricaoMarcacao = '';
        $this->assertFalse($marcacao->validate());
    }

    public function testdescricaoMarcacaoInvalida(){
        $marcacao = $this->getMarcacaoValida();
        //+255 carateres
        $marcacao->descricaoMarcacao = '1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890
        1234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789012345678901';
        $this->assertFalse($marcacao->validate());
    }

    public function testAdicionarMarcacao()
    {
        $this->tester->cantSeeRecord(Marcacao::class, ["descricaoMarcacao" => 'olaolaolaola']);

        $p = $this->getMarcacaoValida();
        $p->save();

        $this->tester->seeRecord(Marcacao::class, ["descricaoMarcacao" => 'olaolaolaola']);
    }

    public function testAtualizarRegisto()
    {
        // pré-condicoes
        $p = $this->getMarcacaoValida();
        $p->save();

        // fazer trabalho...
        $alvo = Marcacao::find()->where(["descricaoMarcacao" => 'olaolaolaola'])->one();
        $alvo->descricaoMarcacao = 'ola1';
        $alvo->update();

        // confirmar mudanças...
        $this->tester->seeRecord(Marcacao::class, ["descricaoMarcacao" => 'ola1']);
        $this->tester->cantSeeRecord(Marcacao::class, ["descricaoMarcacao" => 'olaolaolaola']);
    }

    public function testApagarRegisto()
    {
        // pré-condicoes
        $p = $this->getMarcacaoValida();
        $p->save();

        // fazer trabalho...
        $alvo= Marcacao::find()->where(['descricaoMarcacao' => 'olaolaolaola'])->one();
        $alvo->delete(); //erro aqui perguntar ao stor

        // confirmar mudanças...
        $this->tester->cantSeeRecord(Marcacao::class, ['descricaoMarcacao' => 'olaolaolaola']);
    }



}