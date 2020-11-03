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

        //User Roles ---------------------------------------------
        $cliente = $auth->createRole('cliente');
        $auth->add($cliente);
        $auth->addChild($cliente, $createMarcacao);

        $mecanico = $auth->createRole('mecanico');
        $auth->add($mecanico);
        $auth->addChild($mecanico, $updateMarcacao);

        $secretaria = $auth->createRole('secretaria');
        $auth->add($secretaria);
        $auth->addChild($secretaria, $mecanico);
        $auth->addChild($secretaria, $cliente);

        $auth->assign($cliente, 1);
        $auth->assign($mecanico, 2);
        $auth->assign($secretaria, 3);
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
