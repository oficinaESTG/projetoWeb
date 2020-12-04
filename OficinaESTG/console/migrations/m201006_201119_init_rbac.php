<?php

use yii\db\Migration;

/**
 * Class m201006_201119_init_rbac
 */
class m201006_201119_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        //Marcacao ----------------------------------------------

        // add "createMarcacao" permission
        $createMarcacao = $auth->createPermission('createMarcacao');
        $createMarcacao->description = 'Create a post';
        $auth->add($createMarcacao);

        // add "updateMarcacao" permission
        $updateMarcacao = $auth->createPermission('updateMarcacao');
        $updateMarcacao->description = 'Update post';
        $auth->add($updateMarcacao);

        // add "deleteMarcacao" permission
        $deleteMarcacao = $auth->createPermission('deleteMarcacao');
        $deleteMarcacao->description = 'Update post';
        $auth->add($deleteMarcacao);

        $viewMarcacao = $auth->createPermission('viewMarcacao');
        $viewMarcacao->description = 'View post';
        $auth->add($viewMarcacao);

        //Carro------------------------------

        $viewCarro = $auth->createPermission('viewCarro');
        $viewCarro->description = 'View Carro';
        $auth->add($viewCarro);

        $createCarro = $auth->createPermission('createCarro');
        $createCarro->description = 'create Carro';
        $auth->add($createCarro);

        $updateCarro = $auth->createPermission('updateCarro');
        $updateCarro->description = 'update Carro';
        $auth->add($updateCarro);

        $deleteCarro = $auth->createPermission('deleteCarro');
        $deleteCarro->description = 'delete Carro';
        $auth->add($deleteCarro);

        //Pecas-----------------------

        $viewPeca = $auth->createPermission('viewPecas');
        $viewPeca->description = 'View Peca';
        $auth->add($viewPeca);

        $createPeca = $auth->createPermission('createPeca');
        $createPeca->description = 'create Peca';
        $auth->add($createPeca);

        $updatePeca = $auth->createPermission('updatePeca');
        $updatePeca->description = 'update Peca';
        $auth->add($updatePeca);

        $deletePeca = $auth->createPermission('deletePeca');
        $deletePeca->description = 'delete Peca';
        $auth->add($deletePeca);

        //Pessoa----------------

        $viewPessoa = $auth->createPermission('viewPessoa');
        $viewPessoa->description = 'View Pessoa';
        $auth->add($viewPessoa);

        $createPessoa = $auth->createPermission('createPessoa');
        $createPessoa->description = 'create Pessoa';
        $auth->add($createPessoa);

        $updatePessoa = $auth->createPermission('updatePessoa');
        $updatePessoa->description = 'update Pessoa';
        $auth->add($updatePessoa);

        $deletePessoa = $auth->createPermission('deletePessoa');
        $deletePessoa->description = 'delete Pessoa';
        $auth->add($deletePessoa);

        //Venda----------------

        $viewVenda = $auth->createPermission('viewVenda');
        $viewVenda->description = 'View Venda';
        $auth->add($viewVenda);

        $createVenda = $auth->createPermission('createVenda');
        $createVenda->description = 'create Venda';
        $auth->add($createVenda);

        $updateVenda = $auth->createPermission('updateVenda');
        $updateVenda->description = 'update Venda';
        $auth->add($updateVenda);

        $deleteVenda = $auth->createPermission('deleteVenda');
        $deleteVenda->description = 'delete Venda';
        $auth->add($deleteVenda);

        //MarcPecas----------------

        $viewMarcPecas = $auth->createPermission('viewMarcPecas');
        $viewMarcPecas->description = 'View MarcPecas';
        $auth->add($viewMarcPecas);

        $createMarcPecas = $auth->createPermission('createMarcPecas');
        $createMarcPecas->description = 'create MarcPecas';
        $auth->add($createMarcPecas);

        $updateMarcPecas = $auth->createPermission('updateMarcPecas');
        $updateMarcPecas->description = 'update MarcPecas';
        $auth->add($updateMarcPecas);

        $deleteMarcPecas = $auth->createPermission('deleteMarcPecas');
        $deleteMarcPecas->description = 'delete MarcPecas';
        $auth->add($deleteMarcPecas);

        //LoginBackend
        $loginBackend = $auth->createPermission('loginBackend');
        $loginBackend->description = 'login Backend';
        $auth->add($loginBackend);

        //User Roles ---------------------------------------------
        $cliente = $auth->createRole('Cliente');
        $auth->add($cliente);
        $auth->addChild($cliente, $createMarcacao);
        $auth->addChild($cliente, $viewMarcacao);
        $auth->addChild($cliente, $viewCarro);
        $auth->addChild($cliente, $createCarro);
        $auth->addChild($cliente, $updateCarro);
        $auth->addChild($cliente, $deleteCarro);
        $auth->addChild($cliente, $updatePessoa);
        $auth->addChild($cliente, $viewPessoa);



        $mecanico = $auth->createRole('Mecanico');
        $auth->add($mecanico);
        $auth->addChild($mecanico, $loginBackend);
        $auth->addChild($mecanico, $viewMarcPecas);
        $auth->addChild($mecanico, $updateMarcPecas);
        $auth->addChild($mecanico, $createMarcPecas);
        $auth->addChild($mecanico, $deleteMarcPecas);

        $auth->addChild($mecanico, $updateMarcacao);
        $auth->addChild($mecanico, $viewPeca);
        $auth->addChild($mecanico, $cliente);


        $gestor = $auth->createRole('Gestor');
        $auth->add($gestor);
        $auth->addChild($gestor, $updateMarcacao);
        $auth->addChild($gestor, $viewVenda);
        $auth->addChild($gestor, $createVenda);
        $auth->addChild($gestor, $updateVenda);
        $auth->addChild($gestor, $createPeca);
        $auth->addChild($gestor, $updatePeca);
        $auth->addChild($gestor, $deletePeca);
        $auth->addChild($gestor, $cliente);
        $auth->addChild($gestor, $mecanico);

        $secretaria = $auth->createRole('Secretaria');
        $auth->add($secretaria);
        $auth->addChild($secretaria, $deleteMarcacao);
        $auth->addChild($secretaria, $deleteVenda);
        $auth->addChild($secretaria, $gestor);
        $auth->addChild($secretaria, $mecanico);
        $auth->addChild($secretaria, $cliente);


        /*$auth->assign($cliente, 1);
        $auth->assign($mecanico, 2);
        $auth->assign($secretaria, 3); */
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201006_201119_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
